<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <h1 class="h4 mb-2 text-dark"><?= $kelas;?></h1>
                <?= session()->getFlashdata('pesan');?>
                <?php if($cek == null){?>
                <a href="javascript:void(0)" class="btn btn-danger mb-3" data-toggle="modal" data-target="#absenBaruModal"><i class="fas fa-fingerprint"> Belum Mulai</i></a>
                <?php } elseif ($cek != null && $cek['status_absen'] == 'Tidak Hadir') {
                $uri = service('uri');
                $id = $uri->getSegment(3);
                $kls = $uri->getSegment(4);
                ?>
                <a href="<?= base_url('kuliah/absen'.'/'.$id.'/'.$kls);?>" class="btn btn-success mb-3"><i class="fas fa-fingerprint"> Absen</i></a>
                <?php } else {?>
                    <a href="javascript:void(0)" class="btn btn-warning mb-3"><i class="fas fa-fingerprint"> Sudah Absen</i></a>
                <?php }?>
            </div>
            <table class="table table-hover table-primary table-stripped table-responsive-md" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">Pertemuan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status Absen</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $a = 1;
                    foreach($absensi  as $m) {?>
                    <tr>
                        
                        <td><?= $a++;?></td>
                        <td><?= $m['nim'];?></td>
                        <td><?= $m['nama'];?></td>
                        <td><?= $m['kelas'];?></td>
                        <td><?= $m['matakuliah'];?></td>
                        <td><?= $m['pertemuan'];?></td>
                        <td><?= date('d-m-Y H:i:s', $m['tanggal']);?></td>
                        <td>
                            <?php if($m['status_absen'] == "Tidak Hadir") {?>
                                <a href="javascript:void(0)" class="btn btn-danger"> <?= $m['status_absen'];?></a>
                            <?php }else{?>
                                <a href="javascript:void(0)" class="btn btn-success"> <?= $m['status_absen'];?></a>
                            <?php }?>
                        </td>
                        <td>
                            <?php if($m['status'] == "Belum Selesai") {?>
                                <a href="javascript:void(0)" class="btn btn-danger"> <?= $m['status'];?></a>
                            <?php }else{?>
                                <a href="javascript:void(0)" class="btn btn-warning"> <?= $m['status'];?></a>
                            <?php }?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of Main Content -->
