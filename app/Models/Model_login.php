<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_login extends Model
{
    protected $table= 'pengguna';
    protected $primaryKey ='id';
    protected $useTimestamps = true;

    public function getLogin($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $query = $builder->getWhere($data);
        return $query;
    }

    public function addProfile($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $query =  $builder->insert($data);
     
        return $query;
    }

}
