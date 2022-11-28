<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= session()->getFlashdata('pesan');?>
            <table class="table table-hover table-success table-stripped table-responsive-md" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">Pertemuan</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Link Tugas</th>
                        <th scope="col">Komentar</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Tugas Created at</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $a = 1;
                        foreach($nilai as $m) {?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $m['matakuliah'];?></td>
                        <td><?= $m['pertemuan'];?></td>
                        <td><?= $m['judul'];?></td>
                        <td><?= $m['link'];?></td>
                        <td><?= $m['komentar'];?></td>
                        <td><?= $m['nilai'];?></td>
                        <td><?= date('d-m-Y H:i:s', $m['tugas_created']);?></td>
                        <td><?= date('d-m-Y H:i:s', $m['created']);?></td>
                        <td><?= date('d-m-Y H:i:s', $m['updated'])?></td>
                        <?php }?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of Main Content -->
