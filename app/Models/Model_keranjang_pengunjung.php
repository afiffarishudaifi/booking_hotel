<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_keranjang_pengunjung extends Model
{
    protected $table = 'detail_keranjang_pengunjung';
    protected $primaryKey = 'id_detail_keranjang';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keranjang_pengunjung');
        $builder->select('id_detail_keranjang, nama, jenis_kelamin');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('detail_keranjang_pengunjung')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keranjang_pengunjung');
        $builder->select("id_detail_keranjang, nama, jenis_kelamin");
        $builder->where('id_detail_keranjang', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keranjang_pengunjung');
        $builder->where('id_detail_keranjang', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keranjang_pengunjung');
        $builder->where('id_detail_keranjang', $id);
        return $builder->delete();
    }

    public function cari_keranjang_pengunjung($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keranjang_pengunjung');
        $builder->select("id_detail_keranjang, nama, jenis_kelamin");
        $builder->where('id_keranjang', $id);
        return $builder->get();
    }

    public function delete_data_keranjang_pengunjung($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keranjang_pengunjung');
        $builder->where('id_keranjang', $id);
        return $builder->delete();
    }
}
