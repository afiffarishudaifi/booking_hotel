<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'id';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('kamar')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('kamar.id as id, kamar.nama_kamar, kamar.status_kamar, kategori_kamar.id as id_kategori, kategori_kamar.nama_kategori, biaya');
        $builder->join('kategori_kamar', 'kamar.id_kategori = kategori_kamar.id');
        $builder->where('kamar.id', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->join('pemesanan', 'pemesanan.id_kamar = kamar.id');
        $builder->where('kamar.id', $id);
        return $builder->countAllResults();
    }

    public function data_kategori()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        return $builder->get();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('id');
        $builder->where('kamar.nama_kamar', $nama);
        return $builder->get();
    }

    public function data_edit_dropwdown($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('kategori_kamar.nama_kategori, kategori_kamar.id as id_kategori, kamar.id, kamar.nama_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id = kamar.id');
        $builder->where('kamar.id', $id);
        return $builder->get();
    }
}