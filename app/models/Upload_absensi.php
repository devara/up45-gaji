<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
use PhpOffice\PhpSpreadsheet\IOFactory;
class Upload_absensi extends CI_Model
{
	
	public function up_absensi($filename,$idPer){
		ini_set('memory_limit', '-1');
		$inputFileName = FCPATH.'uploads/file/absensi/'.$filename;
		try {
			$objPHPExcel = IOFactory::load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file :' . $e->getMessage());
		}
		$worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$numRows = count($worksheet);
		for ($i=1; $i < ($numRows+1) ; $i++) {
			$nip = $worksheet[$i]["D"];
			$kode_jamkerja = $this->my_lib->get_row('data_pegawai',array('nip'=>$nip),'kode_jam_kerja');
			$jamkerja = $this->my_lib->get_data_row('master_jam_kerja',array('kode_jam_kerja'=>$kode_jamkerja));
			$date = strtotime($worksheet[$i]["A"]);
			$new_date = date('Y-m-d',$date);

			$get_day = date("l", $date);
			$day_name = strtolower($get_day);
			if ($day_name == "sunday") { //JIKA HARI MINGGU TIDAK DILAKUKAN PEMROSESAN
				
			}
			else{ //SELAIN MINGGU DATA DIPROSES
				if ($worksheet[$i]["B"] == "Tidak Hadir") { //JIKA TIDAK HADIR
					$hari = $this->lib_calendar->get_day($new_date);
					$in = '00:00:00';
					$out = '00:00:00';
					$lama_kerja = '00:00:00';
					$telat = 2;
					$keterangan = 'Tidak Hadir';
				}
				else{
					$status = explode(' ', $worksheet[$i]["B"]);
					if ($status[0] == 'Cuti' || $status[0] == 'Izin') { // JIKA CUTI ATAU IZIN
						if ($day_name == 'saturday') { //JIKA CUTI ATAU IZIN HARI SABTU
							$hari = $this->lib_calendar->get_day($new_date);
							$in = $jamkerja->row('jam_datang_sabtu');
							$out = $jamkerja->row('jam_pulang_sabtu');
							$lama_kerja = '05:00:00';
							$telat = 0;
							$keterangan = $worksheet[$i]["I"];
						}
						else{ //JIKA CUTI ATAU IZIN SELAIN HARI SABTU
							$hari = $this->lib_calendar->get_day($new_date);
							$in = $jamkerja->row('jam_datang');
							$out = $jamkerja->row('jam_pulang');
							$lama_kerja = '07:00:00';
							$telat = 0;
							$keterangan = $worksheet[$i]["I"];
						}
					}
					else{ //JIKA HADIR
						if ($day_name == "saturday") {
							$break = explode_time($jamkerja->row('jam_istirahat_sabtu'));
							$in_param = $jamkerja->row('jam_datang_sabtu');
							$out_param = $jamkerja->row('jam_pulang_sabtu');
							$telat_param = $jamkerja->row('toleransi_sabtu');
						}
						else {
							$break = explode_time($jamkerja->row('jam_istirahat'));
							$in_param = $jamkerja->row('jam_datang');
							$out_param = $jamkerja->row('jam_pulang');
							$telat_param = $jamkerja->row('toleransi');
						}
						if ($worksheet[$i]["G"] == "") { //JIKA JAM DATANG KOSONG
							$in = $in_param;
							$new_in = explode_time($in_param);
						}
						else {
							$in = $worksheet[$i]["G"];
							$new_in = explode_time($worksheet[$i]["G"]);
						}

						if ($worksheet[$i]["H"] == "") { //JIKA JAM PULANG KOSONG
							$out = $out_param;
							$new_out = explode_time($out_param);
						}
						else {
							$out = $worksheet[$i]["H"];
							$new_out = explode_time($worksheet[$i]["H"]);
						}

						$lama = $new_out - $new_in - $break;
						$lama_kerja = convert_second($lama);

						$nilai_toleransi = explode_time($telat_param);
						if ($new_in <= $nilai_toleransi) {
							$telat = 0;
						}
						else {
							$telat = 1;
						}
						$hari = $this->lib_calendar->get_day($new_date);
						$keterangan = "Hadir";
					}
				}

				if ($this->my_lib->cek('absensi_data',array('id_periode'=>$idPer,'tanggal'=>$new_date,'nip'=>$nip)) == FALSE) {
					$val_insert = array(
						"id_periode" => $idPer,
						"tanggal"    => $new_date,
						"hari"      => $hari,
						"nip"       => $worksheet[$i]["D"],
						"datang"     => $in,
						"pulang"     => $out,
						"lama_kerja" => $lama_kerja,
						"telat"      => $telat,
						"keterangan" => $keterangan
					);
					$this->my_lib->add_row('absensi_data',$val_insert);
				}				
			}
		}
		$peg = $this->my_lib->get_data('data_pegawai');
		foreach ($peg as $p) {
			$nip_peg = $p->nip;
			$tot =0;
			$tepat_waktu = $this->my_lib->row_count('absensi_data',array('id_periode'=>$idPer,'nip'=>$nip_peg,'telat'=>0));
			$data_absen = $this->my_lib->get_data('absensi_data',array('id_periode'=>$idPer,'nip'=>$nip_peg));
			if (!empty($data_absen)) {
				foreach ($data_absen as $absen) {
					$tot += explode_time($absen->lama_kerja);
				}
				$total_lama = convert_second($tot);
				$rata2 = $tot / 4;
				$new_rata2 = convert_second($rata2);
				if ($this->my_lib->cek('absensi_rekap',array('id_periode'=>$idPer,'nip'=>$nip_peg)) == TRUE) {
					$rekap_update = array(
						"total_jam" => $total_lama,
						"rerata" => $new_rata2,
						"tepat_waktu" =>$tepat_waktu
					);
					$this->my_lib->edit_row('absensi_rekap',$rekap_update,array('id_periode'=>$idPer,'nip'=>$nip_peg));
				}
				else{
					$rekap_insert = array(
						"id_periode" => $idPer,
						"nip" => $nip_peg,
						"total_jam" => $total_lama,
						"rerata" => $new_rata2,
						"tepat_waktu" =>$tepat_waktu
					);
					$this->my_lib->add_row('absensi_rekap',$rekap_insert);
				}				
			}
		}
		return TRUE;
	}
}
