<!-- Begin Page Content --> 
<div class="container-fluid"> 
    <div class="row"> 
        <div class="col-lg-9"> 
        <?= session()->getFlashdata('pesan');?>
            <form action="<?= base_url('user/ubahdosen').'/'.$join['username'];?>" enctype="multipart/form-data" method="post">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nip" name="nip" value="<?= $join['nip'];?>" readonly>
                        <small class="text-danger pl-1"><?= $validation->getError('nip');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $join['nama'];?>">
                        <small class="text-danger pl-1"><?= $validation->getError('nama');?></small>
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
                    <label for="nama" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $join['email'];?>">
                        <small class="text-danger pl-1"><?= $validation->getError('email');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $join['alamat'];?>">
                        <small class="text-danger pl-1"><?= $validation->getError('alamat');?></small>
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
                                    <label for="image" class="custom-file-label">Upload Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button class="btn btn-dark" onclick="window.history.back"> Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>


