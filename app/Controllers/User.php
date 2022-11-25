<?php

namespace App\Controllers;

use App\Models\ModelUser;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use function App\Helpers\cek_login;

class User extends BaseController
{
    function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->modeluser = new ModelUser();
        helper('pustaka_helper');
        if(cek_login()){
            return redirect()->to('autentifikasi/gagal');
        }
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $modeluser = new ModelUser();
        $data['judul'] = 'Profil Saya';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['mahasiswa'] = $modeluser->joinMahasiswa(['username' => session('username')])->getRowArray();
        $data['dosen'] = $modeluser->joinDosen(['username' => session('username')])->getRowArray();
        $data['role'] = $db->table('user')->join('role', 'user.role_id = role.id')->where(['username' => session('username')])->get()->getRowArray();

        if(!cek_login()){
            echo view('templates/header', $data);
            echo view('templates/sidebar', $data);
            echo view('templates/topbar', $data);
            echo view('user/index', $data);
            echo view('templates/footer');
        } else {
            return redirect()->to('autentifikasi/gagal');
        }
    }

    public function admin()
    {
        $modeluser = new ModelUser();
        $data['judul'] = 'Data User';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['join'] = $modeluser->getUserWhere(['role_id' => 1])->get()->getResultArray();
        $data['uri'] = service('uri');

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('user/data', $data);
        echo view('templates/footer');
    }
    
    public function dosen()
    {
        $modeluser = new ModelUser();
        $data['uri'] = service('uri');
        $data['judul'] = 'Data Dosen';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['join'] = $modeluser->joinDosen(['role_id' => 2])->getResultArray();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('user/data', $data);
        echo view('templates/footer');
    }

    public function mahasiswa()
    {
        $modeluser = new ModelUser();
        $data['uri'] = service('uri');
        $data['judul'] = 'Data Mahasiswa';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['join'] = $modeluser->joinMahasiswa(['role_id' => 3])->getResultArray();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('user/data', $data);
        echo view('templates/footer');
    }

    public function ubahmahasiswa()
    {
        if(cek_login()){
            return redirect()->to('autentifikasi/gagal');
        }

        $modeluser = new ModelUser();
        $uri = service('uri');
        $data['validation'] = \Config\Services::validation();
        $data['judul'] = 'Ubah Data Mahasiswa';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['join'] = $modeluser->joinMahasiswa(['nim' => $uri->getSegment(3)])->getRowArray();

        if(!$this->request->getPost()){
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('user/ubahmahasiswa', $data);
        echo view('templates/footer');
        } else {
            return $this->_cekmhs();
        }
    }

    private function _cekmhs()
    {
        $modeluser = new ModelUser();
        $uri = service('uri');
        $user = $modeluser->getUserWhere(['username' => $uri->getSegment(3)])->get()->getRowArray();
        $db = \Config\Database::connect();
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email'
        ];
        
        $messages=[
            'nama' =>[
                'required' => 'Nama Harus diisi',
            ],
            'email' => [
                'required' => 'Email Harus diisi'
            ]
        ];

        $validationRule = [
            'image' => [
                'rules' => 'uploaded[image]'
                    . '|is_image[image]'
                    . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
            ],
        ];

        if(!$this->validate($rules,$messages)){
            return redirect()->back()->withInput();
        } else {
            $img = $this->request->getFile('image');
            $old = $user['image'];
            $r = $img->getRandomName();
            $data = [
                'nama' => $_POST['nama'],
                'tempatlahir' => $_POST['tempat'],
                'tanggallahir' => $_POST['tanggal'],
                'jkel' => $_POST['jkel'],
                'email' => $_POST['email'],
                'fakultas' => $_POST['fakultas'],
                'prodi' => $_POST['prodi'],
                'alamat' => $_POST['alamat'],
            ];
            $modeluser->updateMhs($data, $uri->getSegment(3));
            if($this->validate($validationRule)){
                if($old != 'default.jpg'){
                    unlink('assets/img/profile'.'/'.$old);
                }
                $img->move('./assets/img/profile/', $r);
                $db->table('user')->set('image', $r)->where('username', $uri->getSegment(3))->update();
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil Diubah </div>');
                return redirect()->back();
            }elseif($img == ''){
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil Diubah </div>');
                return redirect()->back();
            }else{
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Format tidak sesuai! </div>');
                return redirect()->back();
            }
        }
    }

    public function ubahdosen()
    {
        if(cek_login()){
            return redirect()->to('autentifikasi/gagal');
        }

        $modeluser = new ModelUser();
        $uri = service('uri');
        $data['validation'] = \Config\Services::validation();
        $data['judul'] = 'Ubah Data Dosen';
        $data['user'] = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $data['join'] = $modeluser->joinDosen(['nip' => $uri->getSegment(3)])->getRowArray();

        if(!$this->request->getPost()){
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('user/ubahdosen', $data);
        echo view('templates/footer');
        } else {
            return $this->_cekdosen();
        }
    }

    private function _cekdosen()
    {
        $modeluser = new ModelUser();
        $uri = service('uri');
        $user = $modeluser->getUserWhere(['username' => $uri->getSegment(3)])->get()->getRowArray();
        $db = \Config\Database::connect();
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email'
        ];
        
        $messages=[
            'nama' =>[
                'required' => 'Nama Harus diisi',
            ],
            'email' => [
                'required' => 'Email Harus diisi'
            ]
        ];

        $validationRule = [
            'image' => [
                'rules' => 'uploaded[image]'
                    . '|is_image[image]'
                    . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
            ],
        ];

        if(!$this->validate($rules,$messages)){
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Ubah data gagal!</div>');
            return redirect()->back()->withInput();
        } else {
            $img = $this->request->getFile('image');
            $old = $user['image'];
            $r = $img->getRandomName();
            $data = [
                'nama' => $_POST['nama'],
                'tempatlahir' => $_POST['tempat'],
                'tanggallahir' => $_POST['tanggal'],
                'jkel' => $_POST['jkel'],
                'email' => $_POST['email'],
                'alamat' => $_POST['alamat'],
            ];
            $modeluser->updateDosen($data, $uri->getSegment(3));
            if($this->validate($validationRule)){
                if($old != 'default.jpg'){
                    unlink('assets/img/profile'.'/'.$old);
                }
                $img->move('./assets/img/profile/', $r);
                $db->table('user')->set('image', $r)->where('username', $uri->getSegment(3))->update();
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil Diubah </div>');
                return redirect()->back();
            }elseif($img == ''){
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil Diubah </div>');
                return redirect()->back();
            }else{
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Format tidak sesuai! </div>');
                return redirect()->back();
            }
        }
    }

    public function ubahprofil()
    {
        $model = new ModelUser();
        $db = \Config\Database::connect();
        $data['judul'] = 'Ubah Profil';
        $data['user'] = $model->cekData(['username' => session('username')])->getRowArray();
        $data['mhs'] = $db->table('user')->join('mahasiswa', 'user.username = mahasiswa.nim')->where(['user.username' => session('username')])->get()->getRowArray();
        $data['dosen'] = $db->table('user')->join('dosen', 'user.username = dosen.nip')->where(['user.username' => session('username')])->get()->getRowArray();
        
        $data['validation'] = \Config\Services::validation();

        

        if(!$this->request->getPost()){
            echo view('templates/header', $data);
            echo view('templates/sidebar', $data);
            echo view('templates/topbar', $data);
            echo view('user/ubah-profil', $data);
            echo view('templates/footer');
        } else {
            return $this->_cekubah();
        }
    }

    private function _cekubah()
    {
        $modeluser = new ModelUser();
        $user = $modeluser->cekData(['username' => session('username')])->getRowArray();
        $db = \Config\Database::connect();
        if(session('role_id') == 2){
            $data = [
                'nama' => $_POST['nama'],
                'email' => $_POST['email'],
                'tempatlahir' => $_POST['tempat'],
                'tanggallahir' => $_POST['tanggal'],
                'jkel' => $_POST['jkel'],
                'alamat' => $_POST['alamat']
            ];
            
            
            if($this->request->getFile('image')){
                $img = $this->request->getFile('image');
                $r = $img->getRandomName();
                $db = \Config\Database::connect();

                $validationRule = [
                    'image' => [
                        'rules' => 'uploaded[image]'
                            . '|is_image[image]'
                            . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    ],
                ];
            
                if($this->validate($validationRule)){
                    $gambar_lama = $user['image'];
                    if($gambar_lama != 'default.jpg'){
                        unlink('./assets/img/profile/' .$gambar_lama);
                    }
                    $db->table('user')->set('image', $r)->where(['username' => session('username')])->update();
                    $img->move('./assets/img/profile/', $r);
                }elseif($img == ''){
                    //do nothing
                }else{
                    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Format Foto tidak sesuai! </div>');
                    return redirect()->to('user');
                }
            }
            $db->table('dosen')->set($data)->where(['nip' => session('username')])->update();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data Berhasil diubah! </div>');
            return redirect()->to('user');
        }

        if(session('role_id') == 3){
            $data = [
                'nama' => $_POST['nama'],
                'tempatlahir' => $_POST['tempat'],
                'tanggallahir' => $_POST['tanggal'],
                'jkel' => $_POST['jkel'],
                'email' => $_POST['email'],
                'alamat' => $_POST['alamat']
            ];

            if($this->request->getFile('image')){
                $img = $this->request->getFile('image');
                $r = $img->getRandomName();
                $db = \Config\Database::connect();

                $validationRule = [
                    'image' => [
                        'rules' => 'uploaded[image]'
                            . '|is_image[image]'
                            . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    ],
                ];
            
                if($this->validate($validationRule)){
                    $gambar_lama = $user['image'];
                    if($gambar_lama != 'default.jpg'){
                        unlink('./assets/img/profile/' .$gambar_lama);
                    }
                    $db->table('user')->set('image', $r)->where(['username' => session('username')])->update();
                    $img->move('./assets/img/profile/', $r);
                }elseif($img == ''){
                    //do nothing
                }else{
                    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Format Foto tidak sesuai! </div>');
                    return redirect()->to('user');
                }
            }
            $db->table('mahasiswa')->set($data)->where(['nim' => session('username')])->update();
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data Berhasil diubah! </div>');
            return redirect()->to('user');
        }
    }

    public function hapusmahasiswa()
    {
        $db = \Config\Database::connect();
        $uri = service('uri');
        // $id = $db->table('user')->getWhere(['username' => $uri->getSegment(3)])->getRowArray();
        $db->table('user')->where(['username' => $uri->getSegment(3)])->delete();
        $db->table('mahasiswa')->where(['nim' => $uri->getSegment(3)])->delete();
        return redirect()->to('admin');
    }
}