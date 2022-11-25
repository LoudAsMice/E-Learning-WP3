<?php

namespace App\Controllers;

use App\Models\ModelKuliah;
use App\Models\ModelUser;

class Kuliah extends BaseController
{
    public function index()
    {
        $modeluser = new ModelUser();
        if(session('role_id') == 1){
            //
        } elseif(session('role_id') == 2){
            return redirect()->to('dosen/materi');
        } elseif(session('role_id') == 3){
            return redirect()->to('kuliah/materi');
        }
    }

    public function materi()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $mhs = $modeluser->getMahasiswa(['nim' => session('username')])->getRowArray();
        $data['judul'] = 'Materi';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['materi'] = $modelkuliah->joinMateri(['kelas' => $mhs['kelas']])->getResultArray();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('kuliah/materi', $data);
        echo view('templates/footer');
    }

    public function tugas()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['db'] = \Config\Database::connect();
        $mhs = $modeluser->getMahasiswa(['nim' => session('username')])->getRowArray();
        // $tugas = $modelkuliah->joinTugas(['kelas' => $mhs['kelas']])->getResultArray();
        $data['judul'] = 'Tugas';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['tugas'] = $modelkuliah->joinTugas(['kelas' => $mhs['kelas']])->getResultArray();
        // var_dump($data['tugas']);
        // $data['cek'] = $db->table('nilai')->where(['nim' => session('username')])->countAllResults();
        // var_dump($data['cek']);
        
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('kuliah/tugas', $data);
        echo view('templates/footer');
    }

    public function send()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['judul'] = 'Send Tugas';
        $data['uri'] = service('uri');
        $data['validation'] = \Config\Services::validation();
        $mhs = $modeluser->getMahasiswa(['nim' => session('username')])->getRowArray();
       
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();

        if(!$this->request->getPost()){
            echo view('templates/header', $data);
            echo view('templates/sidebar', $data);
            echo view('templates/topbar', $data);
            echo view('kuliah/send', $data);
            echo view('templates/footer');
        } else {
            return $this->_send();
        }
    }

    private function _send()
    {
        $db = \Config\Database::connect();
        $modelkuliah = new ModelKuliah();
        $uri = service('uri');
        $tugas = $modelkuliah->joinTugas(['tugas.id' => $uri->getSegment(3)])->getRowArray();
        $data = [
            'nim' => session('username'),
            'nip' => $tugas['nip'],
            'id_tugas' => $tugas['id'],
            'prodi' => $tugas['prodi'],
            'matakuliah' => $tugas['matakuliah'],
            'kelas' => $tugas['kelas'],
            'pertemuan' => $tugas['pertemuan'],
            'judul' => $tugas['judul'],
            'tugas_created' => $tugas['tanggal'],
            'created' => time(),
            'updated' => time(),
            'link' => $_POST['link']
        ];

        $db->table('nilai')->set($data)->insert();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Send Tugas Berhasil!</div>');
        return redirect()->to('kuliah/tugas');
    }

    public function ubah()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['judul'] = 'Ubah Tugas';
        $data['uri'] = service('uri');
        $data['validation'] = \Config\Services::validation();
        $mhs = $modeluser->getMahasiswa(['nim' => session('username')])->getRowArray();
       
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();

        if(!$this->request->getPost()){
            echo view('templates/header', $data);
            echo view('templates/sidebar', $data);
            echo view('templates/topbar', $data);
            echo view('kuliah/ubah', $data);
            echo view('templates/footer');
        } else {
            return $this->_ubah();
        }
    }

    private function _ubah()
    {
        $db = \Config\Database::connect();
        $modelkuliah = new ModelKuliah();
        $uri = service('uri');
        // $tugas = $db->table('nilai')->getWhere(['id_tugas' => $uri->getSegment(3)])->getRowArray();
        $data = [
            'link' => $_POST['link'],
            'updated' => time()
        ];

        $db->table('nilai')->set($data)->where(['id_tugas' => $uri->getSegment(3)])->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil ubah!</div>');
        return redirect()->to('kuliah/tugas');
    }

    public function nilai()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['judul'] = 'Nilai Tugas';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['nilai'] = $modelkuliah->joinNilai(['mahasiswa.nim' => session('username')])->getResultArray();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('kuliah/nilai', $data);
        echo view('templates/footer');
    }
}
