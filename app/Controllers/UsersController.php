<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\API\ResponseTrait;
use Faker\Provider\Uuid;

class UsersController extends BaseController
{
  use ResponseTrait;

  public function index()
  {
    $model = new Users();
    $data = $model->findAll();
    $response = [
      'status' => 200,
      'error' => null,
      'messages' => 'Data Found',
      'data' => $data
    ];

    return $this->respond($response);
  }

  public function me($id)
  {
    $model = new Users();
    $data = $model->where('id', $id)->first();
    $response = [
      'status' => 200,
      'error' => null,
      'messages' => 'Data Found',
      'data' => $data
    ];

    return $this->respond($response);
  }

  public function create()
  {
    $uuid = (string) Uuid::uuid();
    $cartId = (string) Uuid::uuid();

    $data = [
      'id' => $uuid,
      'username' => $this->request->getVar('username'),
      'email' => $this->request->getVar('email'),
      'password' => $this->request->getVar('password'),
      'address' => $this->request->getVar('address'),
      'phone' => $this->request->getVar('phone'),
      'role' => 'user',
      'cart_id' => $cartId,
    ];

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $model = new Users();

    $user = $model->where('email', $data['email'])->first();
    if ($user) {
      return redirect()->back()->with('error', 'Email sudah digunakan');
    }

    $model->insert($data);
    return view('auth/login');
  }

  public function login()
  {
    $model = new Users();
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');
    $data = $model->where('email', $email)->first();
    if ($data) {
      $verify_pass = password_verify($password, $data['password']);

      if ($verify_pass) {
        $session = \Config\Services::session();
        $session->set('id', $data['id']);
        $session->set('username', $data['username']);
        $session->set('role', $data['role']);
        return redirect()->route('home.index');
      } else
        return redirect()->back()->with('error', 'Password salah');
    } else
      return redirect()->back()->with('error', 'Email salah');
  }

  public function update($id)
  {
    $model = new Users();
    $data = [
      'username' => $this->request->getVar('username'),
      'email' => $this->request->getVar('email'),
      'password' => $this->request->getVar('password'),
      'address' => $this->request->getVar('address'),
      'phone' => $this->request->getVar('phone'),
      'role' => $this->request->getVar('role'),
    ];

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $model->update($id, $data);
  }

  public function delete($id)
  {
    $model = new Users();
    $data = $model->find($id);
    if ($data)
      $model->delete($id);
    else
      return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
  }
}
