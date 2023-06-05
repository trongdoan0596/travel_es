<?php
namespace app\widgets\tour\home;
use yii\base\Widget;
use common\models\Tour;
class Home extends Widget{
	public $message;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows = Tour::ListAllTour(0,3);
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>