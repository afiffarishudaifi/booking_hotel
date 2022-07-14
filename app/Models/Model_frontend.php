<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_frontend extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';

    // public function view_data()
    // {
    //     $db      = \Config\Database::connect();
    //     $builder = $db->table('foto');
    //     $builder->select('kamar.id_kamar as id, kamar.nama_kamar, kamar.status_kamar, kategori_kamar.nama_kategori, kamar.biaya, foto.nama_foto');
    //     $builder->join('kamar','foto.id_kamar = kamar.id_kamar');
    //     $builder->join('kategori_kamar', 'kamar.id_kategori = kategori_kamar.id_kategori');
    //     // $builder->limit(4);
    //     $builder->groupBy('kamar.id_kamar');
    //     $builder->orderBy('kamar.id_kamar');
    //     $builder->where('kamar.status_kamar','kosong');
    //     return $builder->get();
    // }

    public function view_data($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('kamar.id_kamar as id, nama_kamar, biaya, kategori_kamar.nama_kategori, kategori_kamar.id_kategori as id_kategori, kamar.status_kamar, foto.nama_foto');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kategori = kamar.id_kategori');
        $builder->join('foto','kamar.id_kamar = foto.id_kamar');
        if (count($id) != 0) {
            $builder->whereNotIn('kamar.id_kamar',$id);
        }
        $builder->groupBy('kamar.id_kamar');
        return $builder->get();
    }

    public function cek_kamar($params)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('detail_pemesanan');
        $builder->join('pemesanan','pemesanan.id_pemesanan = detail_pemesanan.id_pemesanan');
        $builder->where('pemesanan.status_pemesanan =','terkonfirmasi');
        $builder->select('id_kamar');

        if ($params['input_masuk'] != '') {
            $builder->where('detail_pemesanan.tanggal_masuk <=', $params['input_masuk']);
            $builder->where('detail_pemesanan.tanggal_keluar >=', $params['input_masuk']);
        } 
        return $builder->get();
    }

    public function view_data_wisata()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tempat');
        $builder->limit(4);
        return $builder->get();
    }

    public function view_data_wisata_full()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tempat');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('kamar')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('kamar.id_kamar as id, kamar.nama_kamar, kamar.status_kamar, kategori_kamar.id as id_kategori, kategori_kamar.nama_kategori, biaya');
        $builder->join('kategori_kamar', 'kamar.id_kategori = kategori_kamar.id');
        $builder->where('kamar.id_kamar', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->join('pemesanan', 'pemesanan.id_kamar = kamar.id_kamar');
        $builder->where('kamar.id_kamar', $id);
        return $builder->countAllResults();
    }

    public function data_kategori()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_kamar');
        return $builder->get();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('id');
        $builder->where('kamar.nama_kamar', $nama);
        return $builder->get();
    }

    public function data_edit_dropwdown($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('kategori_kamar.nama_kategori, kategori_kamar.id as id_kategori, kamar.id, kamar.nama_kamar');
        $builder->join('kategori_kamar', 'kategori_kamar.id_kamar = kamar.id_kamar');
        $builder->where('kamar.id_kamar', $id);
        return $builder->get();
    }
}
