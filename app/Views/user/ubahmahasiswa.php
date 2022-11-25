<!-- Begin Page Content --> 
<div class="container-fluid"> 
    <div class="row"> 
        <div class="col-lg-9">
        <?= session()->getFlashdata('pesan');?>
            <form action="<?= base_url('user/ubahmahasiswa').'/'.$join['username'];?>" enctype="multipart/form-data" method="post">
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nim" name="nim" value="<?= $join['nim'];?>" readonly>
                        <small class="text-danger pl-3"><?= $validation->getError('nim');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $join['nama'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('nama');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tempat" name="tempat" value="<?= $join['tempatlahir'];?>">
                        <small class="text-danger pl-1"><?= $validation->getError('tempat');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= $join['tanggallahir'];?>" placeholder="Format : 01 Januari 2000">
                        <small class="text-danger pl-1"><?= $validation->getError('tanggal');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select name="jkel" class="form-control">
                            <?php if($join['jkel'] == null) {?>
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            <?php }elseif($join['jkel'] == 'Pria') {?>
                                <option value="<?= $join['jkel'];?>"><?= $join['jkel'];?></option>
                                <option value="Wanita">Wanita</option>
                            <?php }elseif($join['jkel'] == 'Wanita') {?>
                                <option value="<?= $join['jkel'];?>"><?= $join['jkel'];?></option>
                                <option value="Pria">Pria</option>
                            <?php }?>
                        </select>
                        <small class="text-danger pl-1"><?= $validation->getError('jkel');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $join['email'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('email');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                    <div class="col-sm-10">
                        <select name="fakultas" class="form-control form-control-user">
                            <?php if($join['fakultas'] == null) {?>
                                <option value="">--Pilih Fakultas--</option>
                                <option value="Teknik dan Informatika">Teknik dan Informatika</option>
                                <option value="Komunikasi dan Bahasa">Komunikasi dan Bahasa</option>
                                <option value="Ekonomi dan Bisnis">Ekonomi dan Bisnis</option>
                            <?php }else{?>
                                <option value="<?= $join['fakultas']?>"><?= $join['fakultas']?></option>
                            <?php }?>
                            
                            <?php if($join['fakultas'] == 'Teknik dan Informatika') {?>
                                <option value="Komunikasi dan Bahasa">Komunikasi dan Bahasa</option>
                                <option value="Ekonomi dan Bisnis">Ekonomi dan Bisnis</option>
                            <?php } elseif ($join['fakultas'] == 'Komunikasi dan Bahasa') {?>
                                <option value="Teknik dan Informatika">Teknik dan Informatika</option>
                                <option value="Ekonomi dan Bisnis">Ekonomi dan Bisnis</option>
                            <?php } elseif ($join['fakultas'] == 'Ekonomi dan Bisnis') {?>
                                <option value="Teknik dan Informatika">Teknik dan Informatika</option>
                                <option value="Komunikasi dan Bahasa">Komunikasi dan Bahasa</option><?php }?>
                        </select>
                        <small class="text-danger pl-3"><?= $validation->getError('fakultas');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                    <div class="col-sm-10">
                        <select name="prodi" class="form-control form-control-user">
                            <?php if($join['prodi'] == null) {?>
                                <option value="">--Pilih Prodi--</option>
                                <option value="Ilmu Komputer">Ilmu Komputer</option>
                                <option value="Ilmu Ekonomi">Ilmu Ekonomi</option>
                                <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                            <?php }else{?>
                                <option value="<?= $join['prodi']?>"><?= $join['prodi']?></option>
                            <?php }?>
                            <?php if($join['prodi'] == 'Ilmu Komputer') {?>
                                <option value="Ilmu Ekonomi">Ilmu Ekonomi</option>
                                <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                            <?php }?>
                            <?php if($join['prodi'] == 'Ilmu Komunikasi') {?>
                                <option value="Ilmu Komputer">Ilmu Komputer</option>
                                <option value="Ilmu Ekonomi">Ilmu Ekonomi</option>
                            <?php }?>
                            <?php if($join['prodi'] == 'Ilmu Ekonomi') {?>
                                <option value="Ilmu Komputer">Ilmu Komputer</option>
                                <option value="Ilmu Ekonomi">Ilmu Komunikasi</option>
                            <?php }?>
                        </select>
                        <small class="text-danger pl-3"><?= $validation->getError('prodi');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $join['alamat'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('alamat');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        Gambar
                    </div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/profile').'/'.$join['image'];?>" class="img-thumbnail" alt="">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label for="image" class="custom-file-label"> Upload Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button class="btn btn-dark" onclick="history.back();return false"> Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
