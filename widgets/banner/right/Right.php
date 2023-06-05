<?php
namespace app\widgets\banner\right;
use yii\base\Widget;
use common\models\Banner;
class Right extends Widget{
	public $message;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows = Banner::getBanner(Banner::BANNER_TYPE_NORMAL);
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>