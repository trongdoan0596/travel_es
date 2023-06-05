<?php
namespace app\widgets\tour\Extention;
use yii\base\Widget;
use common\models\Tourextentions;
class Extention extends Widget{
	public $message;	
    public $view    = 'index';
    public $tour_id = 0;
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows = Tourextentions::GetTourExt($this->tour_id);
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>