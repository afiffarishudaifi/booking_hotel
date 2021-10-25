<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id, pemesanan.tanggal_pesan, pemesanan.id_pengguna, pengguna.nama_lengkap, pemesanan.id_kamar, kamar.nama_kamar');
        $builder->join('pengguna', 'pengguna.id = pemesanan.id_pengguna');
        $builder->join('kamar', 'kamar.id = pemesanan.id_kamar');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('pemesanan')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('id', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('id', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('id', $id);
        return $builder->delete();
    }

    public function data_pengguna()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        return $builder->get();
    }

    public function data_kamar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        return $builder->get();
    }

}