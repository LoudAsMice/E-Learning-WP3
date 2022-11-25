<?php

namespace App\Controllers;

use App\Models\ModelKuliah;
use App\Models\ModelUser;

class Dosen extends BaseController
{
    public function materi()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['judul'] = 'Upload Materi';
        // $dosen = $modeluser->getDosen(['nip']);
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['kelas'] = $modelkuliah->getKelasDistinct(['nip' => session('username')])->getResultArray();
        $data['matkul'] = $modelkuliah->getMatkulDistinct(['nip' => session('username')])->getResultArray();
        $data['materi'] = $modelkuliah->getMateri(['nip' => session('username')])->getResultArray();
        $data['validation'] = \Config\Services::validation();

        if(!$this->request->getPost()){
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('dosen/materi', $data);
        echo view('templates/footer');
        } else {
            return $this->_materi();
        }
    }

    private function _materi()
    {
        $db = \Config\Database::connect();
        $rules = [
            'prodi' => 'required',
            'matakuliah' => 'required',
            'kelas' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'pertemuan' => 'required',
            'link' => 'required'
        ];

        $messages = [
            'prodi' => [
                'required' => 'Prodi Harus Dipilih'
            ],
            'matakuliah' => [
                'required' => 'Matakuliah Harus Diisi'
            ],
            'kelas' => [
                'required' => 'Kelas Harus Diisi'
            ],
            'judul' => [
                'required' => 'Judul Harus Diisi'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Harus Diisi'
            ],
            'pertemuan' => [
                'required' => 'Pertemuan Harus Diisi'
            ],
            'link' => [
                'required' => 'Link Harus Diisi'
            ]
        ];

        if(!$this->validate($rules, $messages)){
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Penambahan Materi Gagal, Silahkan dicek kembali!</div>');
            return redirect()->back()->withInput();
        } else {
            $data = [
                'nip' => session('username'),
                'prodi' => $_POST['prodi'],
                'matakuliah' => $_POST['matakuliah'],
                'kelas' => $_POST['kelas'],
                'tanggal' => time(),
                'pertemuan' => $_POST['pertemuan'],
                'judul' => $_POST['judul'],
                'deskripsi' => $_POST['deskripsi'],
                'link' => $_POST['link'],
            ];
            $db->table('materi')->set($data)->insert();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Penambahan Materi Berhasil!</div>');
            return redirect()->to('dosen/materi');
        }
    }

    public function ubahmateri()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $uri = service('uri');
        $data['validation'] = \Config\Services::validation();
        $data['judul'] = 'Ubah Materi';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['matkul'] = $modelkuliah->getMatkulDistinct(['nip' => session('username')])->getResultArray();
        $data['kelas'] = $modelkuliah->getKelasDistinct(['nip' => session('username')])-> getResultArray();
        $data['materi'] = $modelkuliah->getMateri(['id' => $uri->getSegment(3)])->getRowArray();

        if(!$this->request->getPost()){
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('dosen/ubahmateri', $data);
        echo view('templates/footer');
        } else {
            return $this->_ubah();
        }
    }

    private function _ubah()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $rules = [
            'prodi' => 'required',
            'matakuliah' => 'required',
            'kelas' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'pertemuan' => 'required',
            'link' => 'required'
        ];

        $messages = [
            'prodi' => [
                'required' => 'Prodi Harus Dipilih'
            ],
            'matakuliah' => [
                'required' => 'Matakuliah Harus Diisi'
            ],
            'kelas' => [
                'required' => 'Kelas Harus Diisi'
            ],
            'judul' => [
                'required' => 'Judul Harus Diisi'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Harus Diisi'
            ],
            'pertemuan' => [
                'required' => 'Pertemuan Harus Diisi'
            ],
            'link' => [
                'required' => 'Link Harus Diisi'
            ]
        ];

        if(!$this->validate($rules, $messages)){
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Perubahan Gagal!</div>');
            return redirect()->back()->withInput();
        } else {
            $data = [
                'prodi' => $_POST['prodi'],
                'matakuliah' => $_POST['matakuliah'],
                'kelas' => $_POST['kelas'],
                'judul' => $_POST['judul'],
                'deskripsi' => $_POST['deskripsi'],
                'pertemuan' => $_POST['pertemuan'],
                'link' => $_POST['link']
            ];
            $db->table('materi')->set($data)->where('id', $uri->getSegment(3))->update();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Perubahan Materi Berhasil!</div>');
            return redirect()->to('dosen/materi')->withInput();
        }
    }

    public function hapusmateri()
    {
        $modelkuliah = new ModelKuliah();
        $uri = service('uri');
        $modelkuliah->hapusmateri(['id' => $uri->getSegment(3)]);
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Materi Berhasil Dihapus </div>');
        return redirect()->to('dosen/materi');
    }

    public function tugas()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['judul'] = 'Upload Tugas';
        // $dosen = $modeluser->getDosen(['nip']);
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['kelas'] = $modelkuliah->getKelasDistinct(['nip' => session('username')])->getResultArray();
        $data['matkul'] = $modelkuliah->getMatkulDistinct(['nip' => session('username')])->getResultArray();
        $data['tugas'] = $modelkuliah->getTugas(['nip' => session('username')])->getResultArray();
        $data['validation'] = \Config\Services::validation();

        if(!$this->request->getPost()){
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('dosen/tugas', $data);
        echo view('templates/footer');
        } else {
            return $this->_tugas();
        }
    }

    private function _tugas()
    {
        $db = \Config\Database::connect();
        $rules = [
            'prodi' => 'required',
            'matakuliah' => 'required',
            'kelas' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'pertemuan' => 'required',
            'link' => 'required'
        ];

        $messages = [
            'prodi' => [
                'required' => 'Prodi Harus Dipilih'
            ],
            'matakuliah' => [
                'required' => 'Matakuliah Harus Diisi'
            ],
            'kelas' => [
                'required' => 'Kelas Harus Diisi'
            ],
            'judul' => [
                'required' => 'Judul Harus Diisi'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Harus Diisi'
            ],
            'pertemuan' => [
                'required' => 'Pertemuan Harus Diisi'
            ],
            'link' => [
                'required' => 'Link Harus Diisi'
            ]
        ];

        if(!$this->validate($rules, $messages)){
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Penambahan Tugas Gagal, Silahkan dicek kembali!</div>');
            return redirect()->back()->withInput();
        } else {
            $data = [
                'nip' => session('username'),
                'prodi' => $_POST['prodi'],
                'matakuliah' => $_POST['matakuliah'],
                'tanggal' => time(),
                'pertemuan' => $_POST['pertemuan'],
                'judul' => $_POST['judul'],
                'deskripsi' => $_POST['deskripsi'],
                'link' => $_POST['link'],
            ];
            $db->table('tugas')->set($data)->insert();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Penambahan Tugas Berhasil!</div>');
            return redirect()->to('dosen/tugas');
        }
    }

    public function nilai()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['judul'] = 'Nilai Tugas Mahasiswa';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['nilai'] = $modelkuliah->joinNilai(['nilai.nip' => session('username'), 'is_nilai' => 0])->getResultArray();
        $data['validation'] = \Config\Services::validation();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('dosen/nilai', $data);
        echo view('templates/footer');
    }

    public function send()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['judul'] = 'Send Nilai';
        $data['uri'] = service('uri');
        $data['validation'] = \Config\Services::validation();
       
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();

        if(!$this->request->getPost()){
            echo view('templates/header', $data);
            echo view('templates/sidebar', $data);
            echo view('templates/topbar', $data);
            echo view('dosen/send', $data);
            echo view('templates/footer');
        } else {
            return $this->_send();
        }
    }

    private function _send()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $data = [
            'komentar' => $_POST['komentar'],
            'nilai' => $_POST['nilai'],
            'is_nilai' => 1,
            'updated' => time()
        ];

        $db->table('nilai')->set($data)->where(['id' => $uri->getSegment(3)])->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Send Nilai Berhasil!</div>');
        return redirect()->to('dosen/nilai');
    }

    public function ubahnilai()
    {
        $modeluser = new ModelUser();
        $db = \Config\Database::connect();
        $uri = service('uri');
        $data['judul'] = 'Ubah Nilai';
        $data['uri'] = service('uri');
        $data['validation'] = \Config\Services::validation();
        $data['nilai'] = $db->table('nilai')->getWhere(['id' => $uri->getSegment(3)])->getRowArray();
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();

        if(!$this->request->getPost()){
            echo view('templates/header', $data);
            echo view('templates/sidebar', $data);
            echo view('templates/topbar', $data);
            echo view('dosen/ubahnilai', $data);
            echo view('templates/footer');
        } else {
            return $this->_ubahnilai();
        }
    }

    private function _ubahnilai()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $data = [
            'komentar' => $_POST['komentar'],
            'nilai' => $_POST['nilai'],
            'is_nilai' => 1,
            'updated' => time()
        ];

        $db->table('nilai')->set($data)->where(['id' => $uri->getSegment(3)])->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Ubah Nilai Berhasil!</div>');
        return redirect()->to('dosen/semua');
    }

    public function semua()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['judul'] = 'Semua Nilai';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['nilai'] = $modelkuliah->joinNilai(['nilai.nip' => session('username')])->getResultArray();
        $data['validation'] = \Config\Services::validation();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('dosen/semua', $data);
        echo view('templates/footer');
    }

    public function ubahtugas()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $uri = service('uri');
        $data['validation'] = \Config\Services::validation();
        $data['judul'] = 'Ubah Tugas';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['kelas'] = $modelkuliah->getKelasDistinct(['nip' => session('username')])->getResultArray();
        $data['matkul'] = $modelkuliah->getMatkulDistinct(['nip' => session('username')])->getResultArray();
        $data['tugas'] = $modelkuliah->getTugas(['id' => $uri->getSegment(3)])->getRowArray();

        if(!$this->request->getPost()){
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('dosen/ubahtugas', $data);
        echo view('templates/footer');
        } else {
            return $this->_ubhtugas();
        }
    }

    private function _ubhtugas()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $rules = [
            'prodi' => 'required',
            'matakuliah' => 'required',
            'kelas' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'pertemuan' => 'required',
            'link' => 'required'
        ];

        $messages = [
            'prodi' => [
                'required' => 'Prodi Harus Dipilih'
            ],
            'matakuliah' => [
                'required' => 'Matakuliah Harus Diisi'
            ],
            'kelas' => [
                'required' => 'Kelas Harus Diisi'
            ],
            'judul' => [
                'required' => 'Judul Harus Diisi'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Harus Diisi'
            ],
            'pertemuan' => [
                'required' => 'Pertemuan Harus Diisi'
            ],
            'link' => [
                'required' => 'Link Harus Diisi'
            ]
        ];

        if(!$this->validate($rules, $messages)){
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Perubahan Gagal!</div>');
            return redirect()->back()->withInput();
        } else {
            $data = [
                'prodi' => $_POST['prodi'],
                'matakuliah' => $_POST['matakuliah'],
                'kelas' => $_POST['kelas'],
                'judul' => $_POST['judul'],
                'deskripsi' => $_POST['deskripsi'],
                'pertemuan' => $_POST['pertemuan'],
                'link' => $_POST['link']
            ];
            $db->table('tugas')->set($data)->where('id', $uri->getSegment(3))->update();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Perubahan Materi Berhasil!</div>');
            return redirect()->to('dosen/tugas')->withInput();
        }
    }

    public function hapustugas()
    {
        $modelkuliah = new ModelKuliah();
        $uri = service('uri');
        $modelkuliah->hapusTugas(['id' => $uri->getSegment(3)]);
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Tugas Berhasil Dihapus </div>');
        return redirect()->to('dosen/tugas');
    }
}