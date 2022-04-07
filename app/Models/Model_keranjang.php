<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $builder->select('id_keranjang, nama_kamar, kamar.id_kamar, tanggal_masuk, tanggal_keluar, total_biaya');
        $builder->join('kamar', 'kamar.id_kamar = keranjang.id_kamar');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('keranjang')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $builder->select("id_keranjang, nama_kamar, kamar.id_kamar, tanggal_masuk, tanggal_keluar, total_biaya");
        $builder->join('kamar', 'kamar.id_kamar = keranjang.id_kamar');
        $builder->where('id_keranjang', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $builder->where('id_keranjang', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $builder->where('id_keranjang', $id);
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
        $db      = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $builder->select('id_keranjang, nama_kamar, kamar.id_kamar, tanggal_masuk, tanggal_keluar, total_biaya');
        $builder->join('kamar', 'kamar.id_kamar = keranjang.id_kamar');
        $builder->join('pemesanan', 'pemesanan.id_pemesanan = keranjang.id_pemesanan');
        $builder->where('pemesanan.status_pemesanan !=','selesai');
        $builder->where('pemesanan.id_pemesanan', $id);
        return $builder->get();
    }

    public function view_data_keranjang($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $builder->select('id_keranjang, nama_kamar, kamar.id_kamar, tanggal_masuk, tanggal_keluar, id_pengguna, total_biaya');
        $builder->join('kamar', 'kamar.id_kamar = keranjang.id_kamar');
        $builder->where('keranjang.id_pengguna', $id);
        return $builder->get();
    }

}
