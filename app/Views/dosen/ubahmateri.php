<!-- Begin Page Content --> 
<div class="container-fluid"> 
    <div class="row"> 
        <div class="col-lg-9">
        <?= session()->getFlashdata('pesan');?>
        <?php 
        $uri = service('uri');
        $idmtk = $uri->getSegment(3);
        $klas = $uri->getSegment(4);
        ?>
            <form action="<?= base_url('dosen/ubahmateri'). '/' . $idmtk . '/' . $klas . '/'. base64_encode($materi['id']);?>" enctype="multipart/form-data" method="post">
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul" name="judul" value="<?= $materi['judul'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('judul');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $materi['deskripsi'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('deskripsi');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">Pertemuan</label>
                    <div class="col-sm-10">
                        <select name="pertemuan" class="form-control form-control-user">
                            <option default value="<?= $materi['pertemuan'];?>">Pertemuan <?= $materi['pertemuan'];?></option>
                            <?php 
                            for ($i = 1; $i<=15; $i++){
                            ?>
                            <option value="<?= $i;?>">Pertemuan <?= $i;?></option>
                            <?php }?>
                        </select>
                        <small class="text-danger pl-3"><?= $validation->getError('link');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Link</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="link" name="link" value="<?= $materi['link'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('link');?></small>
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
