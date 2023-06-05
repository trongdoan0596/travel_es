<?php
namespace app\widgets\slidebg\slidehome;
use yii\base\Widget;
//use common\models\Tour;
class Slidehome extends Widget{
	public $message;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows = array(0=>'agencia-de-viajes-vietnam-mujeres.jpg',1=>'agencia-de-viajes-vietnam-bagan-myanmar.jpg',2=>'agencia-de-viajes-vietnam-bahia-halong.jpg',3=>'agencia-de-viajes-vietnam-camboya-angkor.jpg',4=>'agencia-de-viajes-vietnam-vientian-laos.jpg');
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>