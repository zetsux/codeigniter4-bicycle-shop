<?php

namespace App\Models;

use CodeIgniter\Model;

class CartProducts extends Model
{
  protected $DBGroup = 'default';
  protected $table = 'cart_products';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = false;
  protected $returnType = 'array';
  protected $useSoftDeletes = false;
  protected $protectFields = true;
  protected $allowedFields = [
    'id',
    'cart_id',
    'bike_id',
    'count',
    'color',
    'total_price',
  ];

  // Dates
  protected $useTimestamps = false;
  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  // Validation
  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;
  protected $cleanValidationRules = true;

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert = [];
  protected $afterInsert = [];
  protected $beforeUpdate = [];
  protected $afterUpdate = [];
  protected $beforeFind = [];
  protected $afterFind = [];
  protected $beforeDelete = [];
  protected $afterDelete = [];
}
