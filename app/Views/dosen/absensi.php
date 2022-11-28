<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <h1 class="h4 mb-2 text-dark"><?= $kelas;?></h1>
                <?= session()->getFlashdata('pesan');?>
                <?php if($cek == null){?>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#absenBaruModal"><i class="fas fa-fingerprint"> Open Absensi</i></a>
                <?php } else {
                $uri = service('uri');
                $id = $uri->getSegment(3);
                $kls = $uri->getSegment(4);    
                ?>
                <a href="<?= base_url('dosen/close'.'/'.$id.'/'.$kls);?>" class="btn btn-danger mb-3"><i class="fas fa-fingerprint"> Tutup Absensi</i></a>
                <?php }?>
            </div>
            <table class="table table-hover table-primary table-stripped table-responsive-md" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">Pertemuan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status Absen</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
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
                        <td><?= $m['status_absen'];?></td>
                        <td><?= $m['status'];?></td>
                        <td>
                            <a href="<?= base_url('dosen/edit').'/'.base64_encode($m['id']);?>" class="badge badge-info"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<!-- Modal Tambah Absen baru -->
<div class="modal fade" id="absenBaruModal" tabindex="-1" role="dialog" aria-labelledby="absenBaruModalLabel" aria-hidden="true"> 
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="absenBaruModalLabel">
                    Open Absen
                </h5>
                <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php 
            $uri = service('uri');
            $id = $uri->getSegment('3');
            $matkul = $uri->getSegment('4');
            ?>
            <form action="<?= base_url('dosen/absensi/'.$id.'/'.$matkul);?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <select name="pertemuan" class="form-control form-control-user">
                        <option value="">-- Pertemuan --</option>
                        <?php 
                        if($pertemuan == null){
                            $i = 1;
                        } else {
                        $i = $pertemuan['pertemuan'] + 1;
                        }
                        for ($i; $i<=15; $i++){
                        ?>
                        <option value="<?= $i;?>">Pertemuan <?= $i;?></option>
                        <?php }?>
                    </select>
                    <small class="text-danger pl-1"><?= $validation->getError('pertemuan');?></small>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Open</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Menu -->