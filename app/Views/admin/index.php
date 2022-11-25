 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Jumlah Anggota -->
    <div class="col-l-3 col-sm-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Pengguna</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                        echo $total;?>
                        </div>
                    </div>
                    <div class="col-auto">
                    <a href="<?= base_url('user/member'); ?>"><i class="fas fa-users fa-3x text-success"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-l-3 col-sm-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Belum Aktivasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            $a = $modeluser->getUserWhere(['is_active' => '0'])->countAllResults();
                            echo $a;?>
                        </div>
                    </div>
                    <div class="col-auto">
                    <a href="#"><i class="fas fa-users fa-3x text-danger"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>




<!-- Content Row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= session()->getFlashdata('pesan');?>
            <div class="table-responsive">
            <table class="table table-hover table-primary table-stripped" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Tanggal input</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1; 
                    foreach($role as $r) {?>
                    <tr>
                        <td><?= $i++;?></td>
                        <td><?= $r['username'];?></td>
                        <td><?= $r['role'];?></td>
                        <td><?= date('d-m-Y H:i:s', $r['tanggal_input']);?></td>
                        <td>
                            <a href="<?= base_url('admin/aktif').'/'.$r['username'];?>" class="badge badge-success">Activate</a>
                            <a href="<?= base_url('admin/hapus').'/'.$r['username'];?>" class="badge badge-danger">Delete</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

 
</div>