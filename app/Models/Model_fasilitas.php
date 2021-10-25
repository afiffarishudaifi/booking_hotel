<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $primaryKey = 'id';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('fasilitas');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('fasilitas')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('fasilitas');
        $builder->where('id', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('fasilitas');
        $builder->where('id', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('fasilitas');
        $builder->where('id', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('fasilitas');
        $builder->select('id');
        $builder->where('nama_fasilitas', $nama);
        return $builder->get();
    }
}