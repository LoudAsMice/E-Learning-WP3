<?php


namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ModelUser;

class Autentifikasi extends BaseController
{
    public function index(){
        if(session('username')){
            return redirect()->to('user');
        }
        //jika statusnya sudah login, maka tidak bisa mengakses
        //halaman login alias dikembalikan ke tampilan user

        if (!$this->request->getPost()){

            $data = [
                'judul' => 'Login',
                'user' => '',
                'validation' => \Config\Services::validation()
            ];
            echo view('templates/aute_header', $data);
            echo view('autentifikasi/login', $data);
            echo view('templates/aute_footer');
        }
    }
    private function _login(){
        $modeluser = new ModelUser();
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $user = $modeluser->cekData(['username' => $username])->getRowArray();

        //jika usernya ada
        if($user) {
            //jika user sudah aktif
            if ($user['is_active'] == 1){
                //cek password
                if($password == $user['password']) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    
                    session()->set($data);

                    if($user['role_id'] == 1) {
                        return redirect()->to('admin');
                    } else {
                        if ($user['image'] == 'default.jpg') {
                            session()->setFlashdata('pesan', '<div class="alert alert-info alert-message" role="alert">Silahkan klik ubah profil untuk mengubah foto profil anda</div>');
                        }
                        return redirect()->to('user');
                    }
                } else {
                    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!</div>');
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!</div>');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Akun tidak terdaftar!</div>');
            
            return redirect()->back()->withInput();
        }
    }

    public function cek()
    {
        $rules=[
            'username' => 'required|trim|',
            'password' => 'required|trim|' 
        ]; 
        
        $messages=[
            'username' => [
                'required' => 'Username Harus diisi!',
            ], 
            'password' =>[
                'required' => 'Password Harus diisi',
            ]
        ];
        if(!$this->validate($rules,$messages)){
            return redirect()->to('autentifikasi')->withInput();
        } else {
            return $this->_login();
        }
    }

    public function logout()
    {
        session()->remove(['username', 'role_id']);
        return redirect()->to('autentifikasi');
    }

    public function blok()
    {
        echo view('autentifikasi/blok');
    }

    public function gagal()
    {
        echo view('autentifikasi/gagal');
    }

    public function registrasi()
    {
        
        if(!$this->request->getPost()){
            $data = [
                'judul' => 'Registrasi Member',
                'validation' => \Config\Services::validation()
            ];
            echo view('templates/aute_header', $data);
            echo view('autentifikasi/registrasi', $data);
            echo view('templates/aute_footer');
        } else {
            return $this->_cekreg();
        }
    }

    private function _cekreg()
    {
        $db = \Config\Database::connect();
        $modeluser = new ModelUser();

        $rules = [
            'nama' => 'required',
            'username' => 'required|numeric|is_unique[user.username]',
            'email' => 'required|trim|valid_email|is_unique[mahasiswa.email]|is_unique[dosen.email]',
            'role' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required',
            'jkel' => 'required',
            'password1' => 'required|trim|min_length[3]|matches[password2]',
            'password2' => 'required|trim|matches[password1]'
        ];

        $messages = [
            'nama' => [
                'required' => 'Nama Harus Diisi'
            ],
            'username' => [
                'required' => 'Username Harus Diisi!',
                'numeric' => 'Harus diisi angka',
                'is_unique' => 'Username sudah ada'
            ],
            'email' => [
                'required' => 'Email Harus Diisi',
                'valid_email' => 'Email Tidak Benar',
                'is_unique' => 'Email sudah dipakai'
            ],
            'role' => [
                'required' => 'Pilih Role'
            ],
            'tempat' => [
                'required' => 'Tempat lahir harus diisi'
            ],
            'tanggal' => [
                'required' => 'Tanggal lahir harus diisi'
            ],
            'jkel' => [
                'required' => 'Jenis Kelamin harus diisi',
            ],
            'password1' => [
                'required' => 'Password Harus Diisi',
                'matches' => 'Password Tidak Sama!',
                'min_length' => 'Password Terlalu Pendek'
            ],
            'password2' => [
                'required' => 'Konfirmasi Password Harus Diisi',
                'matches' => 'Password Tidak Sama!'
            ]
        ];
        if(!$this->validate($rules, $messages)){
            return redirect()->back()->withInput();
        }else{
            $data = [
                'username' => $_POST['username'],
                'password' => md5($_POST['password1']),
                'role_id' => $_POST['role'],
                'is_active' => 0,
                'tanggal_input' => time()
            ];
            $modeluser->simpanData($data);
            $mhs = [
                'nim' => $_POST['username'],
                'nama' => $_POST['nama'],
                'tempatlahir' => $_POST['tempat'],
                'tanggallahir' => $_POST['tanggal'],
                'jkel' => $_POST['jkel'],
                'email' => $_POST['email'],
                'fakultas' => $_POST['fakultas'],
                'prodi' => $_POST['prodi'],
            ];

            $dosen = [
                'nip' => $_POST['username'],
                'nama' => $_POST['nama'],
                'tempatlahir' => $_POST['tempat'],
                'tanggallahir' => $_POST['tanggal'],
                'jkel' => $_POST['jkel'],
                'email' => $_POST['email']
            ];

            if($_POST['role'] == 2){
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-messages" role="alert">Selamat!! akun anda sudah dibuat. Silahkan tunggu admin mengaktivasi akun anda</div>');
                $db->table('dosen')->insert($dosen);
                return redirect()->to('autentifikasi');
            }
            if($_POST['role'] == 3){
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-messages" role="alert">Selamat!! akun member anda sudah dibuat. Silahkan tunggu admin mengaktivasi akun anda</div>');
                $db->table('mahasiswa')->insert($mhs);
                return redirect()->to('autentifikasi');
            }
        }
        
    }
}