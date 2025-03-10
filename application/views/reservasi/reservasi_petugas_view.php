<?php if (!defined('BASEPATH'))
	exit('No direct script acess allowed'); ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<i class="fa fa-edit" style="color:green"> </i> <?= $title_web; ?>
		</h1>
		<ol class="breadcrumb">
			
			<li class="active"><i class="fa fa-file-text"></i>&nbsp; <?= $title_web; ?></li>
		</ol>
	</section>
	<section class="content">
		<?php if (!empty($this->session->flashdata())) {
			echo $this->session->flashdata('pesan');
		} ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">

					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<br />
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table" width="100%">
								<thead>
									<tr>
										<th>ID Reservasi</th>
										<th>Tanggal Pengajuan</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($reservasi->result_array() as $isi) {

										?>
										<tr>
											<td>#<?= $isi['id']; ?></td>
											<td><?= $isi['tgl_pengajuan']; ?></td>

											<?php
											if ($isi['status'] == "Sedang Diperiksa") { ?>
												<td><span class="badge badge-info"><?= $isi['status']; ?></span></td>
												<?php
											}
											?>

											<?php
											if ($isi['status'] == "Diterima") { ?>
												<td><span class="badge badge-danger"><?= $isi['status']; ?></span></td>
												<?php
											}
											?>

											<?php
											if ($isi['status'] == "Ditolak") { ?>
												<td><span class="badge badge-danger"><?= $isi['status']; ?></span></td>
												<?php
											}
											?>
											<td>
												<a href="<?= base_url('reservasi/detailReservasiPetugas/' . $isi['id']); ?>"
													class="btn btn-primary btn-sm" title="detail pinjam">
													<i class="fa fa-eye"></i> Detail Reservasi</a>
											</td>
										</tr>
										<?php $no++;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="TableAnggota">
	<div class="modal-dialog" style="width:70%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"> Anggota Yang Reservasi</h4>
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
