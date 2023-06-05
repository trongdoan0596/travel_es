<?php
namespace app\widgets\video\lastvideo;
use common\models\Video;
use yii\base\Widget;
class Lastvideo extends Widget{
	public $view  = 'index';
    public $url   = '';
    public $clss  = 'uk-text-right';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $params['url']  = $this->url;
       $params['clss'] = $this->clss;
       $params['rows'] = Video::getListVideo(5,'id desc','id,title,img,url,embedcode');
       return $this->render($this->view,$params);
	}
}
?>