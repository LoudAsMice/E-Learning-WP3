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
            <form action="<?= base_url('dosen/ubahmtk'). '/' . $idmtk;?>" enctype="multipart/form-data" method="post">
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Prodi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $matkul['prodi'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('prodi');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="matakuliah" class="col-sm-2 col-form-label">Matakuliah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="matakuliah" name="matakuliah" value="<?= $matkul['matakuliah'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('matakuliah');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">Semester</label>
                    <div class="col-sm-10">
                        <select name="semester" class="form-control form-control-user">
                            <option default value="<?= $matkul['semester'];?>">Semester <?= $matkul['semester'];?></option>
                            <?php 
                            for ($i = 1; $i<=7; $i++){
                            ?>
                            <option value="<?= $i;?>">Semester <?= $i;?></option>
                            <?php }?>
                        </select>
                        <small class="text-danger pl-3"><?= $validation->getError('link');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $matkul['kelas'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('kelas');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jadwal" class="col-sm-2 col-form-label">Jadwal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jadwal" name="jadwal" value="<?= $matkul['jadwal'];?>">
                        <small class="text-danger pl-3"><?= $validation->getError('jadwal');?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nip" class="col-sm-2 col-form-label">Dosen</label>
                    <div class="col-sm-10">
                        <select name="nip" id="nip" class="form-control form-control-user">
                            <option default value="<?= $matkul['nip'];?>"><?= $matkul['nip'].' - '. $matkul['nama'];?></option>
                            <?php 
                            foreach($dosen as $d){
                            ?>
                            <option value="<?= $d['nip'];?>"><?= $d['nip'].' - '. $d['nama'];?></option>
                            <?php }?>
                        </select>
                        <small class="text-danger pl-3"><?= $validation->getError('nip');?></small>
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
