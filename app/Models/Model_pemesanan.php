<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan, pengunjung.nama_lengkap, tanggal_pesan, status_pemesanan, bukti_transaksi');
        $builder->join('pengunjung', 'pengunjung.id_pengguna = pemesanan.id_pengguna');
        $builder->where('pemesanan.status_pemesanan !=','selesai');
        return $builder->get();
    }

    public function view_data_konfirmasi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan, pengunjung.nama_lengkap, tanggal_pesan, status_pemesanan, bukti_transaksi, SUM(detail_pemesanan.total_biaya) as total_tagihan');
        $builder->join('pengunjung', 'pengunjung.id_pengguna = pemesanan.id_pengguna');
        $builder->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'left');
        $builder->groupBy('detail_pemesanan.id_pemesanan');
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
        $builder->select("pemesanan.id_pemesanan, pemesanan.id_pengguna, pengunjung.nama_lengkap, DATE_FORMAT(pemesanan.tanggal_pesan, '%Y-%m-%dT%H:%i') as tanggal_pesan, pemesanan.status_pemesanan, bukti_transaksi, SUM(detail_pemesanan.total_biaya) as total_tagihan");
        $builder->join('pengunjung', 'pengunjung.id_pengguna = pemesanan.id_pengguna');
        $builder->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'left');
        $builder->groupBy('detail_pemesanan.id_pemesanan');
        $builder->where('pemesanan.id_pemesanan', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('id_pemesanan', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('id_pemesanan', $id);
        return $builder->delete();
    }

    public function data_pengguna()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
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

    // customer
    public function view_data_customer($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan, pemesanan.tanggal_pesan, pemesanan.id_pengguna, pengunjung.nama_lengkap, pemesanan.id_kamar, kamar.nama_kamar, pemesanan.tanggal_masuk, pemesanan.tanggal_keluar, pemesanan.status_pemesanan, total_biaya');
        $builder->join('pengunjung', 'pengguna.id_pengguna = pemesanan.id_pengguna');
        $builder->join('kamar', 'kamar.id_kamar = pemesanan.id_kamar');
        $builder->where('pemesanan.status_pemesanan !=','selesai');
        $builder->where('pemesanan.id_pengguna', $id);
        return $builder->get();
    }

}
