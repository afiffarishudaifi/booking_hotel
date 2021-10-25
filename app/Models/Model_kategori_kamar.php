<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_kategori_kamar extends Model
{
    protected $table = 'kategori_kamar';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'nama_kategori'
    ];

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('kategori_kamar')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        $builder->where('id', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        $builder->where('id', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        $builder->where('id', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        $builder->join('kamar', 'kamar.id_kategori = kategori_kamar.id');
        $builder->where('kategori_kamar.id', $id);
        return $builder->countAllResults();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        $builder->select('id');
        $builder->where('nama_kategori', $nama);
        return $builder->get();
    }

}