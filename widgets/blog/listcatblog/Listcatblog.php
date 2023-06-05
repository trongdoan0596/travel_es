<?php
namespace app\widgets\blog\listcatblog;
use yii\base\Widget;
use common\models\Blogcate;
class Listcatblog extends Widget{
    public $view   = 'index';
    public $limit  = 5;
    public $cat_id = 1;
	public function init(){
		parent::init();	
	}	
	public function run(){	   
       $rows = Blogcate::getAllBlogcate($this->cat_id,'ordering asc');       
       $params['rows']  = $rows;      
       return $this->render($this->view,$params);
	}
}
?>