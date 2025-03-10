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
							<a href="<?php echo base_url('data'); ?>"><button class="btn btn-primary">
									<i class="fa fa-plus"> </i> Cari Buku</button></a>

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
												<td><span class="badge badge-success"><?= $isi['status']; ?></span></td>
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

												<a href="<?= base_url('reservasi/detailReservasiAnggota/' . $isi['id']); ?>"
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
