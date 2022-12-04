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
            <form action="<?= base_url('dosen/editabsensi').'/'.$idmtk.'/'.$kls.'/'.$uri->getSegment(5);?>" enctype="multipart/form-data" method="post">
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status Absen</label>
                    <div class="col-sm-10">
                        <select name="status" id="status" class="form-control">
                            <option value="<?= $absensi['status_absen'];?>"><?= $absensi['status_absen'];?></option>
                            <?php if($absensi['status_absen'] == 'Hadir'){?>
                            <option value="Tidak Hadir">Tidak Hadir</option>
                            <?php } else {?>
                                <option value="Hadir">Hadir</option>
                            <?php }?>
                        </select>
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
