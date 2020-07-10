<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//untuk mengetahui bulan bulan


if( ! function_exists('create_id_krs')){
function create_id_krs($nim,$sem)
	{
		$konvert=array(
			"A"=>"01",
			"B"=>"02",
			"C"=>"03",
			"D"=>"04",
			"E"=>"05",
			"F"=>"06",
			"G"=>"07",
			"H"=>"08",
			"I"=>"09",
			"J"=>"10",
			"K"=>"11",
			"L"=>"12",
			"M"=>"13",
			"N"=>"14",
			"O"=>"15",
			"P"=>"16",
			"Q"=>"17",
			"R"=>"18",
			"S"=>"19",
			"T"=>"20",
			"U"=>"21",
			"V"=>"22",
			"W"=>"23",
			"X"=>"24",
			"Y"=>"25",
			"Z"=>"26"
		);
		
		$id='';
//		if(!is_numeric($nim)){
                    for ($a=0;$a<=strlen($nim)-1;$a++){
                            if (array_key_exists($nim[$a],$konvert))
                            {
                                    $id.=$konvert[$nim[$a]];
                            } else
                                    $id.=$nim[$a];

                    }
//                }else{
//                    $id = $nim;
//                }
		return $sem.$id;
		
		
		
	}
}

if( ! function_exists('add_nol')){
function add_nol($angka)
	{
		if ($angka<10) return "0000000000000".$angka; else
		if ($angka<100) return "000000000000".$angka; else
		if ($angka<1000) return "00000000000".$angka; else
		if ($angka<10000) return "0000000000".$angka; else
		if ($angka<100000) return "000000000".$angka; else
		if ($angka<1000000) return "00000000".$angka; else
		if ($angka<10000000) return "0000000".$angka; else
		if ($angka<100000000) return "000000".$angka; else
		if ($angka<1000000000) return "00000".$angka; else
		if ($angka<10000000000) return "0000".$angka; else
		if ($angka<100000000000) return "000".$angka; else
		if ($angka<1000000000000) return "00".$angka; else
		if ($angka<10000000000000) return "0".$angka; else
		return $angka;
	}
}
?>