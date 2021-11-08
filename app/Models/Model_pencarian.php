<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pencarian extends Model
{

    protected $table = 'kamar';
    protected $primaryKey = 'id';
    // ======= PENGADUAN ======= //

    public function view_data($params)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('kamar.id as id_kamar, nama_kamar, biaya, kategori_kamar.nama_kategori, kategori_kamar.id as id_kategori');
        $builder->join('kategori_kamar', 'kategori_kamar.id=kamar.id_kategori');
        $builder->join('pemesanan','kamar.id = pemesanan.id_kamar');
        // $builder->where('pemesanan.tanggal_masuk > ', $params['input_masuk']);
        // $builder->where('pemesanan.tanggal_keluar < ', $params['input_keluar']);
        $builder->where('kategori_kamar.id', $params['input_kategori']);
        $builder->where('kamar.status_kamar', 'kosong');
        return $builder->get();
    }

    public function view_data_filter($param)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id, pemesanan.tanggal_pesan, pengguna.nama_lengkap, kategori_kamar.nama_kategori, pemesanan.status_pemesanan');
        $builder->join('pengguna', 'pengguna.id=pemesanan.id_pengguna');
        $builder->join('kamar', 'kamar.id = pemesanan.id_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id = kamar.id_kategori');
        $builder->where('pengguna.id', $param['id_pengguna']);

        if ($param['id_kategori']) $builder->where('kamar.id', $param['id_kategori']);
        if ($param['cek_waktu1']) $builder->where('DATE(tanggal_pesan) >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('DATE(tanggal_pesan) <= ', $param['cek_waktu2']);
        if ($param['status_pemesanan']) $builder->where('status_pemesanan', $param['status_pemesanan']);

        return $builder->get();
    }

    public function data_kategori()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        return $builder->get();
    }

}