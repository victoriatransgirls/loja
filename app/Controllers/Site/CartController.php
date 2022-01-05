<?php
namespace App\Controllers\Site;

use Src\Classes\{
	Request,
	Controller
};
use App\Classes\Cart;
use App\Models\{
	Product,
	ProductColor,
	ProductImage,
	ProductSize
};

class CartController extends Controller{
	private $cart;

	public function __construct(){
		$this->cart = new Cart();
	}

	public function index(){
		$products = $this->cart->all();

		return view('site.cart.index', compact('products'));
	}

	public function store($product_id, $size_id = null){
		$request = new Request();
		$data = $request->all();

		$quantity = $data['quantity'] ?? 1;

		$result = json_decode($this->add($product_id, $size_id, $quantity));

		if($result->success){
			redirect(route('site.cart'), ['success' => $result->message]);
		}

		redirect(route('site.cart'), ['error' => $result->message]);
	}

	public function destroy($id){
		$result = json_decode($this->remove($id));

		if($result->success){
			redirect(route('site.cart'), ['success' => $result->message]);
		}

		redirect(route('site.cart'), ['error' => $result->message]);
	}

	public function add($product_id, $size_id = null, $quantity = 1){
		$product = Product::findOrFail($product_id);
		$size = null;

		if($size_id){
			$size = $product->sizes->find($size_id);
		}

		$this->cart->add($product, $size, $quantity);

		return json_encode([
			'success' => true,
			'message' => 'Produto adicionado ao carrinho com sucesso!'
		]);
	}

	public function remove($id){
		$this->cart->remove($id);

		return json_encode([
			'success' => true,
			'message' => 'Produto removido do carrinho com sucesso!'
		]);
	}
}