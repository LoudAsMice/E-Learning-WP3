<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= session()->getFlashdata('pesan');?>
            <table class="table table-hover table-success table-stripped table-responsive" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Link Tugas</th>
                        <th scope="col">Komentar</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $a = 1;
                    foreach($nilai as $n) {?>
                    <tr>
                        <td><?= $a++;?></td>
                        <td><?= $n['prodi'];?></td>
                        <td><?= $n['matakuliah'];?></td>
                        <td><?= $n['nim'];?></td>
                        <td><?= $n['nama'];?></td>
                        <td><?= $n['judul'];?></td>
                        <td><?= $n['link'];?></td>
                        <td><?= $n['komentar'];?></td>
                        <td><?= $n['nilai'];?></td>
                        <td><?= date('d-m-Y H:i:s',$n['created']);?></td>
                        <td><?= date('d-m-Y H:i:s',$n['updated']);?></td>
                        <td>
                            <a href="<?= base_url('dosen/ubahnilai').'/'.$n['id'];?>" class="btn btn-success">Ubah Nilai</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of Main Content -->
