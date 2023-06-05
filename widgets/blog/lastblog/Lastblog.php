<?php
namespace app\widgets\blog\lastblog;
use yii\base\Widget;
use common\models\Blog;
class Lastblog extends Widget{
	public $message;	
    public $view   = 'index';
    public $model  = '';
    public $catblog_id = 'catblog_id';
    public $limit  = 3;
	public function init(){
		parent::init();	
	}	
	public function run(){
	   $id = 0;
	   if(!empty($this->model)) $id = $this->model->id;
       $rows = Blog::getLastBlog($this->catblog_id,$id,$this->limit,'id desc');       
       $params['rows']  = $rows;
       $params['model'] = $this->model;
       return $this->render($this->view,$params);
	}
}
?>