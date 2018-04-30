<?php

class Lib_Calendar {
  function convert($date,$type=false){
    $day = date('d',strtotime($date));
    $month = date('m',strtotime($date));
    $year = date('Y',strtotime($date));
    return $day.' '.$this->replace_month($month,$type).' '.$year;
  }
  function replace_month($month,$type=false){
    if($type=='short'){
      $month = str_replace(
                        array('01','02','03','04','05','06','07','08','09','10','11','12'),
                        array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'),
                        $month
                      );
    }else{
      $month = str_replace(
                        array('01','02','03','04','05','06','07','08','09','10','11','12'),
                        array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'),
                        $month
                      );
    }
    return $month;
  }

  function get_day($tgl){
    $tanggal = strtotime($tgl);
    $convert = date("l", $tanggal);
    $day = strtolower($convert);
    $hari = str_replace(
      array('sunday','monday','tuesday','wednesday','thursday','friday','saturday'),
      array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'),
      $day
    );
    return $hari;
  }
  
}