<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pengguna extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('pengguna')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $builder->where('id', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $builder->where('id', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $builder->where('id', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $builder->join('pemesanan', 'pemesanan.id_pengguna = pengguna.id');
        $builder->where('pengguna.id', $id);
        return $builder->countAllResults();
    }

    public function cek_username($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');
        $builder->select('id');
        $builder->where('pengguna.username', $username);
        return $builder->get();
    }

}