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

    public function update_data_admin($data, $id, $data_pengunjung)
    {
        // $link = 'https://cepogo.wablas.com/api/send-message';
        // $curl = \Config\Services::curlrequest();
        // $response = $curl->request('POST', $link, [
        //     'form_params' => [
        //         'phone' => $data_pengunjung['no_hp'],
        //         'message' => 'Selamat Datang di Hotel Purbaya. Transaksi pembayaran sudah terkonfirmasi dan kamar siap untuk ditempati. Terimakasih ' . $data_pengunjung['nama_lengkap'] . ' telah melakukan pemesanan pada tanggal ' . $data_pengunjung['tanggal_pesan'] . ' dan selamat menikmati',
        //         'secret' => false, // or true
        //         'priority' => false, // or true
        //     ],
        //     "headers" => [
        //         "Content-Type" => "application/x-www-form-urlencoded",
        //         "Authorization" => "uCOdT9hNtbtCOds5BhR2UA20y4wdWmA70AGMCKsuYtM0J1CeXWqJi81pyVpFrF89"
        //     ]
        // ]);        
        
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

    public function cari_pengunjung($id_pemesanan)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select('pengunjung.nama_lengkap, no_hp, alamat, tanggal_pesan');
        $builder->join('pengunjung', 'pengunjung.id_pengguna = pemesanan.id_pengguna');
        $builder->where('pemesanan.id_pemesanan', $id_pemesanan);
        return $builder->get();
    }

    // customer
    public function view_data_customer($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->select("pemesanan.id_pemesanan, pengunjung.nama_lengkap, DATE_FORMAT(tanggal_pesan, '%d %M %Y') as tanggal_pesan, status_pemesanan, bukti_transaksi, SUM(detail_pemesanan.total_biaya) as total_tagihan");
        $builder->join('pengunjung', 'pengunjung.id_pengguna = pemesanan.id_pengguna');
        $builder->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'left');
        // $builder->where('pemesanan.status_pemesanan !=','selesai');
        $builder->where('pemesanan.id_pengguna', $id);
        $builder->groupBy('pemesanan.id_pemesanan');
        return $builder->get();
    }

    public function max()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->selectMax('id_pemesanan');
        return $builder->get();
    }

    public function view_data_detail_pemesanan($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pemesanan');
        $builder->select('id_detail, nama_kamar, kamar.id_kamar, tanggal_masuk, tanggal_keluar, total_biaya');
        $builder->join('kamar', 'kamar.id_kamar = detail_pemesanan.id_kamar');
        $builder->where('id_pemesanan', $id);
        return $builder->get();
    }

    public function update_data_batal_pemesanan($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id_kamar', $id);
        $builder->set($data);
        return $builder->update();
    }
}
