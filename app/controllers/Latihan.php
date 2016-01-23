<?php
namespace controllers;
class Latihan {
	function hallo($f3) {
		//$nama = $f3->get('asoy');
		echo "hallo coy ";
		//echo "$nama";
	}
	function kata($f3,$args) {
		 //echo "Hai, mengatakan ".$f3->get('PARAMS.kata');
		//echo "Asoy, mengatakan ".$args['kata'];
		echo "<pre>";
		print_r($f3);
		print_r(get_declared_classes());
	}
	function katakan($f3) {
		echo "Hai". $f3->get('IP') .", mengatakan ".$f3->get('PARAMS.kata');
	}
        
        function get_layanan(){
            $id = 1;
            $layanan = new \models\LayananM();
            $list = $layanan->get_data($id);
            print_r($list);
        }
}