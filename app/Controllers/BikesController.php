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
        $data['bikes'] = $model->findAll();

        // return $this->respond($response);
        return view('welcome_message', $data);
    }

    public function show($id)
    {
        $model = new Bikes();
        $data['bike'] = $model->where('id', $id)->first();

        // return $this->respond($response);
        return view('bike/detail', $data);
    }

    public function create()
    {
        $data = [
            'id' => Uuid::uuid(),
            'brand' => $this->request->getVar('brand'),
            'name' => $this->request->getVar('name'),
            'category' => $this->request->getVar('category'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),
            'color' => $this->request->getVar('color'),
            'image' => $this->request->getVar('image'),
        ];

        $model = new Bikes();
        $model->insert($data);
    }

    public function update($id)
    {
        $model = new Bikes();
        $data = [
            'brand' => $this->request->getVar('brand'),
            'name' => $this->request->getVar('name'),
            'category' => $this->request->getVar('category'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),
            'color' => $this->request->getVar('color'),
            'image' => $this->request->getVar('image'),
        ];

        $model->update($id, $data);
    }

    public function delete($id)
    {
        $model = new Bikes();
        $data = $model->find($id);

        if ($data)
            $model->delete($id);
        else
            return redirect()->back()->with('error', 'Sepeda tidak ditemukan');
    }
}
