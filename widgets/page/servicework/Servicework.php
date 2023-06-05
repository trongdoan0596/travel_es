<?php
namespace app\widgets\page\servicework;
use yii\base\Widget;
//use yii\helpers\Html;
//use common\models\Menu;
use common\models\Article;
use common\models\Category;
class Servicework extends Widget{
	public $message;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){      
       $params['rows']     = Article::getLastArticle(38,7,'id asc');      
       $params['infocate'] = Category::getDetailCategory(38);
       return $this->render($this->view,$params);
	}
}
?>