<?php
namespace app\widgets\setting\settingdefault;
use yii\base\Widget;
class Settingdefault extends Widget{	
    public $view   = 'index';     
	public function init(){
		parent::init();	
	}	
	public function run(){	  
       $params['row'] = array();
       return $this->render($this->view,$params);
	}
}
?>