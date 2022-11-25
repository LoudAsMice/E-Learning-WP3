<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= session()->getFlashdata('pesan');?>
            <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#bukuBaruModal"><i class="fas fa-file-alt"> Buku Baru</i></a> -->
            <!-- if mahasiswa -->
            <?php if($uri->getSegment(2) == 'mahasiswa') {?>
            <div class="table-responsive">
            <table class="table table-hover table-primary table-stripped" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Email</th>
                        <th scope="col">Fakultas</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $a = 1;
                        foreach($join as $u) {?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $u['nama'];?></td>
                        <td><?= $u['nim'];?></td>
                        <td><?= $u['email'];?></td>
                        <td><?= $u['fakultas'];?></td>
                        <td><?= $u['prodi'];?></td>
                        <td><?= $u['alamat'];?></td>
                        <td>
                            <a href="<?= base_url('user/ubahmahasiswa').'/'.$u['nim'];?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                            <a href="<?= base_url('user/hapusmahasiswa').'/'.$u['nim'];?>" class="badge badge-danger" onclick="return confirm('Anda yakin akan menghapus <?= $judul.' '.$u['username']?>?');"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                        <?php }?>
                    </tr>
                </tbody>
            </table>
            </div>
            <?php }?>
            <!-- if dosen -->
            <?php if($uri->getSegment(2) == 'dosen') {?>
            <div class="table-responsive">
            <table class="table table-hover table-primary table-stripped" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Email</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $a = 1;
                        foreach($join as $u) {?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $u['nama'];?></td>
                        <td><?= $u['nip'];?></td>
                        <td><?= $u['email'];?></td>
                        <td><?= $u['alamat'];?></td>
                        <td>
                        <a href="<?= base_url('user/ubahdosen').'/'.$u['nip'];?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                            <a href="<?= base_url('user/hapusdosen').'/'.$u['nip'];?>" class="badge badge-danger" onclick="return confirm('Anda yakin akan menghapus <?= $judul.' '.$u['username']?>?');"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                        <?php }?>
                    </tr>
                </tbody>
            </table>
            </div>
            <?php }?>
            <?php if($uri->getSegment(2) == 'admin') {?>
            <div class="table-responsive">
            <table class="table table-hover table-primary table-stripped" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Tanggal Input</th>
                        <th scope="col">Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $a = 1;
                        foreach($join as $u) {?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $u['username'];?></td>
                        <td><?= $u['tanggal_input'];?></td>
                        <td>
                        <a href="<?= base_url('user/ubahadmin').'/'.$u['id'];?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                            <a href="<?= base_url('user/hapusadmin').'/'.$u['id'];?>" class="badge badge-danger" onclick="return confirm('Anda yakin akan menghapus <?= $judul.' '.$u['username']?>?');"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                        <?php }?>
                    </tr>
                </tbody>
            </table>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<!-- Modal Tambah buku baru -->
<!--  -->
<!-- End of Modal Tambah Menu -->