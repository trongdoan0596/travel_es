<?php
namespace app\widgets\banner\slideshow;
use yii\base\Widget;
use common\models\Banner;
class Slideshow extends Widget{
	public $message;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows = Banner::getBanner(Banner::BANNER_TYPE_SLIDE);
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>