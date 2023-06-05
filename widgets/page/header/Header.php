<?php
namespace app\widgets\page\header;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Menu;
class Header extends Widget{
	public $message;	
    public $view   = 'index';
    public $lang   = 'en';
	public function init(){
		parent::init();	
	}	
	public function run(){	       
       $rows     = array();      
       if($this->view =='blog' || $this->view =='mobiblog'){        
         $rows   = Menu::getMenu(Menu::MENU_BLOG);
       }else{
         $rows   = Menu::getMenu(Menu::MENU_TOP);
       }
       $params['rows']     = $rows;
       return $this->render($this->view,$params);
	}
}
?>