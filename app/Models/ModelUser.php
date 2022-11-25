<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelUser extends Model
{ 
    public function get(){
       return $this->db->table('user')->get();
    }

    public function getCount(){
        return $this->db->table('user')->countAllResults();
     } 

    public function simpanData($data = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->insert($data);
    }

    public function cekData($where = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->getWhere($where);
    }

    public function getUserWhere($where = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->where($where);
    }

    public function updateMhs($data = null, $where = null)
    {
        $this->db->table('mahasiswa')->set($data)->where('nim', $where)->update();
    }

    public function updateDosen($data = null, $where = null)
    {
        $this->db->table('dosen')->set($data)->where('nip', $where)->update();
    }

    public function cekUserAccess($where = null)
    {
    
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('*');
        $builder->from('access_menu');
        $builder->where($where);
        return $builder->get();
    }

    public function getUserLimit()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->limit(10,0);
    }

    public function getMahasiswa($where = null)
    {
        return $this->db->table('mahasiswa')->getWhere($where);
    }

    public function getDosen($where = null)
    {
        return $this->db->table('dosen')->getWhere($where);
    }

    public function joinMahasiswa($where = null)
    {
        return $this->db->table('mahasiswa')->select('*')->join('user', 'user.username = mahasiswa.nim')->where($where)->get();
    }

    public function joinDosen($where)
    {
        return $this->db->table('dosen')->select('*')->join('user', 'user.username = dosen.nip')->where($where)->get();
    }

    public function joinRole($where)
    {
        return $this->db->table('user')->select('*')->join('role', 'user.role_id = role.id')->where($where)->get();
    }
}