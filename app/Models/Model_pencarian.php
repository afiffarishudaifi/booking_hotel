<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pencarian extends Model
{

    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    // ======= PENGADUAN ======= //

    public function cek_kamar($params)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('detail_pemesanan');
        $builder->select('kamar.id_kamar');

        if ($params['input_masuk'] != '') {
            $builder->where('detail_pemesanan.tanggal_keluar >', $params['input_masuk']);
        }
        $builder->where('kamar.isi <=', 2);
        $builder->join('kamar','detail_pemesanan.id_kamar = kamar.id_kamar');
        return $builder->get();
    }

    public function view_data($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('kamar.id_kamar as id_kamar, nama_kamar, biaya, kategori_kamar.nama_kategori, kategori_kamar.id_kategori as id_kategori, kamar.status_kamar, foto.nama_foto');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori = kamar.id_kategori');
        $builder->join('foto','kamar.id_kamar = foto.id_kamar');
        if (count($id) != 0) {
            $builder->whereNotIn('kamar.id_kamar',$id);
        }
        $builder->groupBy('kamar.id_kamar');
        return $builder->get();
    }

    public function view_data_filter($param)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan, pemesanan.tanggal_pesan, pengguna.nama_lengkap, kategori_kamar.nama_kategori, pemesanan.status_pemesanan');
        $builder->join('pengguna', 'pengguna.id=pemesanan.id_pengguna');
        $builder->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan=pemesanan.id_pemesanan');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori = kamar.id_kategori');
        $builder->where('pengguna.id_pengguna', $param['id_pengguna']);

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

    public function detail_kamar($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('kamar.id_kamar as id_kamar, nama_kamar, biaya, kategori_kamar.nama_kategori, kategori_kamar.id_kategori as id_kategori, kategori_kamar.deskripsi as deskripsi, isi');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori=kamar.id_kategori');
        $builder->where('kamar.id_kamar', $id);
        return $builder->get();
    }

    public function detail_fasilitas($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('detail_kamar');
        $builder->select('fasilitas.nama_fasilitas');
        $builder->join('fasilitas', 'detail_kamar.id_fasilitas = fasilitas.id_fasilitas');
        $builder->where('detail_kamar.id_kamar', $id);
        return $builder->get();
    }

    public function detail_foto($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('foto');
        $builder->select('foto.nama_foto');
        $builder->where('foto.id_kamar', $id);
        return $builder->get();
    }

    public function detail_foto_limit($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('foto');
        $builder->select('foto.nama_foto');
        $builder->where('foto.id_kamar', $id);
        $builder->limit(1);
        return $builder->get();
    }

}
