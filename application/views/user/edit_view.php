<?php if (!defined('BASEPATH')) {
    exit('No direct script acess allowed');
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
    <?php if ($this->session->userdata('level') == 'Petugas') {?>
      <i class="fa fa-edit" style="color:green"> </i>  Update User - <?=$user->nama;?>
      <?php } elseif ($this->session->userdata('level') == 'Anggota') {?>
        <i class="fa fa-edit" style="color:green"> </i>  Detail User - <?=$user->nama;?>
        <?php } ?>
    </h1>
    <ol class="breadcrumb">
			<!-- <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li> -->
            <?php if ($this->session->userdata('level') == 'Petugas') {?>
			<li class="active"><i class="fa fa-edit"></i>&nbsp; Update User - <?=$user->nama;?></li>
            <?php } elseif ($this->session->userdata('level') == 'Anggota') {?>
            <li class="active"><i class="fa fa-edit"></i>&nbsp; Detail User - <?=$user->nama;?></li>
            <?php } ?>
    </ol>
  </section>
  <section class="content">
	<div class="row">
	    <div class="col-md-12">
			<?php if (!empty($this->session->flashdata())) {echo $this->session->flashdata('pesan');}?>

            <?php if ($this->session->userdata('level') == 'Petugas') {?>
                <div class="box box-primary">
                <div class="box-header with-border">
                </div>
			    <!-- /.box-header -->
			    <div class="box-body">
                    <form action="<?php echo base_url('user/upd'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Pengguna</label>
                                    <input type="text" class="form-control" value="<?=$user->nama;?>" name="nama" required="required" placeholder="Nama Pengguna">
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="lahir" value="<?=$user->tempat_lahir;?>" required="required" placeholder="Contoh : Bekasi">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" value="<?=$user->tgl_lahir;?>" required="required" placeholder="Contoh : 1999-05-18">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" value="<?=$user->user;?>"  name="user" required="required" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password (opsional)</label>
                                    <input type="password" class="form-control" name="pass" placeholder="Isi Password Jika di Perlukan Ganti">
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select name="level" class="form-control" required="required">
									<?php if ($this->session->userdata('level') == 'Petugas') {?>
										<option <?php if ($user->level == 'Petugas') {echo 'selected';}?>>Petugas</option>
										<option <?php if ($user->level == 'Anggota') {echo 'selected';}?>>Anggota</option>
									<?php } elseif ($this->session->userdata('level') == 'Anggota') {?>
										<option <?php if ($user->level == 'Anggota') {echo 'selected';}?>>Anggota</option>
									<?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <br/>
                                    <input type="radio" name="jenkel" <?php if ($user->jenkel == 'Laki-Laki') {echo 'checked';}?> value="Laki-Laki" required="required"> Laki-Laki
                                    <br/>
                                    <input type="radio" name="jenkel" <?php if ($user->jenkel == 'Perempuan') {echo 'checked';}?> value="Perempuan" required="required"> Perempuan
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input id="uintTextBox" class="form-control" value="<?=$user->telepon;?>" name="telepon" required="required" placeholder="Contoh : 089618173609">
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email"  value="<?=$user->email;?>" class="form-control" name="email" required="required" placeholder="Contoh : fauzan1892@codekop.com">
                                </div>
                                <div class="form-group">
                                    <label>Pas Foto</label>
                                    <input type="file" accept="image/*" name="gambar">

                                    <br/>
                                    <img src="<?=base_url('assets_style/image/' . $user->foto);?>" class="img-responsive" alt="#">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat"  required="required"><?=$user->alamat;?></textarea>
                                    <input type="hidden" class="form-control" value="<?=$user->id_login;?>" name="id_login">
                                    <input type="hidden" class="form-control" value="<?=$user->foto;?>" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary btn-md">Edit Data</button>
						</form>
						
							<a href="<?=base_url('user');?>" class="btn btn-danger btn-md">Kembali</a>
						
                        </div>
		        </div>
	        </div>

						<?php } elseif ($this->session->userdata('level') == 'Anggota') {?>
                            <div class="box box-primary">
                <div class="box-header with-border">
                </div>
			    <!-- /.box-header -->
			    <div class="box-body">
                    <form action="<?php echo base_url('user/upd'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Pengguna</label>
                                    <input type="text" class="form-control" value="<?=$user->nama;?>" name="nama">
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="lahir" value="<?=$user->tempat_lahir;?>">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" value="<?=$user->tgl_lahir;?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" value="<?=$user->user;?>" name="user">
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" class="form-control" value="<?=$user->level;?>" readonly name="level">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <br/>
                                    <input type="radio" name="jenkel" <?php if ($user->jenkel == 'Laki-Laki') {echo 'checked';}?> value="Laki-Laki" required="required"> Laki-Laki
                                    <br/>
                                    <input type="radio" name="jenkel" <?php if ($user->jenkel == 'Perempuan') {echo 'checked';}?> value="Perempuan" required="required"> Perempuan
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input id="uintTextBox" class="form-control" value="<?=$user->telepon;?>" name="telepon">
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email"  value="<?=$user->email;?>" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Pas Foto</label>
                                    
                                    <img src="<?=base_url('assets_style/image/' . $user->foto);?>" class="img-responsive" alt="#">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat"><?=$user->alamat;?></textarea>
                                    <input type="hidden" class="form-control" value="<?=$user->id_login;?>" name="id_login">
                                    <input type="hidden" class="form-control" value="<?=$user->foto;?>" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary btn-md">Edit Data</button>
						</form>
						
							<a href="<?=base_url('transaksi');?>" class="btn btn-danger btn-md">Kembali</a>
						
                        </div>
		        </div>
	        </div>

						<?php }?>

	    </div>
    </div>
</section>
</div>
