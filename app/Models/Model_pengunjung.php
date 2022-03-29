<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pengunjung extends Model
{
    protected $table = 'pengunjung';
    protected $primaryKey = 'id_pengguna';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('pengunjung')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $builder->where('id_pengguna', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $builder->where('id_pengguna', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $builder->where('id_pengguna', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $builder->join('pemesanan', 'pemesanan.id_pengguna = pengunjung.id_pengguna');
        $builder->where('pengunjung.id_pengguna', $id);
        return $builder->countAllResults();
    }

    public function cek_email($email)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $builder->select('id_pengguna');
        $builder->where('pengunjung.email', $email);
        return $builder->get();
    }

}
