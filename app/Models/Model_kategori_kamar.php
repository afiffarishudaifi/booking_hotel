<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_kategori_kamar extends Model
{
    protected $table = 'kategori_kamar';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = [
        'id_kategori', 'nama_kategori'
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
        $builder->where('id_kategori', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        $builder->where('id_kategori', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        $builder->where('id_kategori', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        $builder->join('kamar', 'kamar.id_kategori = kategori_kamar.id_kategori');
        $builder->where('kategori_kamar.id_kategori', $id);
        return $builder->countAllResults();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        $builder->select('id_kategori');
        $builder->where('nama_kategori', $nama);
        return $builder->get();
    }

}
