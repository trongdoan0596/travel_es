<?php
namespace app\widgets\question;
use yii\base\Widget;
use common\models\QuestionForm;
class Question extends Widget{
	public $message;	
    public $view   = 'index';
    public $cat_id = '0';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $model = new QuestionForm();
       $params['model'] = $model;
       $params['cat_id'] = $this->cat_id;
       return $this->render($this->view,$params);
	}
}
?>