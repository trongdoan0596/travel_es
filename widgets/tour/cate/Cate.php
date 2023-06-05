<?php
namespace app\widgets\tour\cate;
use yii\base\Widget;
use common\models\Menu;
class Cate extends Widget{
	public $message;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows = Tour::ListAllTour(0,4);
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>