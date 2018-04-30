<?php 
/**
* 
*/
class Lib_rand {

	function random_str($type = 'alphanum', $length = 8)
	{
	    switch($type)
	    {
	        case 'basic'    : return mt_rand();
	            break;
	        case 'alpha'    :
	        case 'alphanum' :
	        case 'num'      :
	        case 'nozero'   :
	                $seedings             = array();
	                $seedings['alpha']    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	                $seedings['alphanum'] = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	                $seedings['num']      = '0123456789';
	                $seedings['nozero']   = '123456789';
	                
	                $pool = $seedings[$type];
	                
	                $str = '';
	                for ($i=0; $i < $length; $i++)
	                {
	                    $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
	                }
	                return $str;
	            break;
	        case 'unique'   :
	        case 'md5'      :
	                    return md5(uniqid(mt_rand()));
	            break;
	    }
	}
}