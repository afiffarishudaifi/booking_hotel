<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_laporan_admin extends Model
{

    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    // ======= PENGADUAN ======= //

    public function view_data()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan, pemesanan.tanggal_pesan, pengunjung.nama_lengkap, kategori_kamar.nama_kategori, pemesanan.status_pemesanan');
        $builder->join('pengunjung', 'pengunjung.id_pengguna = pemesanan.id_pengguna');
        $builder->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'left');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori = kamar.id_kategori');
        return $builder->get();
    }

    public function view_data_filter($param)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan, pemesanan.tanggal_pesan, pengunjung.nama_lengkap, kategori_kamar.nama_kategori, pemesanan.status_pemesanan');
        $builder->join('pengunjung', 'pengunjung.id_pengguna = pemesanan.id_pengguna');
        $builder->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'left');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori = kamar.id_kategori');

        if ($param['id_kategori']) $builder->where('kamar.id_kategori', $param['id_kategori']);
        if ($param['cek_waktu1']) $builder->where('DATE(tanggal_pesan) >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('DATE(tanggal_pesan) <= ', $param['cek_waktu2']);
        if ($param['status_pemesanan']) $builder->where('status_pemesanan', $param['status_pemesanan']);

        return $builder->get();
    }

     public function view_data_pendapatan()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select("pemesanan.id_pemesanan, sum(detail_pemesanan.total_biaya) as total, DATE_FORMAT(pemesanan.tanggal_pesan, '%M') as tanggal");
        $builder->join('detail_pemesanan','detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'right');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->groupBy('MONTH(tanggal_pesan)');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori = kamar.id_kategori');
        return $builder->get();
    }

    public function view_data_filter_pendapatan($param)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select("pemesanan.id_pemesanan, sum(detail_pemesanan.total_biaya) as total, DATE_FORMAT(pemesanan.tanggal_pesan, '%M') as tanggal");
        $builder->join('detail_pemesanan','detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'right');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori = kamar.id_kategori');
        $builder->groupBy('MONTH(tanggal_pesan)');

        if ($param['id_kategori']) $builder->where('kamar.id_kategori', $param['id_kategori']);
        if ($param['cek_waktu1']) $builder->where('DATE(tanggal_pesan) >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('DATE(tanggal_pesan) <= ', $param['cek_waktu2']);
        if ($param['status_pemesanan']) $builder->where('status_pemesanan', $param['status_pemesanan']);

        return $builder->get();
    }

}