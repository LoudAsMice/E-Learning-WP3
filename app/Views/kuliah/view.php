
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= session()->getFlashdata('pesan');?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tugasBaruModal"><i class="fas fa-file-alt"> Tambah Matakuliah</i></a>
            <table class="table table-hover table-warning table-stripped table-responsive-md" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jadwal</th>
                        <th scope="col">NIP Dosen</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $a = 1;
                    foreach($matkul  as $m) {?>
                    <tr>
                        <td><?= $a++;?></td>
                        <td><?= $m['prodi'];?></td>
                        <td><?= $m['matakuliah'];?></td>
                        <td><?= $m['semester'];?></td>
                        <td><?= $m['kelas'];?></td>
                        <td><?= $m['jadwal'];?></td>
                        <td><?= $m['nip'];?></td>
                        <td>
                            <a href="<?= base_url('dosen/ubahmtk'). '/' .base64_encode($m['id']);?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                            <a href="<?= base_url('dosen/hapusmtk').'/'. base64_encode($m['id']);?>" class="badge badge-danger" onclick="return confirm('Anda yakin akan menghapus <?= 'Matakuliah '.$m['matakuliah']. ' kelas ' .$m['kelas'];?>?');"><i class="fas fa-trash"></i> Hapus</a>
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
            <form action="<?= base_url('kuliah/view');?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="prodi" class="form-control form-control-user" required>
                            <option value="">-- Pilih Prodi --</option>
                            <option value="Ilmu Komputer">Ilmu Komputer</option>
                            <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                        </select>
                        <small class="text-danger pl-1"><?= $validation->getError('prodi');?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="matakuliah" name="matakuliah" placeholder="Masukkan Matakuliah">
                        <small class="text-danger pl-1"><?= $validation->getError('matakuliah');?></small>
                    </div>
                    <div class="form-group">
                        <select name="sem" id="sem" class="form-control form-control-user">
                            <option value="">-- Pilih Semester --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                        </select>
                        <small class="text-danger pl-1"><?= $validation->getError('sem');?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="kelas" name="kelas" placeholder="Masukkan Kelas">
                        <small class="text-danger pl-1"><?= $validation->getError('kelas');?></small>
                    </div>
                    <div class="form-group">
                        <select name="hari" id="hari" class="form-control form-control-user">
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jum'at">Jum'at</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                        <small class="text-danger pl-1"><?= $validation->getError('sem');?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="mulai" name="mulai" placeholder="Jam Mulai">
                        <small class="text-danger pl-1"><?= $validation->getError('mulai');?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="selesai" name="selesai" placeholder="Jam Selesai">
                        <small class="text-danger pl-1"><?= $validation->getError('selesai');?></small>
                    </div>
                    <div class="form-group">
                        <select name="nip" id="nip" class="form-control form-control-user">
                            <option value="">-- Pilih Dosen --</option>
                            <?php 
                            foreach($dosen as $d){
                            ?>
                            <option value="<?= $d['nip'];?>"><?= $d['nip'].' - '. $d['nama'];?></option>
                            <?php }?>
                        </select>
                        <small class="text-danger pl-1"><?= $validation->getError('nip');?></small>
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