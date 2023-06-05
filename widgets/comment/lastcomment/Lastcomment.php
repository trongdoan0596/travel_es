<?php
namespace app\widgets\comment\lastcomment;
use yii\base\Widget;
use common\models\Comment;
class Lastcomment extends Widget{
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){  	  
       $params['rows'] = Comment::GetLastComment('blog',5,'id desc','user_id,title,message,ext_id,create_date');       
       return $this->render($this->view,$params);
	}
}
?>