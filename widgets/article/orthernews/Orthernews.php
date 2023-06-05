<?php
class Orthernews extends CWidget {
    public $view   = 'orthernews';
	public $title  = 'Orthernews';
    public $limit  = 10;
    public $catid  = 0;//id cua danh muc
    public $aid    = 0;//id cua bai viet    
    public function init() {
        parent::init();
    }
    public function run() {
	    $params = array();
        $rows=array();
        if($this->aid){
             $Criteria = new CDbCriteria();
             //$Criteria->condition = "status = 1 AND id <> '".$this->aid; 
             $Criteria->compare("status",1);            
             if($this->catid){
                $Criteria->compare("category_id",$this->catid);
             } 
             //$Criteria->compare("id",$this->aid);  
             $Criteria->addCondition('id <>'.$this->aid);
       	     $Criteria->limit = $this->limit;					
    	 	 $Criteria->order = "time_modify DESC";
    		 $Criteria->select = "*";
             $rows = Article::model()->findAll($Criteria);
             $params['rows'] = $rows;
        }
        $this->render($this->view,$params);
    }
}
?>