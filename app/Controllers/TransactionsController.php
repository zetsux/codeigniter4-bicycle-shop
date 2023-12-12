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
    $data['transactions'] = $model->select('transactions.id as transaction_id, transactions.*, cart_products.*')
      ->join('cart_products', 'cart_products.cart_id = transactions.cart_id')->where('transactions.user_id', $userId)->findAll();

    return view('transaction/history', $data);
  }

  public function show($id)
  {
    $transaction = new Transactions();
    $data['transaction'] = $transaction->where('id', $id)->first();

    $products = new CartProducts();
    $data['products'] = $products->where('cart_id', $data['transaction']['cart_id'])->findAll();

    return view('transaction/detail', $data);
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
    ];

    $userModel = new Users();
    $user = $userModel->where('id', $data['user_id'])->first();
    if (!$user) {
      return redirect()->back()->with('error', 'ID Pengguna tidak valid');
    }

    $cpModel = new CartProducts();
    $cartProducts = $cpModel->where('cart_id', $data['cart_id'])->findAll();
    if (!$cartProducts) {
      return redirect()->back()->with('error', 'Keranjang belanja kosong');
    }

    $bike = new Bikes();
    $priceSum = 0;
    foreach ($cartProducts as $pr) {
      $priceSum += $pr['total_price'];

      $curStock = $bike->where('id', $pr['bike_id'])->first()['stock'];
      $bike->update($pr['bike_id'], ['stock' => $curStock - $pr['count']]);
    }
    $data['total_price'] = $priceSum;

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
