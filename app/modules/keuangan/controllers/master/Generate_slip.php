<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Generate_slip extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_keuangan()==FALSE) {
    	redirect(base_url());
    }
	}
	
	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja');
		$data['javascript'] = $this->load->view('master/generate-slip-js',$data,true);
		$this->load->view('master/generate-slip',$data);		
	}

	function tampil_data()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$unit = $this->input->post('unit');
			
			$data['nominal'] = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));
			$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			$data['unit'] = $this->my_lib->get_data_row('master_unit_kerja',array('kode_unit'=>$unit));
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('kode_unit'=>$unit));
			$tabel = $this->load->view('master/generate-slip-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function generate()
	{
		$this->form_validation->set_rules('idperiode', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('kodeunit', 'Unit Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('idperiode');
			$unit = $this->input->post('kodeunit');
			$nama_unit = $this->my_lib->get_row('master_unit_kerja',array('kode_unit'=>$unit),'nama_unit');
			$nominal = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));
			$pegawai = $this->my_lib->get_data('data_pegawai',array('kode_unit'=>$unit));
			foreach ($pegawai as $peg) {
				$gapok = $peg->gaji_pokok;
				$tgppw = $peg->tgppw;
				$param_jam = explode_time('35:00:00');
				if ($this->my_lib->cek('absensi_rekap',array('id_periode'=>$per,'nip'=>$peg->nip)) == TRUE) {
					$rerata = explode_time($this->my_lib->get_row('absensi_rekap',array('id_periode'=>$per,'nip'=>$peg->nip),'rerata'));
					if ($rerata >= $param_jam) {
						$tpd = $nominal->row('tpd');
					}
					else{
						$tpd = 0;
					}
				}
				else{
					$tpd = 0;
				}				
				$tunj_jab =  $this->my_lib->get_row('master_jabatan',array('kode_jabatan'=>$peg->kode_jabatan),'tunjangan_jabatan');
				$tunj_bpjs = $nominal->row('tunjangan_bpjs');
				$tunj_fungsional = 0;
				$tunj_op = 0;
				$tunj_sks = 0;
				$transport = 0;
				$hal_khusus = $nominal->row('hal_khusus');
				$cek_insentif = $this->my_lib->get_row('data_insentif_op',array('id_periode'=>$per,'nip'=>$peg->nip),'total_insentif');
				if ($cek_insentif) {
					$insentif = $cek_insentif;
				}
				else{
					$insentif = 0;
				}
				$cek_rapat = $this->my_lib->get_row('data_upah_rapat',array('id_periode'=>$per,'nip'=>$peg->nip),'jml_upah');
				if ($cek_rapat) {
					$rapat = $cek_rapat;
				}
				else{
					$rapat = 0;
				}
				$cek_lembur = $this->my_lib->get_row('data_upah_lembur',array('id_periode'=>$per,'nip'=>$peg->nip),'jml_upah');
				if ($cek_lembur) {
					$lembur = $cek_lembur;
				}
				else{
					$lembur = 0;
				}
				$cek_pengawas = $this->my_lib->get_row('data_upah_pengawas',array('id_periode'=>$per,'nip'=>$peg->nip),'jml_upah');
				if ($cek_pengawas) {
					$pengawas = $cek_pengawas;
				}
				else{
					$pengawas = 0;
				}
				$cek_korektor = $this->my_lib->get_row('data_upah_korektor',array('id_periode'=>$per,'nip'=>$peg->nip),'jml_upah');
				if ($cek_korektor) {
					$korektor = $cek_korektor;
				}
				else{
					$korektor = 0;
				}
				if ($peg->bpjs_aktif=='ya') {
					$potongan_bpjs = $nominal->row('potongan_bpjs');
				}
				else{
					$potongan_bpjs = 0;
				}
				if ($peg->koperasi_aktif=='ya') {
					$potongan_koperasi = $nominal->row('potongan_koperasi');
				}
				else{
					$potongan_koperasi = 0;
				}
				$biaya_transfer = 0;
				$pinjaman = 0;

				// MULAI HITUNG GAJI
				$gaji_bruto = $gapok + $tgppw + $tpd + $tunj_jab + $tunj_bpjs + $tunj_fungsional + $tunj_op + $tunj_sks + $transport + $insentif + $hal_khusus + $rapat + $lembur + $pengawas + $korektor;
				$jml_potongan = $potongan_bpjs + $potongan_koperasi + $biaya_transfer + $pinjaman;
				$gaji_bersih = $gaji_bruto - $jml_potongan;

				$param = array(
					'id_periode' =>$per,
					'nip' =>$peg->nip
				);
				if ($this->my_lib->cek('data_slip_gaji',$param) == TRUE) {
					$value = array(
						'gaji_pokok' => $gapok,
						'tgppw'=>$tgppw,
						'tpd'=>$tpd,
						'tunj_jabatan'=>$tunj_jab,
						'tunj_fungsional'=>$tunj_fungsional,
						'tunj_bpjs'=>$tunj_bpjs,
						'tunj_sks'=>$tunj_sks,
						'transport'=>$transport,
						'upah_rapat'=>$rapat,
						'upah_lembur'=>$lembur,
						'upah_pengawas'=>$pengawas,
						'upah_korektor'=>$korektor,
						'insentif_op'=>$insentif,
						'tunj_op'=>$tunj_op,
						'hal_khusus'=>$hal_khusus,
						'gaji_bruto'=>$gaji_bruto,
						'biaya_transfer'=>$biaya_transfer,
						'pot_bpjs'=>$potongan_bpjs,
						'koperasi'=>$potongan_koperasi,
						'pinjaman'=>$pinjaman,
						'jml_potongan'=>$jml_potongan,
						'gaji_bersih'=>$gaji_bersih
					);
					$this->my_lib->edit_row('data_slip_gaji',$value,$param);
				}
				else{
					$value = array(
						'id_periode' => $per,
						'nip' => $peg->nip,
						'gaji_pokok' => $gapok,
						'tgppw'=>$tgppw,
						'tpd'=>$tpd,
						'tunj_jabatan'=>$tunj_jab,
						'tunj_fungsional'=>$tunj_fungsional,
						'tunj_bpjs'=>$tunj_bpjs,
						'tunj_sks'=>$tunj_sks,
						'transport'=>$transport,
						'upah_rapat'=>$rapat,
						'upah_lembur'=>$lembur,
						'upah_pengawas'=>$pengawas,
						'upah_korektor'=>$korektor,
						'insentif_op'=>$insentif,
						'tunj_op'=>$tunj_op,
						'hal_khusus'=>$hal_khusus,
						'gaji_bruto'=>$gaji_bruto,
						'biaya_transfer'=>$biaya_transfer,
						'pot_bpjs'=>$potongan_bpjs,
						'koperasi'=>$potongan_koperasi,
						'pinjaman'=>$pinjaman,
						'jml_potongan'=>$jml_potongan,
						'gaji_bersih'=>$gaji_bersih
					);
					$this->my_lib->add_row('data_slip_gaji',$value);
				}				
				
			}
			$alert_type = "success";
	    $alert_title ="Generate slip gaji untuk Unit Kerja ".$nama_unit." berhasil";
			set_header_message($alert_type,'Generate Slip Gaji',$alert_title);
			redirect(keuangan()."master/generate_slip");
		}
		else{
			
		}
	}
}
