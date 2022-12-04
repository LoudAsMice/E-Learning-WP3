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
        $db = \Config\Database::connect();
        $mhs = $modeluser->getMahasiswa(['nim' => session('username')])->getRowArray();
        $uri = service('uri');
        $idmtk = base64_decode($uri->getSegment(3));
        // var_dump($idmtk);
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();
        
        $data['judul'] = 'Materi';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['materi'] = $modelkuliah->joinMateri(['kelas' => $mhs['kelas'], 'matakuliah' => $mtk['matakuliah']])->getResultArray();

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
        $db = \Config\Database::connect();
        $data['db'] = \Config\Database::connect();
        $mhs = $modeluser->getMahasiswa(['nim' => session('username')])->getRowArray();
        $uri = service('uri');
        $idmtk = base64_decode($uri->getSegment(3));
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();

        $data['judul'] = 'Tugas';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['tugas'] = $modelkuliah->joinTugas(['kelas' => $mhs['kelas'], 'matakuliah' => $mtk['matakuliah']])->getResultArray();
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
        $id = base64_decode($uri->getSegment(5));
        $idmtk = $uri->getSegment(3);
        $kelas = $uri->getSegment(4);
        $tugas = $modelkuliah->joinTugas(['tugas.id' => $id])->getRowArray();
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
        return redirect()->to('kuliah/tugas'. '/' . $idmtk . '/' . $kelas);
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
        $id = base64_decode($uri->getSegment(5));
        $idmtk = $uri->getSegment(3);
        $kelas = $uri->getSegment(4);
        // $tugas = $db->table('nilai')->getWhere(['id_tugas' => $uri->getSegment(3)])->getRowArray();
        $data = [
            'link' => $_POST['link'],
            'updated' => time()
        ];

        $db->table('nilai')->set($data)->where(['id_tugas' => $id])->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil ubah!</div>');
        return redirect()->to('kuliah/tugas'. '/' . $idmtk . '/' . $kelas);
    }

    public function nilai()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $db = \Config\Database::connect();
        $uri = service('uri');
        $idmtk = base64_decode($uri->getSegment(3));
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();

        $data['judul'] = 'Nilai Tugas';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['nilai'] = $modelkuliah->joinNilai(['mahasiswa.nim' => session('username'), 'matakuliah' => $mtk['matakuliah']])->getResultArray();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('kuliah/nilai', $data);
        echo view('templates/footer');
    }

    public function absensi()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $status = "Belum Selesai";
        $idmtk = base64_decode($uri->getSegment(3));
        $kelas = base64_decode($uri->getSegment(4));
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();

        $data['kelas'] = $kelas ." || ". $mtk['matakuliah'];
        $data['judul'] = 'Absensi';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['absensi'] = $modelkuliah->getAbsensi(['matkul' => $idmtk, 'absen.nim' => session('username')])->getResultArray();
        // $data['pertemuan'] = $db->table('absen')->where(['matkul' => $idmtk, 'nim' => session('username')])->orderBy('absen.pertemuan','desc')->get()->getRowArray();
        $data['cek'] = $db->table('absen')->where(['matkul' => $idmtk, 'nim' => session('username'), 'status' => $status])->get()->getRowArray();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('kuliah/absensi', $data);
        echo view('templates/footer');

    }

    public function view()
    {
        $modeluser = new ModelUser();
        $db = \Config\Database::connect();
        $data['uri'] = service('uri');
        $data['judul'] = 'Data Matakuliah';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['matkul'] = $db->table('matakuliah')->get()->getResultArray();
        $data['dosen'] = $db->table('dosen')->get()->getResultArray();
        $data['validation'] = \Config\Services::validation();

        if (!$this->request->getPost()){
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('kuliah/view', $data);
        echo view('templates/footer');
        } else {
            return $this->_addmtk();
        }
    }

    private function _addmtk()
    {
        $db = \Config\Database::connect();

        $data = [
            'prodi' => $_POST['prodi'],
            'matakuliah' => $_POST['matakuliah'],
            'kelas' => $_POST['kelas'],
            'nip' => $_POST['nip']
        ];

        $db->table('matakuliah')->set($data)->insert();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil ditambah!</div>');
        return redirect()->back()->withInput();
    }

    public function absen()
    {
        $db = \Config\Database::connect();
        $data = [
            'status_absen' => 'Hadir'
        ];

        $db->table('absen')->set($data)->where(['nim' => session('username'), 'status' => 'Belum Selesai', 'status_absen' => 'Tidak Hadir'])->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil Absen!</div>');
        return redirect()->back()->withInput();
    }
}
