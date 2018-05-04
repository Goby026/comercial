<?php 
/**
* 
*/
namespace appComercial\Custom;

class MyClass
{
	
	public function __construct(){

    }

	public function pk_generator($iniciales){
        $pk = "";
        $hoy = getdate();
        $pk .= $iniciales."_".$hoy['mday']."_".$hoy['mon']."_".$hoy['year'];
        // print_r($hoy);

        $rand = range(1, 13);
        shuffle($rand);
        foreach ($rand as $val) {
            $pk .= $val;
        }

        return $pk;
    }
}