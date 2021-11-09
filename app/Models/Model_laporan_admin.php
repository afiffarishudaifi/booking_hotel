<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_laporan_admin extends Model
{

    protected $table = 'pemesanan';
    protected $primaryKey = 'id';
    // ======= PENGADUAN ======= //

    public function view_data()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id, pemesanan.tanggal_pesan, pengguna.nama_lengkap, kategori_kamar.nama_kategori, pemesanan.status_pemesanan');
        $builder->join('pengguna', 'pengguna.id=pemesanan.id_pengguna');
        $builder->join('kamar', 'kamar.id = pemesanan.id_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id = kamar.id_kategori');
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

     public function view_data_pendapatan()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select("pemesanan.id, sum(total_biaya) as total, DATE_FORMAT(pemesanan.tanggal_pesan, '%M') as tanggal");
        $builder->join('kamar', 'kamar.id = pemesanan.id_kamar');
        $builder->groupBy('MONTH(tanggal_pesan)');
        $builder->join('kategori_kamar', 'kategori_kamar.id = kamar.id_kategori');
        return $builder->get();
    }

    public function view_data_filter_pendapatan($param)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select("pemesanan.id, sum(total_biaya) as total, DATE_FORMAT(pemesanan.tanggal_pesan, '%M') as tanggal");
        $builder->join('kamar', 'kamar.id = pemesanan.id_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id = kamar.id_kategori');
        $builder->groupBy('MONTH(tanggal_pesan)');

        if ($param['id_kategori']) $builder->where('kamar.id', $param['id_kategori']);
        if ($param['cek_waktu1']) $builder->where('DATE(tanggal_pesan) >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('DATE(tanggal_pesan) <= ', $param['cek_waktu2']);
        if ($param['status_pemesanan']) $builder->where('status_pemesanan', $param['status_pemesanan']);

        return $builder->get();
    }

}