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
        $builder->select('pemesanan.id, pemesanan.tanggal_pesan, pemesanan.id_pengguna, pengguna.nama_lengkap, pemesanan.id_kamar, kamar.nama_kamar, pemesanan.tanggal_masuk, pemesanan.tanggal_keluar, pemesanan.status_pemesanan, total_biaya');
        $builder->join('pengguna', 'pengguna.id = pemesanan.id_pengguna');
        $builder->join('kamar', 'kamar.id = pemesanan.id_kamar');
        $builder->where('pemesanan.status_pemesanan !=','selesai');
        return $builder->get();
    }

    public function view_data_konfirmasi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id, pemesanan.tanggal_pesan, pemesanan.id_pengguna, pengguna.nama_lengkap, pemesanan.id_kamar, kamar.nama_kamar, pemesanan.tanggal_masuk, pemesanan.tanggal_keluar, pemesanan.status_pemesanan, total_biaya');
        $builder->join('pengguna', 'pengguna.id = pemesanan.id_pengguna');
        $builder->join('kamar', 'kamar.id = pemesanan.id_kamar');
        $builder->where('status_pemesanan','pengajuan');
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
        $builder->select("pemesanan.id, pemesanan.tanggal_pesan, pemesanan.id_pengguna, pengguna.nama_lengkap, pemesanan.id_kamar, kamar.nama_kamar, DATE_FORMAT(pemesanan.tanggal_masuk, '%Y-%m-%dT%H:%i') as tanggal_masuk, DATE_FORMAT(pemesanan.tanggal_keluar, '%Y-%m-%dT%H:%i') as tanggal_keluar, pemesanan.status_pemesanan, total_biaya");
        $builder->join('pengguna', 'pengguna.id = pemesanan.id_pengguna');
        $builder->join('kamar', 'kamar.id = pemesanan.id_kamar');
        $builder->where('pemesanan.id', $id);
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
        $builder->where('status_kamar','kosong');
        return $builder->get();
    }

    public function biaya_kamar($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('biaya');
        $builder->where('id',$id);
        return $builder->get();
    }

}