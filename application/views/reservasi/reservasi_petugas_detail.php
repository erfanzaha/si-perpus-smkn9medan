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
						<!-- <h4><?= $buku->title; ?></h4> -->
					</div>


					<div class="box-body">
						<div class="row">
							<div class="col-sm-5">
								<table class="table table-striped">
									<tr style="background:yellowgreen">
										<td colspan="3">Data Reservasi</td>
									</tr>
									<tr>
										<td>No Reservasi</td>
										<td>:</td>
										<td>
											<?= $reservasi->id; ?>
										</td>
									</tr>
									<tr>
										<td>Tanggal Peminjaman</td>
										<td>:</td>
										<td>
											<?= $reservasi->tgl_pinjam; ?>
										</td>
									</tr>
									<tr>
										<td>Tgl pengembalian</td>
										<td>:</td>
										<td>
											<?= $reservasi->tgl_kembali; ?>
										</td>
									</tr>
									<tr>
										<td>ID Anggota</td>
										<td>:</td>
										<td>
											<?= $reservasi->anggota_id; ?>
										</td>
									</tr>
									<tr>
										<td>Biodata</td>
										<td>:</td>
										<td>
											<?php
											$user = $this->M_Admin->get_tableid_edit('tbl_login', 'anggota_id', $reservasi->anggota_id);
											error_reporting(0);
											if ($user->nama != null) {
												echo '<table class="table table-striped">
															<tr>
																<td>Nama Anggota</td>
																<td>:</td>
																<td>' . $user->nama . '</td>
															</tr>
															<tr>
																<td>Telepon</td>
																<td>:</td>
																<td>' . $user->telepon . '</td>
															</tr>
															<tr>
																<td>E-mail</td>
																<td>:</td>
																<td>' . $user->email . '</td>
															</tr>
															<tr>
																<td>Alamat</td>
																<td>:</td>
																<td>' . $user->alamat . '</td>
															</tr>
															<tr>
																<td>Level</td>
																<td>:</td>
																<td>' . $user->level . '</td>
															</tr>
														</table>';
											} else {
												echo 'Anggota Tidak Ditemukan !';
											}
											?>
										</td>
									</tr>
									<tr>
										<td>Lama Peminjaman</td>
										<td>:</td>
										<td>
											<?= $reservasi->durasi; ?> Hari
										</td>
									</tr>
									<tr>
										<td>Keterangan</td>
										<td>:</td>
										<td>
											<div class="input-group">
												<textarea name="keterangan" style="resize: none;" class="form-control" id="keterangan" rows="10" cols="100" disabled><?= $reservasi->keterangan_anggota; ?></textarea>
											</div>
										</td>
									</tr>
								</table>
							</div>
							<div class="col-sm-7">
								<table class="table table-striped">
									<tr style="background:yellowgreen">
										<td colspan="3">Data Buku</td>
									</tr>
									<tr>
										<td>Status</td>
										<td>:</td>
										<?php
										if ($reservasi->status == "Sedang Diperiksa") { ?>
											<td><span class="badge badge-info"><?= $reservasi->status; ?></span></td>
										<?php
										}
										?>

										<?php
										if ($reservasi->status == "Diterima") { ?>
											<td><span class="badge badge-success"><?= $reservasi->status; ?></span></td>
										<?php
										}
										?>

										<?php
										if ($reservasi->status == "Ditolak") { ?>
											<td><span class="badge badge-danger"><?= $reservasi->status; ?></span></td>
										<?php
										}
										?>
									</tr>
									<tr>
										<td>Kode Buku</td>
										<td>:</td>
										<td>
											<?= $buku->buku_id ?>
										</td>
									</tr>

									<tr>
										<td>Judul Buku</td>
										<td>:</td>
										<td><?= $buku->title; ?></td>
									</tr>
									<tr>
										<td>Penerbit</td>
										<td>:</td>
										<td><?= $buku->penerbit; ?></td>
									</tr>
									<tr>
										<td>Tahun Terbit</td>
										<td>:</td>
										<td><?= $buku->thn_buku; ?></td>
									</tr>
									<tr>
										<td>Pengarang</td>
										<td>:</td>
										<td><?= $buku->pengarang; ?></td>
									</tr>
									<tr>
										<td>Rak Buku</td>
										<td>:</td>
										<td><?= $rak->nama_rak; ?></td>
									</tr>
									<tr>
										<td>Kategori Buku</td>
										<td>:</td>
										<td><?= $kat->nama_kategori; ?></td>
									</tr>

								</table>
							</div>
							<?php

							if ($reservasi->status == "Sedang Diperiksa") { ?>
								<div class="col-sm-7">
									<table class="table table-striped">
										<tr style="background:yellowgreen">
											<td colspan="3">Form Respon</td>
										</tr>
										<form action="<?php echo base_url('reservasi/submitPetugas'); ?>" method="POST">
											<tr>
												<td>Status</td>
												<td>:</td>
												<td>
													<select class="form-control select2" required="required" name="status">
														<option disabled selected value> -- Pilih Status -- </option>
														<option value="Diterima">Diterima
														</option>
														<option value="Ditolak">Ditolak
														</option>
													</select>
												</td>
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
									<input type="hidden" name="edit" value="edit">
									<input type="hidden" name="id_reservasi" value="<?= $reservasi->id ?>">
									<button type="reset" class="btn btn-default">Reset</button>
									<button type="submit" class="btn btn-primary btn-md">Submit</button>
									</form>
								</div>
							<?php
							} else { ?>
								<div class="col-sm-7">
									<table class="table table-striped">
										<tr style="background:yellowgreen">
											<td colspan="3">Form Respon</td>
										</tr>
										<tr>
											<td>Status</td>
											<td>:</td>

											<?php
											if ($reservasi->status == "Diterima") { ?>
												<td><span class="badge badge-success"><?= $reservasi->status; ?></span></td>
											<?php
											}
											?>

											<?php
											if ($reservasi->status == "Ditolak") { ?>
												<td><span class="badge badge-danger"><?= $reservasi->status; ?></span></td>
											<?php
											}
											?>

										</tr>
										<tr>
											<td>Keterangan</td>
											<td>:</td>
											<td>
												<div class="input-group">
													<textarea name="keterangan" style="resize: none;" class="form-control" id="keterangan" rows="10" cols="100" disabled> <?= $reservasi->keterangan_petugas ?> </textarea>
												</div>
											</td>
										</tr>
										<tr>
											<td>Tanggal Respon</td>
											<td>:</td>
											<td>
												<?= $reservasi->respon_date ?>
											</td>
										</tr>
										<tr>
											<td>Nama Petugas</td>
											<td>:</td>
											<td>
												<?php

												$dataPetugas = $this->db->get_where('tbl_login', [
													'anggota_id' => $reservasi->id_respon
												])->row();

												echo $dataPetugas->nama;


												?>
											</td>
										</tr>

									</table>


								</div>
							<?php }

							?>

						</div>
						<div class="pull-right">
							<a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-danger btn-md">Kembali</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
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