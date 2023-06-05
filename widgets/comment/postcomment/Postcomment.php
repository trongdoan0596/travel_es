<?php
namespace app\widgets\comment\postcomment;
use yii\base\Widget;
use common\models\Comment;
class Postcomment extends Widget{
	public $type   = '';//tour or article,blog
    public $id     = 0;	
    public $comment_id     = 0;	
    public $ext_id = 0;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $params['id']         = $this->id;
       $params['ext_id']     = $this->ext_id;  
       $params['comment_id'] = $this->comment_id;
       $params['type']       = $this->type;
       return $this->render($this->view,$params);
	}
}
?>