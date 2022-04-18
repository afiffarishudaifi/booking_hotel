<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_dashboard extends Model
{
    // protected $table = 'pemesanan';
    // protected $primaryKey = 'id';

    public function pemesanan($params)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('date(tanggal_pesan) >=', $params['awal']);
        $builder->where('date(tanggal_pesan) <=', $params['akhir']);
        $builder->groupBy('date(tanggal_pesan)');
        $builder->select('date(tanggal_pesan) as tanggal_pesan');
        $builder->selectCount('id_pemesanan');
        $builder->where('status_pemesanan', 'selesai');
        return $builder->get();
    }

    public function total_pengguna()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $builder->selectCount('id_pengguna');
        return $builder->get();
    }

    public function total_kamar_kosong()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->selectCount('id_kamar');
        $builder->where('status_kamar', 'kosong');
        return $builder->get();
    }

    public function total_kamar_terisi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->selectCount('id_kamar');
        $builder->where('status_kamar', 'terisi');
        return $builder->get();
    }

    public function total_pemesanan_bulan_ini()
    {
        date_default_timezone_set('Asia/Jakarta');
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->selectCount('id_pemesanan');
        $builder->where('status_pemesanan', 'selesai');
        $builder->where('month(tanggal_pesan)', date('m'));
        return $builder->get();
    }

    public function jumlah_pemesanan()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->selectCount('id_pemesanan');
        $builder->where('status_pemesanan', 'pengajuan');
        return $builder->get();
    }

    public function cek_status_kamar($tanggal)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan as id, kamar.id_kamar as id_kamar, kamar.nama_kamar, detail_pemesanan.tanggal_keluar, pemesanan.status_pemesanan');
        $builder->join('detail_pemesanan','detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan');
        $builder->join('kamar','kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->where('detail_pemesanan.tanggal_keluar <', $tanggal);
        $builder->where('pemesanan.status_pemesanan','terkonfirmasi');
        return $builder->get();
    }

    public function update_status_pemesanan($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('id_pemesanan', $id);
        $builder->set('status_pemesanan','selesai');
        return $builder->update();
    }

    public function update_status_kamar($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id_kamar', $id);
        $builder->set('status_kamar','kosong');
        return $builder->update();
    }

    public function cek_status_pembayaran($tanggal)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pemesanan.id_pemesanan as id, kamar.id_kamar as id_kamar, kamar.nama_kamar, tanggal_pesan, pemesanan.status_pemesanan');
        $builder->join('detail_pemesanan','detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan');
        $builder->join('kamar','kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->groupBy('pemesanan.id_pemesanan');
        $builder->where('DATE_ADD(tanggal_pesan, INTERVAL 1 DAY) <', $tanggal);
        $builder->where('pemesanan.status_pemesanan','pengajuan');
        $builder->where('bukti_transaksi', 'n');
        return $builder->get();
    }

    public function update_status_pemesanan_batal($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('id_pemesanan', $id);
        $builder->set('status_pemesanan','batal');
        return $builder->update();
    }

    public function cek_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $builder->where('id_pengguna', $id);
        return $builder->get();
    }

}
