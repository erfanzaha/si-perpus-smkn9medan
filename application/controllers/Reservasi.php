<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->data['CI'] =& get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->library(array('cart'));
		if ($this->session->userdata('masuk_perpus') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->data['title_web'] = 'Reservasi Buku';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['reservasi'] = $this->db->get_where('tbl_reservasi', [
			'status' => "Sedang Diperiksa"
		]);


		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('reservasi/reservasi_petugas_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function ditolak()
	{
		$this->data['title_web'] = 'Reservasi Buku';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['reservasi'] = $this->db->get_where('tbl_reservasi', [
			'status' => "Ditolak"
		]);

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('reservasi/reservasi_petugas_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function diterima()
	{
		$this->data['title_web'] = 'Reservasi Buku';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['reservasi'] = $this->db->get_where('tbl_reservasi', [
			'status' => "Diterima"
		]);


		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('reservasi/reservasi_petugas_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function reservasi_saya()
	{
		$this->data['title_web'] = 'Reservasi Buku';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['reservasi'] = $this->db->get_where('tbl_reservasi', [
			'anggota_id' => $this->session->userdata('anggota_id')
		]);


		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('reservasi/reservasi_anggota_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function submitAnggota()
	{
		$post = $this->input->post();

		if (!empty($post['tambah'])) {

			$tgl = $post['tgl_peminjaman'];
			$tgl2 = date('Y-m-d', strtotime('+' . $post['durasi'] . ' days', strtotime($tgl)));

			$data = [
				'tgl_pengajuan' => date('Y-m-d'),
				'anggota_id' => $this->session->userdata('anggota_id'),
				'buku_id' => $post['id_buku'],
				'tgl_pinjam' => htmlentities($post['tgl_peminjaman']),
				'durasi' => $post['durasi'],
				'tgl_kembali' => $tgl2,
				'status' => 'Sedang Diperiksa',
				'keterangan_anggota' => htmlentities($post['keterangan']),
				'keterangan_petugas' => ''
			];

			$this->db->insert('tbl_reservasi', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Reservasi Buku Sukses !</p>
			</div></div>');
			redirect(base_url('reservasi/reservasi_saya'));
		}
	}

	public function submitPetugas()
	{
		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();
			$data = array(
				'status' => htmlentities($post['status']),
				'keterangan_petugas' => htmlentities($post['keterangan']),
				'id_respon' => $this->session->userdata('anggota_id'),
				'respon_date' => date('Y-m-d')
			);
			$this->db->where('id', htmlentities($post['id_reservasi']));
			$this->db->update('tbl_reservasi', $data);

			if ($post['status'] == "Diterima") {
				$nop = $this->M_Admin->buat_kode('tbl_pinjam', 'PJ', 'id_pinjam', 'ORDER BY id_pinjam DESC LIMIT 1');

				$reservasi = $this->db->get_where('tbl_reservasi', [
					'id' => $post['id_reservasi']
				])->row();

				$buku = $this->db->get_where('tbl_buku', [
					'id_buku' => $reservasi->buku_id
				])->row();

				$dataPinjam = [
					'pinjam_id' => $nop,
					'anggota_id' => $reservasi->anggota_id,
					'buku_id' => $buku->buku_id,
					'status' => 'Dipinjam',
					'tgl_pinjam' => $reservasi->tgl_pinjam,
					'lama_pinjam' => $reservasi->durasi,
					'tgl_balik' => $reservasi->tgl_kembali,
					'tgl_kembali' => '0',
				];

				$this->db->insert('tbl_pinjam', $dataPinjam);

				$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Berhasil Memberi Respon, Data Pinjam Berhasil Dibuat !</p>
			</div></div>');
			} else {
				$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Berhasil Memberi Respon !</p>
			</div></div>');
			}



			redirect(base_url('Reservasi'));
		}

	}

	public function detailReservasiPetugas()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_reservasi', 'id', $this->uri->segment('3'));
		if ($count > 0) {
			$reservasiData = $this->db->get_where('tbl_reservasi', [
				'id' => $this->uri->segment('3')
			])->row();

			$this->data['reservasi'] = $reservasiData;

			$this->data['dataPeminjam'] = $this->db->get_where('tbl_login', [
				'anggota_id' => $reservasiData->anggota_id
			])->row();

			$this->data['buku'] = $this->M_Admin->get_tableid_edit('tbl_buku', 'id_buku', $reservasiData->buku_id);
			$this->data['kats'] = $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] = $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();

		} else {
			echo '<script>alert("BUKU TIDAK DITEMUKAN");window.location="' . base_url('reservasi') . '"</script>';
		}

		$this->data['title_web'] = 'Data Reservasi Detail';

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('reservasi/reservasi_petugas_detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function detailReservasiAnggota()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_reservasi', 'id', $this->uri->segment('3'));
		if ($count > 0) {
			$reservasiData = $this->db->get_where('tbl_reservasi', [
				'id' => $this->uri->segment('3')
			])->row();

			$this->data['reservasi'] = $reservasiData;

			$this->data['dataPeminjam'] = $this->db->get_where('tbl_login', [
				'anggota_id' => $reservasiData->anggota_id
			])->row();

			$this->data['buku'] = $this->M_Admin->get_tableid_edit('tbl_buku', 'id_buku', $reservasiData->buku_id);
			$this->data['kats'] = $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] = $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();

		} else {
			echo '<script>alert("BUKU TIDAK DITEMUKAN");window.location="' . base_url('reservasi') . '"</script>';
		}

		$this->data['title_web'] = 'Data Reservasi Detail';

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('reservasi/reservasi_anggota_detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

}
