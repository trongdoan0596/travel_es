<?php
namespace app\widgets\socialshare;
use yii\base\Widget;
class Socialshare extends Widget{
	public $view  = 'index';
    public $url   = '';
    public $clss  = 'uk-text-right';
	public function init(){
		parent::init();	
	}	
	public function run(){       
       $params['url']  = $this->url;
       $params['clss'] = $this->clss;
       return $this->render($this->view,$params);
	}
}
?>