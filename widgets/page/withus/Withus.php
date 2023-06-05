<?php
namespace app\widgets\page\withus;
use yii\base\Widget;
//use yii\helpers\Html;
use common\models\Article;
use common\models\Category;
class Withus extends Widget{
	public $message;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){          
        $params['rows']     = Article::getLastArticle(37,5,'id asc');      
        $params['infocate'] = Category::getDetailCategory(37);
       return $this->render($this->view,$params);
	}
}
?>