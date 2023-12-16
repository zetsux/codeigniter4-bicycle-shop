<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Bikes;
use Faker\Provider\Uuid;

class BikesController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new Bikes();
        $data['bikes'] = $model->orderBy('created_at', 'DESC')->findAll();

        return view('welcome_message', $data);
    }

    public function show($id)
    {
        $model = new Bikes();
        $data['bike'] = $model->find($id);

        if (!$data['bike']) {
            return redirect()->back()->with('error', 'Sepeda tidak ditemukan');
        }

        // return $this->respond($response);
        return view('bike/detail', $data);
    }

    public function create()
    {
        $session = \Config\Services::session();
        if (!$session->has('id'))
            return view('auth/login');

        if ($session->get('role') != 'admin')
            return redirect()->back()->with('error', 'Akses ditolak');

        $data = [
            'id' => Uuid::uuid(),
            'brand' => $this->request->getVar('brand'),
            'name' => $this->request->getVar('name'),
            'category' => $this->request->getVar('category'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),
            'image' => $this->request->getVar('image'),
        ];

        $model = new Bikes();
        $model->insert($data);

        return redirect()->to('/admin/bike');
    }

    public function update($id)
    {
        $session = \Config\Services::session();
        if (!$session->has('id'))
            return view('auth/login');

        if ($session->get('role') != 'admin')
            return redirect()->back()->with('error', 'Akses ditolak');

        $model = new Bikes();
        $data = [
            'brand' => $this->request->getVar('brand'),
            'name' => $this->request->getVar('name'),
            'category' => $this->request->getVar('category'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),
            'image' => $this->request->getVar('image'),
        ];

        $model->update($id, $data);
        return redirect()->to('/admin/bike');
    }

    public function delete($id)
    {
        $session = \Config\Services::session();
        if (!$session->has('id'))
            return view('auth/login');

        if ($session->get('role') != 'admin')
            return redirect()->back()->with('error', 'Akses ditolak');

        $model = new Bikes();
        $data = $model->find($id);

        if ($data) $model->delete($id);
        else return redirect()->back()->with('error', 'Sepeda tidak ditemukan');

        return redirect()->to('/admin/bike');
    }
}
