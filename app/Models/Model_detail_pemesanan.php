<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_detail_pemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $primaryKey = 'id_detail';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pemesanan');
        $builder->select('id_detail, nama_kamar, kamar.id_kamar, tanggal_masuk, tanggal_keluar, total_biaya');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('detail_pemesanan')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pemesanan');
        $builder->select("id_detail, nama_kamar, kamar.id_kamar, tanggal_masuk, tanggal_keluar, total_biaya");
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->where('id_detail', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pemesanan');
        $builder->where('id_detail', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pemesanan');
        $builder->where('id_detail', $id);
        return $builder->delete();
    }

    public function biaya_kamar($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('biaya');
        $builder->where('id_kamar',$id);
        return $builder->get();
    }

    // customer
    public function view_data_customer($id)
    {
        // $db      = \Config\Database::connect();
        // $builder = $db->table('pemesanan');
        // $builder->select('pemesanan.id_pemesanan, pemesanan.tanggal_pesan, pemesanan.id_pengguna, pengunjung.nama_lengkap, pemesanan.id_kamar, kamar.nama_kamar, pemesanan.tanggal_masuk, pemesanan.tanggal_keluar, pemesanan.status_pemesanan, total_biaya');
        // $builder->join('pengunjung', 'pengguna.id_pengguna = pemesanan.id_pengguna');
        // $builder->join('kamar', 'kamar.id_kamar = pemesanan.id_kamar');
        // $builder->where('pemesanan.status_pemesanan !=','selesai');
        // $builder->where('pemesanan.id_pengguna', $id);
        // return $builder->get();
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pemesanan');
        $builder->select('id_detail, nama_kamar, kamar.id_kamar, tanggal_masuk, tanggal_keluar, total_biaya');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->join('pemesanan', 'pemesanan.id_pemesanan = detail_pemesanan.id_pemesanan');
        $builder->where('pemesanan.status_pemesanan !=','selesai');
        $builder->where('pemesanan.id_pemesanan', $id);
        return $builder->get();
    }

    public function view_data_keranjang($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $builder->select('id_keranjang, nama_kamar, kamar.id_kamar, tanggal_masuk, tanggal_keluar, id_user, total_biaya');
        $builder->join('kamar', 'kamar.id_kamar = keranjang.id_kamar');
        $builder->where('keranjang.id_user', $id);
        return $builder->get();
    }

}
