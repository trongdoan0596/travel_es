<?php
namespace app\widgets\blog\recentblog;
use yii\base\Widget;
use common\models\Article;
use common\models\Blog;
class Recentblog extends Widget{
	public $message;	
    public $view   = 'index';
    public $catblog_id = 'catblog_id';
    public $article_id = 193;
    public $limit  = 8;
    
	public function init(){
		parent::init();	
	}	
	public function run(){
	   $blog = new Blog();
       $rows = $blog->getListBlog($this->catblog_id,$this->limit,'last_update desc','id,title,alias,img,create_date,last_update');
       $article = new Article();
       $info = $article->getDetailArticle($this->article_id);
       $params['info'] = $info;
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>