<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_tempat extends Model
{
    protected $table = 'tempat';
    protected $primaryKey = 'id_tempat';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tempat');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('tempat')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tempat');
        $builder->where('id_tempat', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tempat');
        $builder->where('id_tempat', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tempat');
        $builder->where('id_tempat', $id);
        return $builder->delete();
    }
}
