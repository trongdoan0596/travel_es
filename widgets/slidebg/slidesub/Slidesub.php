<?php
namespace app\widgets\slidebg\slidesub;
use yii\base\Widget;
class Slidesub extends Widget{
	public $message;	
    public $view   = 'index';
    public $class_ex  = '';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows = array();
       $params['rows'] = $rows;
       $params['class_ex'] = $this->class_ex;
       return $this->render($this->view,$params);
	}
}
?>