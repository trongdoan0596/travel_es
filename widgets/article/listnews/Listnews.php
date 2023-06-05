<?php
class Listnews extends CWidget {
    public $view   = 'index';
	public $title  = 'Listnews';
  //  public $category_id = 0;//set danh muc hien thi 
   // public $limit  = 2;
   // public $tid    = 0;    
    public function init() {
        parent::init();
    }
    public function run() {
	    $params = array(); $rows=array(); 
        $Criteria = new CDbCriteria();
        $Criteria->condition = "status = 1 AND is_featured = 0 ";        
   	    //$Criteria->limit = 10;					
		$Criteria->order = "time_modify DESC";
		$Criteria->select = "*";
        $count  = Article::model()->count($Criteria);
        $pages  = new CPagination($count);
        // results per page
        $pages->pageSize=10;
        //$pages->params();
        $pages->applyLimit($Criteria);
        $rows = Article::model()->findAll($Criteria);
        $params['rows'] = $rows;
        $params['pages'] = $pages;
        $this->render($this->view,$params);
    }
}
?>