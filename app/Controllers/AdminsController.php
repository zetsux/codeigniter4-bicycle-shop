<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Bikes;
use App\Models\CartProducts;
use App\Models\Transactions;
use App\Models\Users;
use CodeIgniter\API\ResponseTrait;
use Faker\Provider\Uuid;

class AdminsController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $session = \Config\Services::session();
        if (!$session->has('id'))
            return view('auth/login');

        if ($session->get('role') != 'admin')
            return redirect()->back()->with('error', 'Akses ditolak');

        $bike = new Bikes();
        $data['bikes'] = $bike->orderBy('created_at', 'DESC')->findAll();

        return view('/admin/bike', $data);
    }

    public function add()
    {
        $session = \Config\Services::session();
        if (!$session->has('id'))
            return view('auth/login');

        if ($session->get('role') != 'admin')
            return redirect()->back()->with('error', 'Akses ditolak');

        return view('/admin/bike-add');
    }

    public function update($id)
    {
        $session = \Config\Services::session();
        if (!$session->has('id'))
            return view('auth/login');

        if ($session->get('role') != 'admin')
            return redirect()->back()->with('error', 'Akses ditolak');

        $bike = new Bikes();
        $data['bike'] = $bike->find($id);

        return view('/admin/bike-update', $data);
    }

    public function sales()
    {
        $session = \Config\Services::session();
        if (!$session->has('id'))
            return view('auth/login');
        if ($session->get('role') != 'admin')
            return redirect()->back()->with('error', 'Akses ditolak');

        $model = new Transactions();
        $user = new Users();
        $data['transactions'] = $model->findAll();

        $bike = new Bikes();
        $cart = new CartProducts();
        for ($i = 0; $i < count($data['transactions']); $i++) {
            $data['transactions'][$i]['product'] = $cart->where('cart_id', $data['transactions'][$i]['cart_id'])->first();
            $data['transactions'][$i]['bike'] = $bike->where('id', $data['transactions'][$i]['product']['bike_id'])->first();
            $data['transactions'][$i]['user'] = $user->where('id', $data['transactions'][$i]['user_id'])->first();
        }

        return view('admin/sales', $data);
    }
}
