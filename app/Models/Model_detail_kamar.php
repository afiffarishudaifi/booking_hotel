<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_detail_kamar extends Model
{
    protected $table = 'detail_kamar';
    protected $primaryKey = 'id_detail';

    public function view_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_kamar');
        $builder->select('detail_kamar.id, fasilitas.nama_fasilitas as nama_fasilitas, kamar.nama_kamar, detail_kamar.id_kamar');
        $builder->join('kamar', 'kamar.id = detail_kamar.id_kamar');
        $builder->join('fasilitas', 'fasilitas.id = detail_kamar.id_fasilitas');
        $builder->where('id_kamar', $id);
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('detail_kamar')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_kamar');
        $builder->select('detail_kamar.id_detail as id, fasilitas.id_fasilitas as id_fasilitas, fasilitas.nama_fasilitas as nama_fasilitas, kamar.id_kamar as id_kamar');
        $builder->join('kamar','detail_kamar.id_kamar = kamar.id_kamar');
        $builder->join('fasilitas', 'detail_kamar.id_fasilitas = fasilitas.id_fasilitas');
        $builder->where('detail_kamar.id_detail', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_kamar');
        $builder->where('id_detail', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_kamar');
        $builder->where('id_detail', $id);
        return $builder->delete();
    }

    public function data_kamar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        return $builder->get();
    }

    public function data_fasilitas()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('fasilitas');
        return $builder->get();
    }

}
