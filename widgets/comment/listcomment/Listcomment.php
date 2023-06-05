<?php
namespace app\widgets\comment\listcomment;
use yii\base\Widget;
use common\models\Comment;
class Listcomment extends Widget{
	public $type   = '';//tour or article,blog
    public $ext_id = 0;	
    public $comment_id     = 0;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){  
	   $table = Comment::tableName();
       $params['rows'] = Comment::GetComment($this->type,$this->ext_id,'ordering asc',$table.'.title,'.$table.'.message,'.$table.'.comment_id,'.$table.'.user_id,'.$table.'.create_date');
       $params['ext_id'] =$this->ext_id;
       $params['comment_id'] =$this->comment_id;
       $params['table'] =$table;
       return $this->render($this->view,$params);
	}
}
?>