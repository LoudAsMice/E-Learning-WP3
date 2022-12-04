<?php
    $uri = service('uri');
    $idmtk = $uri->getSegment(3);
    $kls = $uri->getSegment(4);
?>


<!-- Begin Page Content --> 
<div class="container-fluid"> 
    <div class="row"> 
        <div class="col-lg-9">
        <?= session()->getFlashdata('pesan');?>
            <form action="<?= base_url('dosen/send'). '/' . $idmtk . '/' . $kls .'/'. $uri->getSegment(5);?>" enctype="multipart/form-data" method="post">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Komentar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="komentar" name="komentar">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nilai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nilai" name="nilai">
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button class="btn btn-dark" onclick="history.back();return false"> Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
