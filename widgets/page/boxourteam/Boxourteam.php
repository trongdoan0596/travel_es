<?php
namespace app\widgets\page\boxourteam;
use yii\base\Widget;
use common\models\Ourteam;
class Boxourteam extends Widget{
	public $message;	
    public $view   = 'index';
    public $country_id = 232;
    public $limit = 12;
	public function init(){
		parent::init();	
	}	
	public function run(){
	   $model = new Ourteam();
       $rows  =  $model->getListOurteam($this->country_id,$this->limit);
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>