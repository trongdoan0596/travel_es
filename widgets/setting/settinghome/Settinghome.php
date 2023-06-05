<?php
namespace app\widgets\setting\settinghome;
use yii\base\Widget;
use common\models\Settings;
class Settinghome extends Widget{	
    public $view   = 'index'; 
    public $total = '0'; 
	public function init(){
		parent::init();	
	}	
	public function run(){	  
       $params['row']   = Settings::getDetail(1);
       $params['total'] = $this->total;
       return $this->render($this->view,$params);
	}
}
?>