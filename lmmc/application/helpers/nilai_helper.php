<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

if( ! function_exists('angka_to_huruf')){
function angka_to_huruf($angka)
	{
		
		if ($angka==NULL) {
			$nilai='';
			return $nilai;
		} else {
			if ($angka==4) $nilai='A'; else
			if ($angka==3.5) $nilai='B+'; else
			if ($angka==3) $nilai='B'; else
			if ($angka==2.5) $nilai='C+'; else
			if ($angka==2) $nilai='C'; else
			if ($angka==1.5) $nilai='D+'; else
			if ($angka==1) $nilai='D'; else
			if ($angka==0) $nilai='E';
		return $nilai;
		}
	}
}
if( ! function_exists('khs_max_depan')){
function sks_max_depan($angka)
	{
		$angka1=(float)$angka;
		
		if ($angka1==NULL) {
			$nilai='';
			return $nilai;
		} else {
			if ($angka1>=3) $nilai='24'; else
			if ($angka1>=2.5) $nilai='22'; else
			if ($angka1>=2) $nilai='20'; else
			if ($angka1>=1.5) $nilai='18'; else
			if ($angka1>=1) $nilai='16'; else
			$nilai='14';
			
		return $nilai;
		}
	}
}

if( ! function_exists('predikat_lulus')){
function predikat_lulus($angka)
	{
		
		if ($angka==NULL) {
			$nilai='';
			return $nilai;
		} else {
			if ($angka>=3.75) $nilai='Cum Laude'; else
			if ($angka>=3.51) $nilai='Sangat Memuaskan'; else
			if ($angka>=2.76) $nilai='Memuaskan'; else
			if ($angka>=2) $nilai='Cukup'; else
			if ($angka>=0) $nilai='Tidak Lulus'; else
			$nilai='14';
			
		return $nilai;
		}
	}
}

if( ! function_exists('hitung_ipk')){
function hitung_ipk($bobot,$sks)
	{
		return ($bobot > 0  ? $bobot/$sks:0);
	}
}

if( ! function_exists('format_ipk')){
function format_ipk($ipk)
	{
		return number_format($ipk,2);
	}
}

if( ! function_exists('cek_lulus_mk')){
function cek_lulus_mk($nilai,$min)
	{
		if ($nilai==0) return 0; else
		if ($nilai>=$min) return 1; else //jika lulus
		return 0; //jika tidak
	}
}
?>