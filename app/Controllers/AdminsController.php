<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Bikes;
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
}
