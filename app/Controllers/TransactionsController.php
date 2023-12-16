<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Bikes;
use App\Models\CartProducts;
use CodeIgniter\API\ResponseTrait;
use App\Models\Transactions;
use App\Models\Users;
use Faker\Provider\Uuid;

class TransactionsController extends BaseController
{
  use ResponseTrait;

  public function index()
  {
    $session = \Config\Services::session();
    if (!$session->has('id'))
      return view('auth/login');

    $userId = $session->get('id');
    $model = new Transactions();
    $data['transactions'] = $model->where('user_id', $userId)->findAll();

    $bike = new Bikes();
    $cart = new CartProducts();
    for ($i = 0; $i < count($data['transactions']); $i++) {
      $data['transactions'][$i]['product'] = $cart->where('cart_id', $data['transactions'][$i]['cart_id'])->first();
      $data['transactions'][$i]['bike'] = $bike->where('id', $data['transactions'][$i]['product']['bike_id'])->first();
    }

    // $data['transactions'] = $model->select('transactions.id as transaction_id, transactions.*, cart_products.*')
    //   ->join('cart_products', 'cart_products.cart_id = transactions.cart_id')->where('transactions.user_id', $userId)->findAll();

    return view('transaction/history', $data);
  }

  public function show($id)
  {
    $session = \Config\Services::session();
    if (!$session->has('id'))
      return view('auth/login');

    $transaction = new Transactions();
    $user = new Users();
    $data['transaction'] = $transaction->find($id);
    $data['user'] = $user->find($data['transaction']['user_id']);
    if (!$data['transaction']) {
      return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }
    if (!$data['user']) {
      return redirect()->back()->with('error', 'User tidak ditemukan');
    }

    $products = new CartProducts();
    $data['products'] = $products->select('cart_products.id as product_id, cart_products.*, bikes.*')
      ->join('bikes', 'bikes.id = cart_products.bike_id')->where('cart_products.cart_id', $data['transaction']['cart_id'])->findAll();

    return view('transaction/detail', $data);
  }

  public function prepare()
  {
    $session = \Config\Services::session();
    if (!$session->has('id'))
      return view('auth/login');

    $userId = $session->get('id');
    $cartId = $this->request->getVar('cart_id');

    $user = new Users();
    if (!$user->find($userId)) {
      return redirect()->back()->with('error', 'ID Pengguna tidak valid');
    }

    $cart = new CartProducts();
    $data['products'] = $cart->select('cart_products.id as product_id, cart_products.*, bikes.*')
      ->join('bikes', 'bikes.id = cart_products.bike_id')->where('cart_products.cart_id', $cartId)->findAll();

    if (count($data['products']) <= 0) {
      return redirect()->back()->with('error', 'Keranjang kosong');
    }

    $priceSum = 0;
    foreach ($data['products'] as $pr) {
      $priceSum += $pr['total_price'];
    }
    $data['total_price'] = $priceSum;
    $data['cart_id'] = $cartId;
    $data['address'] = $user->where('id', $userId)->first()['address'];

    return view('transaction/confirm', $data);
  }

  public function payment()
  {
    $session = \Config\Services::session();
    if (!$session->has('id'))
      return view('auth/login');

    $data = [
      'id' => Uuid::uuid(),
      'user_id' => $session->get('id'),
      'cart_id' => $this->request->getVar('cart_id'),
      'address' => $this->request->getVar('address'),
      'payment_method' => $this->request->getVar('payment_method'),
      'total_price' => $this->request->getVar('total_price'),
    ];

    $userModel = new Users();
    $user = $userModel->where('id', $data['user_id'])->first();
    if (!$user) {
      return redirect()->back()->with('error', 'ID Pengguna tidak valid');
    }

    $cart = new CartProducts();
    $data['products'] = $cart->select('cart_products.id as product_id, cart_products.*, bikes.*')
      ->join('bikes', 'bikes.id = cart_products.bike_id')->where('cart_products.cart_id', $data['cart_id'])->findAll();

    $bike = new Bikes();
    foreach ($data['products'] as $pr) {
      $curStock = $bike->where('id', $pr['bike_id'])->first()['stock'];
      $bike->update($pr['bike_id'], ['stock' => $curStock - $pr['count']]);
    }

    $trans = new Transactions();
    $trans->insert($data);

    $editUser = [
      'cart_id' => (string) Uuid::uuid(),
    ];
    $userModel->update($data['user_id'], $editUser);

    return redirect()->route('transaction.history');
  }

  public function delete($id)
  {
    $model = new Transactions();
    $data = $model->find($id);

    if ($data) {
      $model->delete($id);
    } else {
      return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }
  }
}
