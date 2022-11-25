<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= session()->getFlashdata('pesan');?>
            <table class="table table-hover table-warning table-stripped table-responsive" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">Dosen</th>
                        <th scope="col">Pertemuan</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Link Tugas</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $a = 1;
                        foreach($tugas as $m) {?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $m['matakuliah'];?></td>
                        <td><?= $m['nama'];?></td>
                        <td><?= $m['pertemuan'];?></td>
                        <td><?= $m['judul'];?></td>
                        <td><?= $m['deskripsi'];?></td>
                        <td><?= $m['link'];?></td>
                        <td><?= date('d-m-Y H:i:s', $m['tanggal']);?></td>
                        <td>
                            <?php
                            $cek = $db->table('nilai')->where(['id_tugas' => $m['id']])->countAllResults();
                            if ($cek == 0) {
                            ?>
                            <a href="<?= base_url('kuliah/send').'/'.$m['id'];?>" class="btn btn-success">Kerjakan</a>
                            <?php } else {?>
                            <a href="<?= base_url('kuliah/ubah').'/'.$m['id'];?>" class="btn btn-success">Ubah</a>
                        </td>
                        <?php }?>
                        <?php }?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of Main Content -->
