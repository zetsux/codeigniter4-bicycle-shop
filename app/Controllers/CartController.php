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
    $data['products'] = $cpModel->where('cart_id', $user['cart_id'])->findAll();

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
      'count' => $this->request->getVar('count'),
    ];

    $userModel = new Users();
    $user = $userModel->where('id', $userId)->first();
    if (!$user) {
      return redirect()->back()->with('error', 'ID Pengguna tidak valid');
    }

    $bike = new Bikes();
    if (!$bike->find($product['bike_id'])) {
      return redirect()->back()->with('error', 'ID Sepeda tidak valid');
    }

    $cpModel = new CartProducts();
    $cartProduct = $cpModel->where('cart_id', $user['cart_id'])->where('bike_id', $product['bike_id'])->find();

    if ($cartProduct) {
      $addProduct = [
        'count' => $cartProduct['count'] + $product['count'],
        'total_price' => $cartProduct['total_price'] + $product['total_price'],
      ];
      $cpModel->update($cartProduct['id'], $addProduct);
    } else {
      $product['cart_id'] = $user['cart_id'];
      $cpModel->insert($product);
    }

    return redirect()->to('/bike/' . $product['bike_id']);

    // $data['product'] = $transaction;
    // $data['bike'] = $bike->where('id', $transaction['bike_id'])->first();
    // $data['address'] = $user->where('id', $transaction['user_id'])->first()['address'];

    // return view('transaction/confirm', $data);
  }

  public function changeProductCount($id)
  {
    $session = \Config\Services::session();
    if (!$session->has('id'))
      return view('auth/login');

    $userId = $session->get('id');
    $newCount = $this->request->getVar('count');

    $cpModel = new CartProducts();
    $cartProduct = $cpModel->where('id', $id)->first();

    if ($newCount == 0) {
      $cpModel->delete($id);
    } else {
      $initPrice = $cartProduct['total_price'] / $cartProduct['count'];
      $editedProd = [
        'count' => $newCount,
        'total_price' => $initPrice * $newCount,
      ];

      $cpModel->update($id, $editedProd);
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
