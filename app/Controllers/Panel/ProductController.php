<?php
namespace App\Controllers\Panel;

use Src\Classes\{
	Request,
	Controller
};
use Src\Classes\Storage\Storage;
use App\Models\{
	Product,
	ProductColor,
	ProductImage,
	Category
};

class ProductController extends Controller{
	private $product;

	public function __construct(){
		$this->product = new Product();

		$this->product->verifyPermission('view.products');
	}

	public function index(){
		$request = new Request();

		$builder = $request->except('page');
		$page = $request->input('page') ?? 1;
		$search = $request->input('search');
		$pages = ceil($this->product->count() / config('paginate.limit'));

		$products = $this->product->search($page, $search);

		return view('panel.products.index', compact('products', 'pages', 'builder'));
	}

	public function component($name){
		$data = (new Request())->all();

		$file = dirname(__DIR__, 3) . '/' . trim(config('view.dir'), '/') . '/' . str_ireplace('.', '/', "includes.components.{$name}") . '.blade.php';

		if(!file_exists($file))
			return null;
		
		return view("includes.components.{$name}", $data);
	}

	public function create(){
		$this->product->verifyPermission('create.products');
		$categories = Category::all();

		return view('panel.products.create', compact('categories'));
	}

	public function store(){
		$this->product->verifyPermission('create.products');
		$request = new Request();
		$data = $request->all();

		$this->validator($data, $this->product->rolesCreate, $this->product->messages);
		$data['slug'] = slugify($data['name']);
		if(empty($data['promotion_percent'])){
			unset($data['promotion_percent']);
		}
		if(empty($data['promotion_expiration'])){
			unset($data['promotion_expiration']);
		}

		$product = $this->product->create($data);

		if($product){
			// cadastrando subcategorias
			$product->subcategories()->sync($data['subcategories']);

			// cadastrando cores
			for($i = 0; $i < count($data['id-colors']); $i++){
				$id = $data['id-colors'][$i];
				$description = $data['description-colors'][$i];

				$color = $product->colors()->create([
					'description' => $description
				]);

				if($color){
					// cadastrando tamanhos
					$descriptions = $data["description-size-{$id}"];
					$prices = $data["price-size-{$id}"];
					$pricesPrevious = $data["price-previous-size-{$id}"];

					for($j = 0; $j < count($descriptions); $j++){
						if(!empty($descriptions[$j]) && !empty($prices[$j]) && !empty($pricesPrevious[$j])){
							$size = $color->sizes()->create([
								'description' 		=> $descriptions[$j],
								'price' 			=> $prices[$j],
								'price_previous' 	=> $pricesPrevious[$j]
							]);
						}
					}

					// cadastrando imagens
					$images = $request->file("images-{$id}");

					for($j = 0; $j < count($images); $j++){
						if($images[$j]->error == 0){
							$filename = $images[$j]->store('products');

							if($filename){
								$image = $color->images()->create([
									'source' => $filename
								]);

								if(!$image){
									Storage::delete($filename);
								}
							}
						}
					}
				}
			}

			redirect(route('panel.products.create'), ['success' => 'Produto cadastrado com sucesso']);
		}

		redirect(route('panel.products.create'), ['error' => 'Produto NÃO cadastrado, Ocorreu um erro no processo de cadastro!']);
	}

	public function edit($id){
		$this->product->verifyPermission('edit.products');
		$product = $this->product->findOrFail($id);
		$categories = Category::all();

		return view('panel.products.edit', compact('categories', 'product'));
	}

	public function update($id){
		$this->product->verifyPermission('edit.products');
		$product = $this->product->findOrFail($id);

		$request = new Request();
		$data = $request->all();

		$this->validator($data, $product->rolesUpdate, $product->messages);
		$data['slug'] = slugify($data['name']);
		if(empty($data['promotion_percent'])){
			unset($data['promotion_percent']);
		}
		if(empty($data['promotion_expiration'])){
			unset($data['promotion_expiration']);
		}

		if($product->update($data)){
			// cadastrando subcategorias
			$product->subcategories()->sync($data['subcategories']);

			// excluindo todas as cores, imagens e tamanhos do produto
			foreach($product->colors as $color){
				foreach($color->sizes as $size){
					$size->delete();
				}

				foreach(explode(',', $data['images-remove']) as $source){
					$image = ProductImage::where('source', $source)->first();	

					if($image){
						Storage::delete($image->source);

						$image->delete();
					}
				}

				if(!in_array($color->id, $data['id-colors'])){
					foreach($color->images as $image){
						Storage::delete($image->source);

						$image->delete();
					}

					$color->delete();
				}
			}

			// cadastrando cores
			for($i = 0; $i < count($data['id-colors']); $i++){
				$id = $data['id-colors'][$i];
				$description = $data['description-colors'][$i];

				$color = $product->colors()->find($id);

				if($color){
					$color->update([
						'description' => $description
					]);
				}else{
					$color = $product->colors()->create([
						'description' => $description
					]);
				}

				if($color){
					// cadastrando tamanhos
					$descriptions = $data["description-size-{$id}"];
					$prices = $data["price-size-{$id}"];
					$pricesPrevious = $data["price-previous-size-{$id}"];

					for($j = 0; $j < count($descriptions); $j++){
						if(!empty($descriptions[$j]) && !empty($prices[$j]) && !empty($pricesPrevious[$j])){
							$size = $color->sizes()->create([
								'description' 		=> $descriptions[$j],
								'price' 			=> $prices[$j],
								'price_previous' 	=> $pricesPrevious[$j]
							]);
						}
					}

					// cadastrando imagens
					$images = $request->file("images-{$id}");

					for($j = 0; $j < count($images); $j++){
						if($images[$j]->error == 0){
							$filename = $images[$j]->store('products');

							if($filename){
								$image = $color->images()->create([
									'source' => $filename
								]);

								if(!$image){
									Storage::delete($filename);
								}
							}
						}
					}
				}
			}

			redirect(route('panel.products.edit', ['id' => $product->id]), ['success' => 'Produto editado com sucesso']);
		}

		redirect(route('panel.products.edit', ['id' => $product->id]), ['error' => 'Produto NÃO editado, Ocorreu um erro no processo de edição!']);
	}

	public function destroy($id){
		$this->product->verifyPermission('delete.products');
		$product = $this->product->findOrFail($id);

		$colors = $product->colors;
		$images = [];
		foreach($colors as $color){
			foreach($color->images as $image){
				$images[] = $image->source;
			}
		}

		if($product->delete()){
			// Deletando imagens do produto
			foreach($images as $image){
				Storage::delete($image);
			}

			redirect(route('panel.products'), ['success' => 'Produto deletado com sucesso']);
		}

		redirect(route('panel.products'), ['error' => 'Produto NÃO deletado, Ocorreu um erro no processo de exclusão!']);
	}
}