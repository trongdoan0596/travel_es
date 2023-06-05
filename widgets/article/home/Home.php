<?php
namespace app\widgets\article\home;
//use yii\db\Query;
//$connection = \Yii::$app->db;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Article;
class Home extends Widget{
	public $message;	
    public $view   = 'index';
    public $limit  = 3;
    public $cat_id = 0;
	public function init(){
		parent::init();
	}	
	public function run(){
       $rows = Article::getLastArticle($this->cat_id,$this->limit);
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>