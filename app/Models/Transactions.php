<?php

namespace App\Models;

use CodeIgniter\Model;

class Transactions extends Model
{
  protected $DBGroup = 'default';
  protected $table = 'transactions';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = false;
  protected $returnType = 'array';
  protected $useSoftDeletes = false;
  protected $protectFields = true;
  protected $allowedFields = [
    'id',
    'user_id',
    'cart_id',
    'address',
    'payment_method',
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
