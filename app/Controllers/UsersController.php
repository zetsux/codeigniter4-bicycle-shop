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
      'status'   => 200,
      'error'    => null,
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
      'status'   => 200,
      'error'    => null,
      'messages' => 'Data Found',
      'data' => $data
    ];

    return $this->respond($response);
  }

  public function create()
  {
    $uuid = (string) Uuid::uuid();

    $data = [
      'id' => $uuid,
      'username' => $this->request->getVar('username'),
      'email' => $this->request->getVar('email'),
      'password' => $this->request->getVar('password'),
      'address' => $this->request->getVar('address'),
      'phone' => $this->request->getVar('phone'),
      'role' => 'user',
    ];

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $model = new Users();

    $user = $model->where('email', $data['email'])->first();
    if ($user) {
      return redirect()->back()->with('error', 'Email sudah digunakan');
    }
    // if ($user) {
    //   $response = [
    //     'status'   => 500,
    //     'error'    => 'Email Already Exist',
    //     'messages' => 'Register Failed',
    //   ];
    //   return $this->respond($response);
    // }

    $model->insert($data);
    // $response = [
    //   'status'   => 201,
    //   'error'    => null,
    //   'messages' => 'Data Saved',
    //   'data' => $data
    // ];
    // return $this->respondCreated($response);
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
        // $response = [
        //   'status'   => 200,
        //   'error'    => null,
        //   'messages' => 'Login Success',
        //   'data' => $ses_data
        // ];
        // return $this->respond($response);
        $session = \Config\Services::session();
        $session->set('id', $data['id']);
        $session->set('username', $data['username']);
        $session->set('role', $data['role']);
        return redirect()->route('home.index');
      } else {
        // $response = [
        //   'status'   => 500,
        //   'error'    => 'Password Salah',
        //   'messages' => 'Login Failed',
        // ];
        // return $this->respond($response);
        return redirect()->back()->with('error', 'Password salah');
      }
    } else {
      // $response = [
      //   'status'   => 500,
      //   'error'    => 'Email Salah',
      //   'messages' => 'Login Failed',
      // ];
      // return $this->respond($response);
      return redirect()->back()->with('error', 'Email salah');
    }
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
    // $response = [
    //   'status'   => 200,
    //   'error'    => null,
    //   'messages' => 'Data Updated',
    //   'data' => $data
    // ];
    // return $this->respond($response);
  }

  public function delete($id)
  {
    $model = new Users();
    $data = $model->find($id);
    if ($data) {
      $model->delete($id);
      // $response = [
      //   'status'   => 200,
      //   'error'    => null,
      //   'messages' => 'Data Deleted',
      //   'data' => $data
      // ];
      // return $this->respondDeleted($response);
    } else {
      // $response = [
      //   'status'   => 500,
      //   'error'    => 'Data Not Found',
      //   'messages' => 'Data Not Found',
      // ];
      // return $this->respond($response);
      return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
    }
  }
}
