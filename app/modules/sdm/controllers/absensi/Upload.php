<?php defined('BASEPATH') OR exit('');
/**
* 
*/
use PhpOffice\PhpSpreadsheet\IOFactory;
class Upload extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("upload_absensi");
    if ($this->lib_login->is_sdm()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('absensi/upload-js',$data,true);
		$this->load->view('absensi/upload',$data);
	}

	function do_upload()
	{
		$start = microtime(TRUE);
		$this->form_validation->set_rules('idPer', 'Periode Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$idPer = $this->input->post('idPer');
			$config['upload_path'] = FCPATH.'uploads/file/absensi/';
	    $config['allowed_types'] = 'xlsx|xls';
	    $this->load->library('upload', $config);
	    if ($this->upload->do_upload('addfile')) {
	    	$data = array('upload_data' => $this->upload->data());
	    	$upload_data = $this->upload->data();
	    	$filename = $upload_data['file_name'];
	    	if ($this->upload_absensi->up_absensi($filename,$idPer) == TRUE) {
	    		$finish = microtime(TRUE);
	    		$totaltime = $finish - $start;
	    		$alert_type = "success";
			    $alert_title ="Upload Absensi berhasil dengan waktu ".$totaltime." detik";
					set_header_message($alert_type,'Upload Absensi',$alert_title);
		    	redirect(sdm().'absensi/upload/');
	    	}
	    	else{
	    		$alert_type = "danger";
			    $alert_title ="Anda sudah upload Absensi untuk periode ini";
					set_header_message($alert_type,'Upload Absensi',$alert_title);
		    	redirect(sdm().'absensi/upload/');
	    	}    	
	    	
	    }else{
	    	$alert_type = "danger";
	      $alert_title =" Upload Absensi gagal";
				set_header_message($alert_type,'Upload Absensi',$alert_title);
				redirect(sdm().'absensi/upload');
	    }
		}
		else{
			$alert_type = "danger";
	    $alert_title =" Upload Absensi gagal";
			set_header_message($alert_type,'Upload Absensi',$alert_title);
			redirect(sdm().'absensi/upload');
		}
		
	}

	function berhasil($filename)
	{
		ini_set('memory_limit', '-1');
		$inputFileName = FCPATH.'uploads/file/absensi/'.$filename;
		try {
      $objPHPExcel = IOFactory::load($inputFileName);
    } catch(Exception $e) {
      die('Error loading file :' . $e->getMessage());
    }
    $data['worksheet'] = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    $data['datatables'] = 'yes';
    $data['javascript'] = $this->load->view('absensi/upload-js',$data,true);
    $alert_type = "success";
    $alert_title =" Upload Absensi berhasil";
		set_header_message($alert_type,'Upload Absensi',$alert_title);
    $this->load->view('absensi/upload-yes',$data);
	}
}
