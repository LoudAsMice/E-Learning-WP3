<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">
                                Daftar Menjadi Member!
                            </h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('autentifikasi/registrasi');?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap">
                            <small class="text-danger pl-3"><?= $validation->getError('nama');?></small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="tempat" name="tempat" placeholder="Tempat Lahir">
                            <small class="text-danger pl-1"><?= $validation->getError('tempat');?></small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="tanggal" name="tanggal" placeholder="Tanggal Lahir Format : 01 Januari 2000">
                            <small class="text-danger pl-1"><?= $validation->getError('tanggal');?></small>
                        </div>
                        <div class="form-group">
                        <select name="jkel" class="form-control">
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                        </select>
                        <small class="text-danger pl-1"><?= $validation->getError('jkel');?></small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email">
                            <small class="text-danger pl-3"><?= $validation->getError('email');?></small>
                        </div>
                        <div class="form-group col">
                            <div class="row justify-content-md-center">
                                <div class="col-md-3">
                                <input class="form-check-input" type="radio" name="role" id="role1" value="2" onclick="hide(1)">
                                <label class="form-check-label" for="role1">
                                    Dosen
                                </label>
                                </div>
                                <div class="col-md-2">
                                <input class="form-check-input" type="radio" name="role" id="role2" value="3" onclick="hide(0)" checked>
                                <label class="form-check-label" for="role2">
                                    Mahasiswa
                                </label>
                                </div>
                                <small class="text-danger pl-3"><?= $validation->getError('role');?></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select name="fakultas" id="fakultas" class="form-control">
                                    <option value="">--Pilih Fakultas--</option>
                                    <option value="Teknik dan Informatika">Teknik dan Informatika</option>
                                    <option value="Komunikasi dan Bahasa">Komunikasi dan Bahasa</option>
                                    <option value="Ekonomi dan Bisnis">Ekonomi dan Bisnis</option>
                                </select>
                                <small class="text-danger pl-3"><?= $validation->getError('fakultas');?></small>
                            </div>
                            <div class="col-sm-6">
                                <select name="prodi" id="prodi" class="form-control">
                                    <option value="">--Pilih Prodi--</option>
                                    <option value="Ilmu Komputer">Ilmu Komputer</option>
                                    <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                                    <option value="Ilmu Ekonomi">Ilmu Ekonomi</option>
                                </select>
                                <small class="text-danger pl-3"><?= $validation->getError('prodi');?></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username berupa NIM/NIP">
                            <small class="text-danger pl-3"><?= $validation->getError('username');?></small>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                <small class="text-danger pl-3"><?= $validation->getError('password1');?></small>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" name="password2" id="password2" placeholder="Konfirmasi Password">
                                <small class="text-danger pl-3"><?= $validation->getError('password2');?></small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Daftar Menjadi Member
                        </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('autentifikasi/lupaPassword');?>">Lupa Password?</a>
                        </div>
                        <div class="text-center">
                            Sudah Menjadi Member?
                            <a class="small" href="<?= base_url('autentifikasi');?>"> Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function hide(x){
        if(x==0){
            document.getElementById('fakultas').style.display='block';
            document.getElementById('prodi').style.display='block';
            return;
        }else{
            document.getElementById('fakultas').style.display='none';
            document.getElementById('prodi').style.display='none';
            return;
        }
    }
</script>