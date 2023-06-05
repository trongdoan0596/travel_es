<?php
class Lastnews extends CWidget {
    public $view   = 'lastnews';
	public $title  = 'Lastnews';
    public $category_id = 0;//set danh muc hien thi 
    public $limit  = 2;
    public $tid    = 0;    
    public function init() {
        parent::init();
    }
    public function run() {
	    $params = array(); $rows=array(); 
        $Criteria = new CDbCriteria();
        $Criteria->condition = "status = 1";        
   	    $Criteria->limit = $this->limit;					
		$Criteria->order = "time_modify DESC";
		$Criteria->select = "*";
        $rows = Article::model()->findAll($Criteria);
        $params['rows'] = $rows;
        $this->render($this->view,$params);
    }
}
?>