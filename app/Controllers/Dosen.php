<?php

namespace App\Controllers;

use App\Models\ModelKuliah;
use App\Models\ModelUser;

use function App\Helpers\cek_login;

class Dosen extends BaseController
{
    public function materi()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $data['judul'] = 'Upload Materi';
        $uri = service('uri');
        $db = \Config\Database::connect();
        $idmtk = base64_decode($uri->getSegment(3));
        $kelas = base64_decode($uri->getSegment(4));
        $matkul = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();
        // $dosen = $modeluser->getDosen(['nip']);
        $data['klas'] = $kelas ." || ". $matkul['matakuliah'];
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['kelas'] = $modelkuliah->getKelasDistinct(['nip' => session('username')])->getResultArray();
        $data['matkul'] = $modelkuliah->getMatkulDistinct(['nip' => session('username')])->getResultArray();
        $data['materi'] = $modelkuliah->getMateri(['nip' => session('username'), 'matakuliah' => $matkul['matakuliah'], 'kelas' => $kelas])->getResultArray();
        $data['pertemuan'] = $db->table('materi')->where(['matakuliah' => $matkul['matakuliah'], 'kelas' => $kelas])->orderBy('pertemuan','desc')->get()->getRowArray();
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
        $uri = service('uri');
        $idmtk = base64_decode($uri->getSegment(3));
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();
        $kls = base64_decode($uri->getSegment(4));
        $rules = [
            'judul' => 'required',
            'deskripsi' => 'required',
            'pertemuan' => 'required',
            'link' => 'required'
        ];

        $messages = [
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
                'prodi' => $mtk['prodi'],
                'matakuliah' => $mtk['matakuliah'],
                'kelas' => $kls,
                'tanggal' => time(),
                'pertemuan' => $_POST['pertemuan'],
                'judul' => $_POST['judul'],
                'deskripsi' => $_POST['deskripsi'],
                'link' => $_POST['link'],
            ];
            $db->table('materi')->set($data)->insert();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Penambahan Materi Berhasil!</div>');
            return redirect()->back()->withInput();
        }
    }

    public function ubahmateri()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $db = \Config\Database::connect();

        $uri = service('uri');
        $data['validation'] = \Config\Services::validation();
        $data['judul'] = 'Ubah Materi';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['matkul'] = $modelkuliah->getMatkulDistinct(['nip' => session('username')])->getResultArray();
        $data['kelas'] = $modelkuliah->getKelasDistinct(['nip' => session('username')])-> getResultArray();
        // $data['pertemuan'] = $db->table('materi')->where(['matakuliah' => $mtk['matakuliah'], 'kelas' => $kelas])->orderBy('pertemuan','desc')->get()->getRowArray();
        $data['materi'] = $modelkuliah->getMateri(['id' => base64_decode($uri->getSegment(5))])->getRowArray();

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
        $idmtk = $uri->getSegment(3);
        $kelas = $uri->getSegment(4);
        $rules = [
            'judul' => 'required',
            'deskripsi' => 'required',
            'pertemuan' => 'required',
            'link' => 'required'
        ];

        $messages = [
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
                'judul' => $_POST['judul'],
                'deskripsi' => $_POST['deskripsi'],
                'pertemuan' => $_POST['pertemuan'],
                'link' => $_POST['link']
            ];
            $db->table('materi')->set($data)->where('id', base64_decode($uri->getSegment(5)))->update();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Perubahan Materi Berhasil!</div>');
            return redirect()->to('dosen/materi' . '/' . $idmtk . '/' . $kelas)->withInput();
        }
    }

    public function hapusmateri()
    {
        $modelkuliah = new ModelKuliah();
        $uri = service('uri');
        $modelkuliah->hapusmateri(['id' => base64_decode($uri->getSegment(3))]);
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Materi Berhasil Dihapus </div>');
        return redirect()->back()->withInput();
    }

    public function tugas()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $db = \Config\Database::connect();
        $uri = service('uri');
        $idmtk = base64_decode($uri->getSegment(3));
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();
        $kelas = base64_decode($uri->getSegment(4));
        $data['judul'] = 'Upload Tugas';

        $data['klas'] = $kelas ." || ". $mtk['matakuliah'];
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['kelas'] = $modelkuliah->getKelasDistinct(['nip' => session('username')])->getResultArray();
        $data['matkul'] = $modelkuliah->getMatkulDistinct(['nip' => session('username')])->getResultArray();
        $data['tugas'] = $modelkuliah->getTugas(['nip' => session('username'), 'matakuliah' => $mtk['matakuliah'], 'kelas' => $kelas])->getResultArray();
        $data['pertemuan'] = $db->table('tugas')->where(['matakuliah' => $mtk['matakuliah'], 'kelas' => $kelas])->orderBy('pertemuan','desc')->get()->getRowArray();
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
        $uri = service('uri');
        $idmtk = base64_decode($uri->getSegment(3));
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();
        $kelas = base64_decode($uri->getSegment(4));
        $rules = [
            'judul' => 'required',
            'deskripsi' => 'required',
            'pertemuan' => 'required',
            'link' => 'required'
        ];

        $messages = [
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
                'prodi' => $mtk['prodi'],
                'matakuliah' => $mtk['matakuliah'],
                'kelas' => $kelas,
                'tanggal' => time(),
                'pertemuan' => $_POST['pertemuan'],
                'judul' => $_POST['judul'],
                'deskripsi' => $_POST['deskripsi'],
                'link' => $_POST['link'],
            ];
            $db->table('tugas')->set($data)->insert();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Penambahan Tugas Berhasil!</div>');
            return redirect()->back()->withInput();
        }
    }

    public function nilai()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $db = \Config\Database::connect();
        $uri = service('uri');
        $idmtk = base64_decode($uri->getSegment(3));
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();
        $kelas = base64_decode($uri->getSegment(4));

        $data['klas'] = $kelas ." || ". $mtk['matakuliah'];
        $data['judul'] = 'Nilai Tugas Mahasiswa';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['nilai'] = $modelkuliah->joinNilai(['nilai.nip' => session('username'), 'is_nilai' => 0, 'matakuliah' => $mtk['matakuliah'], 'nilai.kelas' => $kelas])->getResultArray();
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
        $idmtk = $uri->getSegment(3);
        $kls = $uri->getSegment(4);
        $data = [
            'komentar' => $_POST['komentar'],
            'nilai' => $_POST['nilai'],
            'is_nilai' => 1,
            'updated' => time()
        ];

        $db->table('nilai')->set($data)->where(['id' => base64_decode($uri->getSegment(5))])->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Send Nilai Berhasil!</div>');
        return redirect()->to('dosen/nilai'. '/' . $idmtk . '/' . $kls);
    }

    public function ubahnilai()
    {
        $modeluser = new ModelUser();
        $db = \Config\Database::connect();
        $uri = service('uri');
        $data['judul'] = 'Ubah Nilai';
        $data['uri'] = service('uri');
        $data['validation'] = \Config\Services::validation();
        $data['nilai'] = $db->table('nilai')->getWhere(['id' => base64_decode($uri->getSegment(5))])->getRowArray();
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
        $idmtk = $uri->getSegment(3);
        $kls = $uri->getSegment(4);
        $data = [
            'komentar' => $_POST['komentar'],
            'nilai' => $_POST['nilai'],
            'updated' => time()
        ];

        $db->table('nilai')->set($data)->where(['id' => base64_decode($uri->getSegment(5))])->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Ubah Nilai Berhasil!</div>');
        return redirect()->to('dosen/semua'.'/'.$idmtk.'/'.$kls);
    }

    public function semua()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $db = \Config\Database::connect();
        $uri = service('uri');
        $idmtk = base64_decode($uri->getSegment(3));
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmtk])->getRowArray();
        $kelas = base64_decode($uri->getSegment(4));

        $data['klas'] = $kelas ." || ". $mtk['matakuliah'];
        $data['judul'] = 'Semua Nilai';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['nilai'] = $modelkuliah->joinNilai(['nilai.nip' => session('username'), 'matakuliah' => $mtk['matakuliah'], 'nilai.kelas' => $kelas, 'nilai.is_nilai' => 1])->getResultArray();
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
        $data['tugas'] = $modelkuliah->getTugas(['id' => base64_decode($uri->getSegment(5))])->getRowArray();

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
        $idmtk = $uri->getSegment(3);
        $kelas = $uri->getSegment(4);
        $rules = [
            'judul' => 'required',
            'deskripsi' => 'required',
            'pertemuan' => 'required',
            'link' => 'required'
        ];

        $messages = [
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
                'judul' => $_POST['judul'],
                'deskripsi' => $_POST['deskripsi'],
                'pertemuan' => $_POST['pertemuan'],
                'link' => $_POST['link']
            ];
            $db->table('tugas')->set($data)->where('id', base64_decode($uri->getSegment(5)))->update();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Perubahan Materi Berhasil!</div>');
            return redirect()->to('dosen/tugas' . '/' . $idmtk . '/' . $kelas)->withInput();
        }
    }

    public function hapustugas()
    {
        $modelkuliah = new ModelKuliah();
        $uri = service('uri');
        $modelkuliah->hapusTugas(['id' => base64_decode($uri->getSegment(3))]);
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Tugas Berhasil Dihapus </div>');
        return redirect()->back()->withInput();
    }

    public function absensi()
    {
        $modeluser = new ModelUser();
        $modelkuliah = new ModelKuliah();
        $db = \Config\Database::connect();
        $uri = service('uri');
        $idmatkul = base64_decode($uri->getSegment(3));
        $kelas = base64_decode($uri->getSegment(4));
        $status = "Belum Selesai";
        $mtk = $db->table('matakuliah')->getWhere(['id' => $idmatkul])->getRowArray();

        $data['kelas'] = $kelas ." || ". $mtk['matakuliah'];
        $data['jadwal2'] = $db->table('matakuliah')->getWhere(['id' => $idmatkul])->getRowArray();
        $data['jadwal'] = $db->table('absen')->join('matakuliah', 'absen.matkul = matakuliah.id')->getWhere(['absen.matkul' => $idmatkul, 'absen.kelas' => $kelas])->getRowArray();
        $data['judul'] = 'Absensi Mahasiswa';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['absensi'] = $modelkuliah->getAbsensi(['matkul' => $idmatkul, 'absen.kelas' => $kelas])->getResultArray();
        $data['pertemuan'] = $db->table('absen')->where(['matkul' => $idmatkul, 'kelas' => $kelas])->orderBy('absen.pertemuan','desc')->get()->getRowArray();
        $data['cek'] = $db->table('absen')->where(['matkul' => $idmatkul, 'kelas' => $kelas, 'status' => $status])->get()->getResultArray();
        $data['validation'] = \Config\Services::validation();

        if(!$this->request->getPost()){
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('dosen/absensi', $data);
        echo view('templates/footer');
        } else {
            return $this->_absensi();
        }
    }

    private function _absensi()
    {
        $uri = service('uri');
        $idmtk = base64_decode($uri->getSegment('3'));
        $db = \Config\Database::connect();
        $rules = [
            'pertemuan' => 'required',
        ];

        $messages = [
            'pertemuan' => [
                'required' => 'Pertemuan Harus Dipilih'
            ]
        ];

        if(!$this->validate($rules, $messages)){
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Open Absensi Gagal, Silahkan dicek kembali!</div>');
            return redirect()->back()->withInput();
        } else {
            $kls = base64_decode($uri->getSegment('4'));
            $get = $db->table('mahasiswa')->getWhere(['kelas' => $kls])->getResultArray();
            // var_dump($get);
            foreach ($get as $g){
                $data = [
                    'nim' => $g['nim'],
                    'kelas' => $g['kelas'],
                    'matkul' => $idmtk,
                    'pertemuan' => $_POST['pertemuan'],
                    'tanggal' => time(),
                    'status' => 'Belum Selesai'
                ];
                $db->table('absen')->set($data)->insert();
            }
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Open Absensi Berhasil!</div>');
            return redirect()->back()->withInput();
        }
    }

    public function editabsensi()
    {
        $modeluser = new ModelUser();
        $db = \Config\Database::connect();
        $uri = service('uri');
        $data['judul'] = 'Edit Absensi';
        $data['uri'] = service('uri');
        $data['validation'] = \Config\Services::validation();
        $data['absensi'] = $db->table('absen')->getWhere(['id' => base64_decode($uri->getSegment(5))])->getRowArray();
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();

        if(!$this->request->getPost()){
            echo view('templates/header', $data);
            echo view('templates/sidebar', $data);
            echo view('templates/topbar', $data);
            echo view('dosen/editabsensi', $data);
            echo view('templates/footer');
        } else {
            return $this->_editabsensi();
        }
    }

    private function _editabsensi()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $idmtk = $uri->getSegment(3);
        $kls = $uri->getSegment(4);
        $data = [
            'status_absen' => $_POST['status']
        ];

        $db->table('absen')->set($data)->where(['id' => base64_decode($uri->getSegment(5))])->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Edit Absensi Berhasil!</div>');
        return redirect()->to('dosen/absensi'. '/' . $idmtk . '/' . $kls);
    }

    public function close()
    {
        $uri = \Config\Services::uri();
        $id = base64_decode($uri->getSegment(3));
        $kls = base64_decode($uri->getSegment(4));
        $berita = $_POST['berita'];
        $db = \Config\Database::connect();

        $cek = $db->table('absen')->getWhere(['matkul' => $id, 'kelas' => $kls, 'status' => 'Belum Selesai'])->getResultArray();

        foreach($cek as $c){
            $db->table('absen')->set(['status' => 'Sudah Selesai', 'berita' => $berita])->where(['id' => $c['id']])->update();
        }
        return redirect()->back()->withInput();
    }

    public function ubahmtk()
    {
        $modeluser = new ModelUser();
        $db = \Config\Database::connect();
        $uri = service('uri');
        $data['validation'] = \Config\Services::validation();
        $data['judul'] = 'Ubah Matakuliah';
        $data['dosen'] = $db->table('dosen')->get()->getResultArray();
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['matkul'] = $db->table('matakuliah')->join('dosen', 'matakuliah.nip = dosen.nip')->getWhere(['id' => base64_decode($uri->getSegment(3))])->getRowArray();

        if(!$this->request->getPost()){
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('dosen/ubahmtk', $data);
        echo view('templates/footer');
        } else {
            return $this->_ubahmtk();
        }
    }

    private function _ubahmtk()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $data = [
            'prodi' => $_POST['prodi'],
            'matakuliah' => $_POST['matakuliah'],
            'semester' => $_POST['semester'],
            'kelas' => $_POST['kelas'],
            'jadwal' => $_POST['jadwal'],
            'nip' => $_POST['nip'],
        ];

        $db->table('matakuliah')->set($data)->where(['id' => base64_decode($uri->getSegment(3))])->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Ubah Matakuliah Berhasil!</div>');
        return redirect()->to('kuliah/view');
    }

    public function hapusmtk()
    {
        $modelkuliah = new ModelKuliah();
        $uri = service('uri');
        $modelkuliah->hapusMatakuliah(['id' => base64_decode($uri->getSegment(3))]);
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Matakuliah Berhasil Dihapus </div>');
        return redirect()->back()->withInput();
    }
}