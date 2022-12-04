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
    <!-- <?php if(session('role_id') == 2){?>
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
    </div> -->
    <li class="nav-item">
        <?php
            $db = \Config\Database::connect();
            $matkul = $db->table('matakuliah')->select('matakuliah')->distinct()->getWhere(['nip' => session('username')])->getResultArray();
            // var_dump($matkul);
            $i = 2;
            foreach ($matkul as $mtk) {
        ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data<?= $i;?>"aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-book"></i>
            <span><?= $mtk['matakuliah'];?></span>
        </a>
        <div id="data<?= $i; $i++;?>" class="collapse" aria-labelledby="headingUtilities"data-parent="#accordionSidebar">
            <?php 
                $getkls = $db->table('matakuliah')->getWhere(['matakuliah' => $mtk['matakuliah']])->getResultArray();
                // var_dump($getkls);
                foreach ($getkls as $m) {?>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data<?= $i;?>" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-book-open"></i>
                <span><?= $m['kelas'];?></span>
            </a>
            <div class="collapse" id="data<?= $i; $i++;?>" aria-labelledby="headingUtilities" data-bs-parent="#accordionSidebar">
                <div class="bg-gray-800 py-2 collapse-inner rounded">
                    <h6 class="collapse-header text-light">Pilih:</h6>
                    <a class="collapse-item text-light" href="<?= base_url('dosen/absensi/'. base64_encode($m['id']).'/'. base64_encode($m['kelas']));?>"> Absensi</a>
                    <a class="collapse-item text-light" href="<?= base_url('dosen/materi/'. base64_encode($m['id']).'/'. base64_encode($m['kelas']));?>"> Materi</a>
                    <a class="collapse-item text-light" href="<?= base_url('dosen/tugas/'. base64_encode($m['id']).'/'. base64_encode($m['kelas']));?>"> Tugas</a>
                    <a class="collapse-item text-light" href="<?= base_url('dosen/nilai/'. base64_encode($m['id']).'/'. base64_encode($m['kelas']));?>"> Input Nilai Tugas</a>
                    <a class="collapse-item text-light" href="<?= base_url('dosen/semua/'. base64_encode($m['id']).'/'. base64_encode($m['kelas']));?>"> Ubah Nilai</a>
                </div>
            </div>
            <?php }?>
                
        </div>
        <?php $i++;}}?>
        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-book"></i>
            <span>Tes</span>
        </a>
        <div class="collapse" id="collapsePages" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-book-open"></i>
                <span>Authentication</span>
            </a>
            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingUtilities" data-bs-parent="#accordionSidebar">
                <div class="bg-gray-800 py-2 collapse-inner rounded">
                    <h6 class="collapse-header text-light">Pilih:</h6>
                    <a class="collapse-item text-light" href="login.html">Login</a>
                    <a class="collapse-item text-light" href="register.html">Register</a>
                    <a class="collapse-item text-light" href="password.html">Forgot Password</a>
                </div>
            </div>
        </div> -->
    </li>
    
    
    
    <?php if(session('role_id') == 3){?>
    <!-- <li class="nav-item">
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
    </li> -->
    <li class="nav-item">
        <?php
            $db = \Config\Database::connect();
            $get = $db->table('mahasiswa')->getWhere(['nim' => session('username')])->getRowArray();
            $matkul = $db->table('matakuliah')->select('*')->distinct()->getWhere(['kelas' => $get['kelas']])->getResultArray();
            $i = 2;
            foreach ($matkul as $mtk) {
        ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data<?= $i;?>"aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-book"></i>
            <span><?= $mtk['matakuliah'];?></span>
        </a>
        <div id="data<?= $i;?>" class="collapse" aria-labelledby="headingUtilities"data-parent="#accordionSidebar">
            <div class="bg-gray-800 py-2 collapse-inner rounded">
                <h6 class="collapse-header text-light">Pilih:</h6>
                <a class="collapse-item text-light" href="<?= base_url('kuliah/absensi/'. base64_encode($mtk['id']).'/'. base64_encode($mtk['kelas']));?>"> Absensi</a>
                <a class="collapse-item text-light" href="<?= base_url('kuliah/materi/'. base64_encode($mtk['id']).'/'. base64_encode($mtk['kelas']));?>"> Materi</a>
                <a class="collapse-item text-light" href="<?= base_url('kuliah/tugas/'. base64_encode($mtk['id']).'/'. base64_encode($mtk['kelas']));?>"> Tugas</a>
                <a class="collapse-item text-light" href="<?= base_url('kuliah/nilai/'. base64_encode($mtk['id']).'/'. base64_encode($mtk['kelas']));?>"> Nilai</a>
            </div>
        </div>
        <?php $i++;}?>
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