<?php
namespace app\widgets\traveller\travellerreview;
use yii\base\Widget;
use common\models\Review;
use common\models\Itemimg;
class Travellerreview extends Widget{
	public $message;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){
	   $table = Review::tableName();
       $rows  = Review::getLastReview(9,'last_update desc',$table.'.id,'.$table.'.title,'.$table.'.user_id,'.$table.'.introtxt,'.$table.'.last_update,'.$table.'.vote');
       $imgdefault = Itemimg::getAllImageDefault(9,'id asc','img,title');      
       $total = Review::getTotalReview();
       $params['rows'] = $rows;
       $params['imgdefault'] = $imgdefault;
       $params['total'] = $total;
       return $this->render($this->view,$params);
	}
}
?>