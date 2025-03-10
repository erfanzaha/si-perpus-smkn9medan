<?php if (!defined('BASEPATH'))
	exit('No direct script acess allowed'); ?>
<?php
$idkat = $buku->id_kategori;
$idrak = $buku->id_rak;

$kat = $this->M_Admin->get_tableid_edit('tbl_kategori', 'id_kategori', $idkat);
$rak = $this->M_Admin->get_tableid_edit('tbl_rak', 'id_rak', $idrak);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<i class="fa fa-book" style="color:green"> </i> <?= $title_web; ?>
		</h1>
		<ol class="breadcrumb">

			<li class="active"><i class="fa fa-book"></i>&nbsp; <?= $title_web; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4><?= $buku->title; ?></h4>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-striped table-bordered">
							<tr>
								<td style="width:20%">ISBN</td>
								<td><?= $buku->isbn; ?></td>
							</tr>
							<tr>
								<td>Sampul Buku</td>
								<td><?php if (!empty($buku->sampul !== "0")) { ?>
										<a href="<?= base_url('assets_style/image/buku/' . $buku->sampul); ?>" target="_blank">
											<img src="<?= base_url('assets_style/image/buku/' . $buku->sampul); ?>" style="width:170px;height:170px;" class="img-responsive">
										</a>
									<?php } else {
										echo '<br/><p style="color:red">* Tidak ada Sampul</p>';
									} ?>
								</td>
							</tr>
							<tr>
								<td>Judul Buku</td>
								<td><?= $buku->title; ?></td>
							</tr>
							<tr>
								<td>Kategori</td>
								<td><?= $kat->nama_kategori; ?></td>
							</tr>
							<tr>
								<td>Penerbit</td>
								<td><?= $buku->penerbit; ?></td>
							</tr>
							<tr>
								<td>Pengarang</td>
								<td><?= $buku->pengarang; ?></td>
							</tr>
							<tr>
								<td>Tahun Terbit</td>
								<td><?= $buku->thn_buku; ?></td>
							</tr>
							<tr>
								<td>Jumlah Buku</td>
								<td><?= $buku->jml; ?></td>
							</tr>
							<tr>
								<td>Jumlah Pinjam</td>
								<td>
									<?php
									$id = $buku->buku_id;
									$dd = $this->db->query("SELECT * FROM tbl_pinjam WHERE buku_id= '$id' AND status = 'Dipinjam'");
									if ($dd->num_rows() > 0) {
										echo $dd->num_rows();
									} else {
										echo '0';
									}
									?>
									<a data-toggle="modal" data-target="#TableAnggota" class="btn btn-primary btn-xs" style="margin-left:1pc;">
										<i class="fa fa-sign-in"></i> Detail Pinjam</a>
								</td>
							</tr>
							<tr>
								<td>Keterangan Lainnya</td>
								<td><?= $buku->isi; ?></td>
							</tr>
							<tr>
								<td>Rak / Lokasi</td>
								<td><?= $rak->nama_rak; ?></td>
							</tr>
							<tr>
								<td>Lampiran</td>
								<td><?php if (!empty($buku->lampiran !== "0")) { ?>
										<a href="<?= base_url('assets_style/image/buku/' . $buku->lampiran); ?>" class="btn btn-primary btn-md" target="_blank">
											<i class="fa fa-download"></i> Sample Buku
										</a>
									<?php } else {
										echo '<br/><p style="color:red">* Tidak ada Lampiran</p>';
									} ?>
								</td>
							</tr>
							<tr>
								<td>Tanggal Masuk</td>
								<td><?= $buku->tgl_masuk; ?></td>
							</tr>
							<?php
							if ($CI->session->userdata('level') == 'Anggota') { ?>
								<tr>
									<td>Aksi</td>
									<td><a data-toggle="modal" data-target="#FormReservasi" class="btn btn-success btn-xs" style="margin-left:1pc;">
											<i class="fa fa-sign-in"></i> Reservasi</a></td>
								</tr>
							<?php
							}
							?>

						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="FormReservasi">
	<div class="modal-dialog" style="width:70%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"> Reservasi Buku</h4>
			</div>
			<div id="modal_body" class="modal-body fileSelection1">
				<form action="<?php echo base_url('reservasi/submitAnggota'); ?>" method="POST">

					<div class="row">
						<div class="col-sm-5">
							<table class="table table-striped">
								<tr style="background:yellowgreen">
									<td colspan="3">Data Transaksi</td>
								</tr>

								<tr>
									<td>Tanggal Peminjaman</td>
									<td>:</td>
									<td>
										<input type="date" value="<?= date('Y-m-d'); ?>" name="tgl_peminjaman" class="form-control">
									</td>
								</tr>
								<!-- <tr>
									<td>Tanggal Pengembalian</td>
									<td>:</td>
									<td>
										<input type="date" value="<?= date('Y-m-d'); ?>" name="tgl_pengembalian"
											class="form-control">
									</td>
								</tr> -->
								<tr>
									<td>Lama Pinjam</td>
									<td>:</td>
									<td>
										<!-- <input type="number" required placeholder="Lama Pinjam Contoh : 2 Hari (2)" name="durasi" class="form-control"> -->
										<select name="lama" class="form-control" required>
											<option disabled selected value> -- Durasi Peminjaman Buku -- </option>
											<option>7</option>
											<option>14</option>
											<option>30</option>
											<option>360</option>

										</select>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-sm-7">
							<table class="table table-striped">
								<tr style="background:yellowgreen">
									<td colspan="3">Pinjam Buku</td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td>:</td>
									<td>
										<div class="input-group">
											<textarea name="keterangan" style="resize: none;" class="form-control" id="keterangan" rows="10" cols="100"></textarea>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>



			</div>
			<div class="modal-footer">
				<input type="hidden" name="tambah" value="tambah">
				<input type="hidden" name="id_buku" value="<?= $buku->id_buku ?>">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-md">Submit</button>

				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!--modal import -->
<div class="modal fade" id="TableAnggota">
	<div class="modal-dialog" style="width:70%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"> Anggota Yang Sedang Pinjam</h4>
			</div>
			<div id="modal_body" class="modal-body fileSelection1">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>ID</th>
							<th>Nama</th>
							<th>Jenkel</th>
							<th>Telepon</th>
							<th>Tgl Pinjam</th>
							<th>Lama Pinjam</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$bukuid = $buku->buku_id;
						$pin = $this->db->query("SELECT * FROM tbl_pinjam WHERE buku_id ='$bukuid' AND status = 'Dipinjam'")->result_array();
						foreach ($pin as $si) {
							$isi = $this->M_Admin->get_tableid_edit('tbl_login', 'anggota_id', $si['anggota_id']);
							if ($isi->level == 'Anggota') {
						?>
								<tr>
									<td><?= $no; ?></td>
									<td><?= $isi->anggota_id; ?></td>
									<td><?= $isi->nama; ?></td>
									<td><?= $isi->jenkel; ?></td>
									<td><?= $isi->telepon; ?></td>
									<td><?= $si['tgl_pinjam']; ?></td>
									<td><?= $si['lama_pinjam']; ?> Hari</td>
								</tr>
						<?php $no++;
							}
						} ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


<!-- /.modal -->