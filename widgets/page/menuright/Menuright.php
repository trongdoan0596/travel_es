<?php
namespace app\widgets\page\menuright;
use yii\base\Widget;
//use yii\helpers\Html;
use common\models\Menu;
class Menuright extends Widget{
	public $message;	
    public $view   = 'index';
	public function init(){
		parent::init();	
	}	
	public function run(){
       //$rows  = Menu::getMenu(Menu::MENU_RIGHR);
       $rows     = Menu::getMenu(Menu::MENU_TOP);
       $params['rows'] = $rows;
       return $this->render($this->view,$params);
	}
}
?>