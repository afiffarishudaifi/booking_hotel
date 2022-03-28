<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_frontend extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');
        $builder->select('kamar.id_kamar as id, kamar.nama_kamar, kamar.status_kamar, kategori_kamar.nama_kategori, kamar.biaya, foto.nama_foto');
        $builder->join('kamar','foto.id_kamar = kamar.id_kamar');
        $builder->join('kategori_kamar', 'kamar.id_kategori = kategori_kamar.id_kategori');
        $builder->limit(4);
        $builder->groupBy('kamar.id_kamar');
        $builder->orderBy('kamar.id_kamar', 'RANDOM');
        $builder->where('kamar.status_kamar','kosong');
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
        $builder->select('kamar.id_kamar as id, kamar.nama_kamar, kamar.status_kamar, kategori_kamar.id as id_kategori, kategori_kamar.nama_kategori, biaya');
        $builder->join('kategori_kamar', 'kamar.id_kategori = kategori_kamar.id');
        $builder->where('kamar.id_kamar', $id);
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
        $builder->join('pemesanan', 'pemesanan.id_kamar = kamar.id_kamar');
        $builder->where('kamar.id_kamar', $id);
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
        $builder->join('kategori_kamar', 'kategori_kamar.id_kamar = kamar.id_kamar');
        $builder->where('kamar.id_kamar', $id);
        return $builder->get();
    }
}
