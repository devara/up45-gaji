<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('set_header_message'))
{
	function set_header_message($tipe,$title,$message)
	{
		$CI=& get_instance();
		
		$CI->session->set_flashdata('message_header',array(
		'tipe'=>$tipe,
		'title'=>$title,
		'message'=>$message,
		));				
	}
}

if(!function_exists('field_value'))
{
	function field_value($table,$key,$keyval,$output)
	{
		$CI=& get_instance();
		$CI->load->library('my_lib');
		$s=array(
		$key=>$keyval,
		);
		$item=$CI->my_lib->get_row($table,$s,$output);
		return $item;
	}
}

if (!function_exists('explode_time')) {
	function explode_time($time) { //explode time and convert into seconds
        $time = explode(':', $time);
        $time = $time[0] * 3600 + $time[1] * 60 + $time[2];
        return $time;
	}
}

if (!function_exists('convert_second')) {
	function convert_second($time) { //convert seconds to hh:mm
        $hour = floor($time / 3600);
        $minute = strval(floor(($time % 3600) / 60));
        $second = $time % 60;
        if ($hour < 10) {
            $hour = "0".$hour;
        } else {
            $hour = $hour;
        }

        if ($minute < 10) {
            $minute = "0".$minute;
        } else {
            $minute = $minute;
        }

        if ($second < 10) {
            $second = "0".$second;
        } else {
            $second = $second;
        }
        $time = $hour . ":" . $minute.":".$second;
        return $time;
	}
}

if(!function_exists('menu_active'))
{
	function menu_active($slug2)
	{
		$CI=& get_instance();
		$s=$CI->uri->segment(2);
		if($slug2==$s)
		{
			return true;
		}else{
			return false;
		}
	}
}

if(!function_exists('submenu_active'))
{
	function submenu_active($slug2)
	{
		$CI=& get_instance();
		$s=$CI->uri->segment(3);
		if($slug2==$s)
		{
			return true;
		}else{
			return false;
		}
	}
}

if(!function_exists('add_css'))
{
	function add_css($url)
	{
		$tmp='<link rel="stylesheet" href="'.$url.'">';
		return $tmp;
	}
}

if(!function_exists('add_js'))
{
	function add_js($url)
	{
		$tmp='<script src="'.$url.'"></script>';
		return $tmp;
	}
}

if(!function_exists('asset_jquery'))
{
	function asset_jquery()
	{				
		return add_js(base_url().'assets/backend/lte/jquery-3.1.1.min.js');;
	}
}

if(!function_exists('asset_jqueryui'))
{
	function asset_jqueryui($theme="smoothness")
	{
		$a='';
		$a.=add_css(base_url().'assets/backend/plugin/jqueryui/jquery-ui.min.css');
		$a.=add_css(base_url().'assets/backend/plugin/jqueryui/themes/'.$theme.'/jquery-ui.min.css');
		$a.=add_js(base_url().'assets/backend/plugin/jqueryui/jquery-ui.min.js');
		return $a;
	}
}

if(!function_exists('asset_datatables'))
{
	function asset_datatables()
	{
		$a='';				
		$a.=add_css(base_url().'assets/backend/plugin/datatables/DataTables/css/dataTables.bootstrap.min.css');
		$a.=add_css(base_url().'assets/backend/plugin/datatables/Responsive/css/responsive.bootstrap.min.css');
		$a.=add_css(base_url().'assets/backend/plugin/datatables/Buttons/css/buttons.dataTables.min.css');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/DataTables/js/jquery.dataTables.min.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/Responsive/js/dataTables.responsive.min.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/DataTables/js/dataTables.bootstrap.min.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/Responsive/js/responsive.bootstrap.min.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/Buttons/js/dataTables.buttons.min.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/Buttons/js/buttons.flash.min.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/JSZip/jszip.min.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/pdfmake/build/pdfmake.min.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/pdfmake/build/vfs_fonts.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/Buttons/js/buttons.html5.min.js');
		$a.=add_js(base_url().'assets/backend/plugin/datatables/Buttons/js/buttons.print.min.js');		
		
		return $a;
	}
}

if(!function_exists('tglIndo'))
{
	function tglIndo($date)
	{
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
	 
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
		return($result);
	}
}