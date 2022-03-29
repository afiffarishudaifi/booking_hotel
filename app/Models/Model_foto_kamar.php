<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_foto_kamar extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'id_foto';

    public function view_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');
        $builder->select('foto.id_foto as id_foto, foto.id_kamar, foto.nama_foto, kamar.nama_kamar');
        $builder->join('kamar', 'foto.id_kamar = kamar.id_kamar');
        $builder->where('foto.id_kamar', $id);
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('foto')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');
        $builder->where('id_foto', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');
        $builder->where('id_foto', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');
        $builder->where('id_foto', $id);
        return $builder->delete();
    }

    public function data_kamar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        return $builder->get();
    }
}
