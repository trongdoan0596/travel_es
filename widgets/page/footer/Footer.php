<?php
namespace app\widgets\page\footer;
use Yii;
use yii\base\Widget;
//use yii\helpers\Html;
use common\models\Menu;
//use common\models\Logip;
class Footer extends Widget{
	public $message;	
    public $view   = 'index';
    public $lang   = 'en';
	public function init(){
		parent::init();	
	}	
	public function run(){
       $rows  = Menu::getMenu(Menu::MENU_FOOTER);
       $params['rows'] = $rows; 
       $ip = '';     
      /* $ip = 'REMOTE_ADDR:'.$_SERVER['REMOTE_ADDR'];          
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //check ip from share internet
            $ip = 'CLIENT_IP:'.$_SERVER['HTTP_CLIENT_IP'];
        }else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //to check ip is pass from proxy
            $ip = 'PROXY-'.$_SERVER['HTTP_X_FORWARDED_FOR'];
        }  */  
       /*if (getenv('HTTP_CLIENT_IP')){
                $ip = 'CLIENT_IP-'.getenv('HTTP_CLIENT_IP');
            }else if(getenv('HTTP_X_FORWARDED_FOR')){
                $ip = 'PROXY-'.getenv('HTTP_X_FORWARDED_FOR');
            }else if(getenv('HTTP_X_FORWARDED')){
                $ip = getenv('HTTP_X_FORWARDED');
            }else if(getenv('HTTP_FORWARDED_FOR')){
                $ip = getenv('HTTP_FORWARDED_FOR');
            }else if(getenv('HTTP_FORWARDED')){
               $ip = getenv('HTTP_FORWARDED');
            }else if(getenv('REMOTE_ADDR')){
                $ip = 'REMOTE_ADDR-'.getenv('REMOTE_ADDR');
            }else{
                $ip = 'UNKNOWN';  
            }               
       $model = new Logip();      
       $model->created_at = date("Y-m-d H:i:s");
       $model->ip = Yii::$app->getRequest()->getUserIP();
       $model->remoteip = $ip;//Yii::$app->getRequest()->getRemoteIP();
       $model->user_agent = Yii::$app->request->userAgent;
       $model->save();*/         
       return $this->render($this->view,$params);
	}
}
?>