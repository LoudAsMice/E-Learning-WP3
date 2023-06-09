<?php
$t = time();
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$title-".date("d-m-Y",$t).".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<h3><center>Laporan Absen</center></h3>
    <br>
    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Status Absen</th>
                <th>Tanggal</th>
                <th>Matakuliah</th>
                <th>Pertemuan</th>
                <th>Berita Acara</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        foreach($absen as $b){
        ?>
            <tr>
                <th scope="row"><?= $no++; ?></th> 
                <td><?= $b['status_absen']; ?></td>
                <td><?= date('Y-m-d',$b['tanggal']); ?></td>
                <td><?= $b['matakuliah']; ?></td>
                <td><?= $b['pertemuan']; ?></td>
                <td><?= $b['berita']; ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>