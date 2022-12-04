<?php
    $uri = service('uri');
    $idmtk = $uri->getSegment(3);
    $kls = $uri->getSegment(4);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <h1 class="h4 mb-2 text-dark"><?= $klas;?></h1>
            </div>
            <?= session()->getFlashdata('pesan');?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tugasBaruModal"><i class="fas fa-file-alt"> Tambah Tugas</i></a>
            <table class="table table-hover table-warning table-stripped table-responsive-md" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Pertemuan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Link Tugas</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $a = 1;
                    foreach($tugas  as $m) {?>
                    <tr>
                        <td><?= $a++;?></td>
                        <td><?= $m['prodi'];?></td>
                        <td><?= $m['matakuliah'];?></td>
                        <td><?= $m['kelas'];?></td>
                        <td><?= $m['judul'];?></td>
                        <td><?= $m['deskripsi'];?></td>
                        <td><?= $m['pertemuan'];?></td>
                        <td><?= date('d-m-Y H:i:s', $m['tanggal']);?></td>
                        <td><a href="<?= $m['link'];?>" target="_blank"><?= $m['link'];?></a></td>
                        <td>
                            <a href="<?= base_url('dosen/ubahtugas'). '/' . $idmtk . '/' . $kls .'/'. base64_encode($m['id']);?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                            <a href="<?= base_url('dosen/hapustugas').'/'. base64_encode($m['id']);?>" class="badge badge-danger" onclick="return confirm('Anda yakin akan menghapus <?= 'Tugas pertemuan '.$m['pertemuan']. ' matakuliah ' .$m['matakuliah'];?>?');"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<!-- Modal Tambah Materi baru -->
<div class="modal fade" id="tugasBaruModal" tabindex="-1" role="dialog" aria-labelledby="tugasBaruModalLabel" aria-hidden="true"> 
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tugasBaruModalLabel">
                    Tambah Tugas
                </h5>
                <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dosen/tugas/'. $idmtk . '/' . $kls);?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="judul" name="judul" placeholder="Masukkan Judul">
                        <small class="text-danger pl-1"><?= $validation->getError('judul');?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi">
                        <small class="text-danger pl-1"><?= $validation->getError('deskripsi');?></small>
                    </div>
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
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="link" name="link" placeholder="Masukkan Link">
                        <small class="text-danger pl-1"><?= $validation->getError('link');?></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Menu -->