<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Bikes;
use App\Models\CartProducts;
use CodeIgniter\API\ResponseTrait;
use App\Models\Users;
use Faker\Provider\Uuid;

class CartController extends BaseController
{
  use ResponseTrait;

  public function index()
  {
    $session = \Config\Services::session();
    if (!$session->has('id'))
      return view('auth/login');

    $userId = $session->get('id');

    $uModel = new Users();
    $user = $uModel->find($userId);
    if (!$user) {
      $session = \Config\Services::session();
      $session->destroy();
      return view('auth/login');
    }

    $cpModel = new CartProducts();
    $data['products'] = $cpModel->select('cart_products.id as product_id, cart_products.*, bikes.*')
      ->join('bikes', 'bikes.id = cart_products.bike_id')->where('cart_products.cart_id', $user['cart_id'])->findAll();

    return view('cart/list', $data);
  }

  public function show($id)
  {
    $product = new CartProducts();
    $data['product'] = $product->where('id', $id)->first();

    return view('cart/detail', $data);
  }

  public function addToCart()
  {
    $session = \Config\Services::session();
    if (!$session->has('id'))
      return view('auth/login');

    $userId = $session->get('id');
    $product = [
      'bike_id' => $this->request->getVar('bike_id'),
      'total_price' => $this->request->getVar('total_price'),
      'color' => $this->request->getVar('color'),
      'count' => $this->request->getVar('count'),
    ];

    $userModel = new Users();
    $user = $userModel->where('id', $userId)->first();
    if (!$user) {
      return redirect()->back()->with('error', 'ID Pengguna tidak valid');
    }

    $bikeModel = new Bikes();
    $bike = $bikeModel->find($product['bike_id']);
    if (!$bike) {
      return redirect()->back()->with('error', 'ID Sepeda tidak valid');
    }

    $cpModel = new CartProducts();
    $cartProduct = $cpModel->where('cart_id', $user['cart_id'])
      ->where('color', $product['color'])->where('bike_id', $product['bike_id'])->find();

    if ($cartProduct) {
      $cartProduct = $cartProduct[0];
      $addProduct = [
        'count' => $cartProduct['count'] + $product['count'],
        'total_price' => $cartProduct['total_price'] + $product['total_price'],
      ];

      if ($addProduct['count'] > $bike['stock']) {
        return redirect()->back()->with('error', 'Stok sepeda tidak cukup');
      }
      $cpModel->update($cartProduct['id'], $addProduct);
    } else {
      if ($product['count'] > $bike['stock']) {
        return redirect()->back()->with('error', 'Stok sepeda tidak cukup');
      }

      $product['cart_id'] = $user['cart_id'];
      $product['id'] = Uuid::uuid();
      $cpModel->insert($product);
    }

    // $session->setFlashdata('cartNotif', 1);
    sleep(1);
    return redirect()->to('/bike/' . $product['bike_id'])->with('cartNotif', 1);

    // $data['product'] = $transaction;
    // $data['bike'] = $bike->where('id', $transaction['bike_id'])->first();
    // $data['address'] = $user->where('id', $transaction['user_id'])->first()['address'];

    // return view('transaction/confirm', $data);
  }

  public function changeProductCount()
  {
    $session = \Config\Services::session();
    if (!$session->has('id'))
      return view('auth/login');

    $productId = $this->request->getVar('id');
    $newCount = $this->request->getVar('count');

    $cpModel = new CartProducts();
    $cartProduct = $cpModel->where('id', $productId)->first();

    if ($newCount <= 0) {
      $cpModel->delete($productId);
    } else {
      $initPrice = $cartProduct['total_price'] / $cartProduct['count'];
      $editedProd = [
        'count' => $newCount,
        'total_price' => $initPrice * $newCount,
      ];

      $cpModel->update($productId, $editedProd);
    }

    return redirect()->to('/cart');
  }

  public function delete($id)
  {
    $model = new CartProducts();
    $data = $model->find($id);

    if ($data) {
      $model->delete($id);
    } else {
      return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang');
    }
  }
}
