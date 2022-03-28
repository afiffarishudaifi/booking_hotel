<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_login extends Model
{
    protected $table= 'pengunjung';
    protected $primaryKey ='id_pengguna';
    protected $useTimestamps = true;

    public function getLogin($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $query = $builder->getWhere($data);
        return $query;
    }

    public function cek_admin($email)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('admin');
        $builder->where('email', $email);
        return $builder->get();
    }

    public function addProfile($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $query =  $builder->insert($data);
     
        return $query;
    }

    public function isAlreadyRegister($authid){
        return $this->db->table('pengunjung')->getWhere(['oauth_id'=>$authid])->getRowArray()>0?true:false;
    }
    public function updateUserData($userdata, $authid){
        $this->db->table("pengunjung")->where(['oauth_id'=>$authid])->update($userdata);
    }
    public function insertUserData($userdata){
        $this->db->table("pengunjung")->insert($userdata);
    }

    public function cek_max_login($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengunjung');
        $builder->select('id_pengguna');
        $builder->where('oauth_id',$id);
        return $builder->get();
    }

}
