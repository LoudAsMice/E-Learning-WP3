<!-- Sidebar -->
<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user')?>">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-book"></i>
    </div>
    <div class="sidebar-brand-text mx-3">E-Learning</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Heading -->
<div class="sidebar-heading">
    Menu
</div>

<!-- Nav Item - Dashboard -->

<li class="nav-item active">
    <?php if(session('role_id') == 2){?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-book"></i>
            <span>Kuliah</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"data-parent="#accordionSidebar">
            <div class="bg-gray-800 py-2 collapse-inner rounded">
                <h6 class="collapse-header text-light">Pilih:</h6>
                <a class="collapse-item text-light" href="<?= base_url('dosen/materi')?>">Upload Materi</a>
                <a class="collapse-item text-light" href="<?= base_url('dosen/tugas')?>">Upload Tugas</a>
                <a class="collapse-item text-light" href="<?= base_url('dosen/nilai')?>">Nilai Mahasiswa</a>
                <a class="collapse-item text-light" href="<?= base_url('dosen/semua')?>">Semua Nilai Mahasiswa</a>
            </div>
        </div>
        
        
    </li>
</li>
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading">
        Absensi
    </div>
    <li class="nav-item">
        <?php
            $db = \Config\Database::connect();
            $matkul = $db->table('matakuliah')->select('kelas')->distinct()->getWhere(['nip' => session('username')])->getResultArray();
            // var_dump($kelas);
            $i = 2;
            foreach ($matkul as $mtk) {
        ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data<?= $i;?>"aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-book"></i>
            <span><?= $mtk['kelas'];?></span>
        </a>
        <div id="data<?= $i;?>" class="collapse" aria-labelledby="headingUtilities"data-parent="#accordionSidebar">
            <div class="bg-gray-800 py-2 collapse-inner rounded">
                <h6 class="collapse-header text-light">Pilih:</h6>
                <?php 
                $getmatkul = $db->table('matakuliah')->getWhere(['kelas' => $mtk['kelas']])->getResultArray();
                // var_dump($getmatkul);
                foreach ($getmatkul as $m) {?>
                <a class="collapse-item text-light" href="<?= base_url('dosen/absensi/'. base64_encode($m['id']).'/'. base64_encode($m['kelas']));?>"><?= $m['matakuliah']?></a>
                </a>
                <?php }?>
            </div>
        </div>
        <?php $i++;}?>
    </li>
    <?php }?>
    
    
    <?php if(session('role_id') == 3){?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-book"></i>
            <span>Kuliah</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-gray-800 py-2 collapse-inner rounded">
                <h6 class="collapse-header text-light">Pilih:</h6>
                <a class="collapse-item text-light" href="<?= base_url('kuliah')?>">Materi</a>
                <a class="collapse-item text-light" href="<?= base_url('kuliah/tugas')?>">Tugas</a>
                <a class="collapse-item text-light" href="<?= base_url('kuliah/nilai')?>">Nilai Tugas</a>
            </div>
        </div>
    </li>
    <?php }?>
    <?php if($user['role_id'] == 1) {?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Member</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-gray-800 py-2 collapse-inner rounded">
                <h6 class="collapse-header text-light">Pilih:</h6>
                <a class="collapse-item text-light" href="<?= base_url('user/admin')?>">Admin</a>
                <a class="collapse-item text-light" href="<?= base_url('user/dosen')?>">Dosen</a>
                <a class="collapse-item text-light" href="<?= base_url('user/mahasiswa')?>">Mahasiswa</a>
            </div>
        </div>
    </li>
    <?php }?>
</li>

<!-- Divider -->
<hr class="sidebar-divider mt-3">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->