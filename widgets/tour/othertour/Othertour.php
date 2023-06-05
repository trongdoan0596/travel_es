<?php
namespace app\widgets\tour\Othertour;
use yii\base\Widget;
use common\models\Tour;
class Othertour extends Widget{
	public $message;	
    public $view       = 'index';
    public $tour_id    = 0;
    public $cat_id = 0;
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows = Tour::ListOtherTour($this->cat_id,$this->tour_id);
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>