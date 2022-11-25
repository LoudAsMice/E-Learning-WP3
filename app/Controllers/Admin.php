<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ModelBuku;
use App\Models\ModelUser;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use function App\Helpers\cek_login;

class Admin extends BaseController
{
    public function index()
    {
        if(session('role_id') == null){
            session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!! </div>');
            return redirect()->to('autentifikasi/gagal');
            
        } elseif(session('role_id') != 1) {
            return redirect()->to('autentifikasi/blok');
        }

        helper('pustaka_helper');
        $modeluser = new ModelUser();
        $data['db'] = \Config\Database::connect();
        $data['judul'] = 'Dashboard';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['total'] = $modeluser->getCount();
        $data['role'] = $modeluser->joinRole(['is_active' => 0])->getResultArray();
        $data['modeluser'] = new ModelUser();
        
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('admin/index', $data);
        echo view('templates/footer');
    }

    public function aktif()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $db->table('user')->set('is_active', 1)->where('username',$uri->getSegment(3))->update();
        return redirect()->to('admin');
    }

    public function hapus()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $db->table('user')->where('username',$uri->getSegment(3))->delete();
        return redirect()->to('admin');
    }
}