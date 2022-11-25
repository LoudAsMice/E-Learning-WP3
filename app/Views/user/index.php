<!-- Begin Page Content --> 
<div class="container-fluid"> 
    <div class="row"> <div class="col-lg-6 justify-content-x">
        <?= session()->getFlashdata('pesan')?>
    </div>
</div>
<div class="card-mb3" style="max-width: 540px">
    <div class="row no-glutters">
        <?php if(session('role_id') == 2) {?>
        <div class="col-md-4">
            <img src="<?= base_url('assets/img/profile').'/'.$dosen['image'];?>" class="card-img" alt="...">
        </div>
        <div class="col-md 8">
            <div class="card-body">
                <h5 class="card-title"><?= $dosen['nip'];?></h5>
                <p class="card-text">Role : <?= $role['role'];?></p>
                <p class="card-text"><?= $dosen['nama'];?></p>
                <p class="card-text"><small class="text-muted">Jadi member sejak: <br><b><?= date('d F Y', $dosen['tanggal_input'])?></b></small></p>
            </div>
            <div class="btn btn-info ml-3 my">
                <a href="<?= base_url('user/ubahprofil')?>" class="text text-white"><i class="fas fa-user-edit"> Ubah Profil</i></a>
            </div>
        </div>
        <?php }elseif(session('role_id') == 3){?>
        <div class="col-md-4">
            <img src="<?= base_url('assets/img/profile').'/'.$mahasiswa['image'];?>" class="card-img" alt="...">
        </div>
        <div class="col-md 8">
            <div class="card-body">
                <h5 class="card-title"><?= $mahasiswa['nim'];?></h5>
                <p class="card-text">Role : <?= $role['role'];?></p>
                <p class="card-text"><?= $mahasiswa['nama'];?></p>
                <p class="card-text"><small class="text-muted">Jadi member sejak: <br><b><?= date('d F Y', $mahasiswa['tanggal_input'])?></b></small></p>
            </div>
            <div class="btn btn-info ml-3 my">
                <a href="<?= base_url('user/ubahprofil')?>" class="text text-white"><i class="fas fa-user-edit"> Ubah Profil</i></a>
            </div>
        </div>
        <?php }elseif(session('role_id') == 1){?>
        <div class="col-md-4">
            <img src="<?= base_url('assets/img/profile').'/'.$user['image'];?>" class="card-img" alt="...">
        </div>
        <div class="col-md 8">
            <div class="card-body">
                <h5 class="card-title"><?= $user['username'];?></h5>

                <p class="card-text"><small class="text-muted">Jadi member sejak: <br><b><?= date('d F Y', $user['tanggal_input'])?></b></small></p>
            </div>
            <div class="btn btn-info ml-3 my">
                <a href="<?= base_url('user/ubahprofil')?>" class="text text-white"><i class="fas fa-user-edit"> Ubah Profil</i></a>
            </div>
        </div>
        <?php }?>
        
    </div>
</div>