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

  public function prepare()
  {
    $transaction = [
      'user_id' => $this->request->getVar('user_id'),
      'bike_id' => $this->request->getVar('bike_id'),
      'total_price' => $this->request->getVar('total_price'),
      'count' => $this->request->getVar('count'),
    ];

    $user = new Users();
    if (!$user->find($transaction['user_id'])) {
      return redirect()->back()->with('error', 'ID Pengguna tidak valid');
    }

    $bike = new Bikes();
    if (!$bike->find($transaction['bike_id'])) {
      return redirect()->back()->with('error', 'ID Buku tidak valid');
    }

    $data['transaction'] = $transaction;
    $data['bike'] = $bike->where('id', $transaction['bike_id'])->first();
    $data['address'] = $user->where('id', $transaction['user_id'])->first()['address'];

    return view('transaction/confirm', $data);
  }

  public function payment()
  {
    $data = [
      'id' => Uuid::uuid(),
      'user_id' => $this->request->getVar('user_id'),
      'bike_id' => $this->request->getVar('bike_id'),
      'total_price' => $this->request->getVar('total_price'),
      'count' => $this->request->getVar('count'),
      'address' => $this->request->getVar('address'),
      'payment_method' => $this->request->getVar('payment_method'),
    ];

    $trans = new Transactions();
    $trans->insert($data);

    $bike = new Bikes();
    $curStock = $bike->where('id', $data['bike_id'])->first()['stock'];
    $bike->update($data['bike_id'], ['stock' => $curStock - $data['count']]);

    return redirect()->route('transaction.history');
  }

  public function update($id)
  {
    $model = new Transactions();
    $data = [
      'user_id' => $this->request->getVar('user_id'),
      'bike_id' => $this->request->getVar('bike_id'),
      'total_price' => $this->request->getVar('total_price'),
      'count' => $this->request->getVar('count'),
    ];

    $user = new Users();
    if (!$user->find($data['user_id'])) {
      return redirect()->back()->with('error', 'ID Pengguna tidak valid');
    }

    $bike = new Bikes();
    if (!$bike->find($data['bike_id'])) {
      return redirect()->back()->with('error', 'ID Buku tidak valid');
    }

    $model->update($id, $data);
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
