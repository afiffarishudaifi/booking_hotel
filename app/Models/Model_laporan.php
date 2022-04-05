<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_laporan extends Model
{

    protected $table = 'pemesanan';
    protected $primaryKey = 'id';
    // ======= PENGADUAN ======= //

    public function view_data($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan, pemesanan.tanggal_pesan, pengunjung.nama_lengkap, kategori_kamar.nama_kategori, pemesanan.status_pemesanan');
        $builder->join('pengunjung', 'pengunjung.id_pengguna=pemesanan.id_pengguna');
        $builder->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori = kamar.id_kategori');
        // $builder->join('kategori_kamar', 'kategori_kamar.id = kamar.id_kategori');
        $builder->where('pengunjung.id_pengguna',$id);
        return $builder->get();
    }

    public function view_data_filter($param)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan, pemesanan.tanggal_pesan, pengunjung.nama_lengkap, kategori_kamar.nama_kategori, pemesanan.status_pemesanan');
        $builder->join('pengunjung', 'pengunjung.id_pengguna=pemesanan.id_pengguna');
        $builder->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori = kamar.id_kategori');
        $builder->where('pengunjung.id_pengguna', $param['id_pengguna']);

        if ($param['id_kategori']) $builder->where('kamar.id_kategori', $param['id_kategori']);
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
