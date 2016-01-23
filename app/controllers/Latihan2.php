<?php
namespace controllers;
class Latihan2 {
	function hallo($f3) {
		$nama = $f3->get('asoy');
		echo "hallo coy ";
		echo "$nama";
	}
	function kata($f3,$args) {
		 //echo "Hai, mengatakan ".$f3->get('PARAMS.kata');
		//echo "Asoy, mengatakan ".$args['kata'];
		echo "<pre>";
		print_r($f3);
		print_r(get_declared_classes());
		
		$cek = new \controllers\latihan;
		$cek->hallo("asoy");
	}
	function katakan($f3) {
		echo "Hai". $f3->get('IP') .", mengatakan ".$f3->get('PARAMS.kata');
	}
}