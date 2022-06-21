<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_detail_pengunjung extends Model
{
    protected $table = 'detail_pengunjung_kamar';
    protected $primaryKey = 'id_pengunjung_kamar';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pengunjung_kamar');
        $builder->select('id_pengunjung_kamar, nama, jenis_kelamin');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('detail_pengunjung_kamar')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pengunjung_kamar');
        $builder->select("id_pengunjung_kamar, nama, jenis_kelamin");
        $builder->where('id_pengunjung_kamar', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pengunjung_kamar');
        $builder->where('id_pengunjung_kamar', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_pengunjung_kamar');
        $builder->where('id_pengunjung_kamar', $id);
        return $builder->delete();
    }
}
