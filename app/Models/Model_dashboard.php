<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_dashboard extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';

    public function pemesanan($params)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('date(tanggal_pesan) >=', $params['awal']);
        $builder->where('date(tanggal_pesan) <=', $params['akhir']);
        $builder->groupBy('date(tanggal_pesan)');
        $builder->select('date(tanggal_pesan)');
        $builder->selectCount('id');
        $builder->where('status_pemesanan', 'selesai');
        return $builder->get();
    }

    public function total_pengguna()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $builder->selectCount('id');
        return $builder->get();
    }

    public function total_kamar_kosong()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->selectCount('id');
        $builder->where('status_kamar', 'kosong');
        return $builder->get();
    }

    public function total_kamar_terisi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->selectCount('id');
        $builder->where('status_kamar', 'terisi');
        return $builder->get();
    }

    public function total_pemesanan_bulan_ini()
    {
        date_default_timezone_set('Asia/Jakarta');
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->selectCount('id');
        $builder->where('status_pemesanan', 'selesai');
        $builder->where('month(tanggal_pesan)', date('m'));
        return $builder->get();
    }

    public function jumlah_pemesanan()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->selectCount('id');
        $builder->where('status_pemesanan', 'Pengajuan');
        return $builder->get();
    }

}