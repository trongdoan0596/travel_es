<?php
namespace app\widgets\blog\ortherblog;
use yii\base\Widget;
use common\models\Blog;
class Ortherblog extends Widget{	
    public $view   = 'index';
    public $catblog_id = '0'; 
    public $blog_id = '0';   
    public $limit  = 6;    
	public function init(){
		parent::init();	
	}	
	public function run(){         
       $rows =Blog::getLastBlog($this->catblog_id,$this->blog_id,$this->limit,'id desc');
       $params['rows'] = $rows;
       //$params['blog_id'] = $this->blog_id;
       return $this->render($this->view,$params);
	}
}
?>