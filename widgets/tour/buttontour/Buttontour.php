<?php
namespace app\widgets\tour\Buttontour;
use yii\base\Widget;
//use common\models\Tour;
class Buttontour extends Widget{
	public $message;	
    public $view       = 'index';
    public $tour_id    = 0;
    public $cat_id = 0;
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows = array();
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>