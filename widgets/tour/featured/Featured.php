<?php
namespace app\widgets\tour\featured;
use yii\base\Widget;
use common\models\Tour;
use common\models\Article;
class Featured extends Widget{
	public $message;	
    public $view   = 'index';
    public $lang   = 'en';
	public function init(){
		parent::init();	
	}	
	public function run(){
	   $info = Article::getDetailArticle(189);
       $rows = Tour::ListAllFeatureTour(0,5,'ordering asc','shorttxt,title,alias,id,num_day,img,img1,img2,img3');
       $params['info'] = $info;
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>