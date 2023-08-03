<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <style type="text/css">
        .table-data{
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th, .table-data tr td{
            border: 1px solid black;
            font-size: 11pt;
            padding: 10px 10px 10px 10px;
        }
    </style>
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
</body>
</html>