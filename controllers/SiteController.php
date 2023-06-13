<?php
namespace app\controllers;
use Yii;
//use yii\base\InvalidParamException;
//use yii\web\BadRequestHttpException;
use yii\web\Cookie; 
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
//use common\components\languageSwitcher;
use common\models\ContactForm;   
use common\models\Booktour;
/**
 * Site controller
*/
class SiteController extends Controller {
   public $layout='main';
   public $enableCsrfValidation = false;
   public function Init() {
            $cookies = Yii::$app->response->cookies;
            $lang = Yii::$app->request->get('language',''); 
            if($lang){
                if(isset(Yii::$app->params['languages'][$lang])){
                    Yii::$app->language = $lang;
                    $cookies->add(new \yii\web\Cookie(array('name'  => 'language','value' => $lang)));
                }
            }elseif($cookies->has('language')){
                Yii::$app->language = $cookies->getValue('language');
            }
   }
   public function actions()  {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
             'captcha' => array(
                 'class' => 'yii\captcha\CaptchaAction',
                // 'class' => 'common\components\MathCaptchaAction',
                // 'fixedVerifyCode' => YII_ENV_TEST ? '42' : null,
                 'minLength'=>5,
                 'maxLength'=>8,
                 'foreColor'=>0x833921,
                 'padding'=>2,
                // 'width'=>'380',
                 'height'=>'50',
                 //'backColor'=>0xFFFFFF,
                'testLimit'=>'1',
                'offset'=>'-2'
            ),
        );
    }
    public function beforeAction($action){
        if(in_array($action->id, ['error'])) {            
            Yii::$app->response->redirect(['404.html']);
            Yii::$app->end();
        }        
        return parent::beforeAction($action);
    }
    public function actionIndex(){ 
        $baseurl = Url::base(true);//https://authentiktravel.es/';
        $title   = 'Viajes en privado con agencia local en Vietnam';
        $this->view->title = $title; 
        $this->view->registerMetaTag(array('name'=>'keywords','content'=>'Tours en privado Vietnam, Agencia de viaje, tours Vietnam, Tour Vietnam, tours en privado Myanmar, Agencia de viaje Myanmar, Tours Myanmar,Tour Myanmar.'));  
        $metadesc='Una agencia local de viaje, especializada en paquete turístico a medida en privado a Vietnam, Laos, Camboya & Myanmar para Pareja, Familia y grupo de amigos.';                    
        $this->view->registerMetaTag(array('name'=>'description','content'=>$metadesc));  
        $this->view->registerMetaTag(array('name'=>'title','content'=>$title));        
        $i    = rand (1, 3);
        switch ($i) {
            case 1:
                $name =  'vietnam-travel-agency-halong-bay.jpg';
                break;
            case 2:
                $name =  'vietnam-travel-agency-local-women.jpg';
                break;
            case 3:
                $name =  'vietnam-travel-agency-angkor-cambodia.jpg';
                break;
        }
        $img     = '/themes/web/img/silde/'.$name;
        $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));    
        $this->view->registerMetaTag(array('property'=>'og:url','content'=>$baseurl));
        $this->view->registerMetaTag(array('property'=>'og:type','content'=>'website'));                                            
        $this->view->registerMetaTag(array('property'=>'og:title','content'=>$title));                               
        $this->view->registerMetaTag(array('property'=>'og:description','content'=>$metadesc));                                                                      
        return $this->render('index');
    }
    public function actionContactus() {
        $model = new ContactForm();
        $post  = Yii::$app->request->post();

        $this->view->title = Yii::t('app', 'Contactar con Authentik Travel');
	    if($model->load($post)) {  
            $model->attributes  = $post['ContactForm'];
            $mess    = $model->mess;  
            $nummess = []; 
            if($mess!=''){
              $nummess = explode(" ",$mess);
            } 
           
            $booktour = new Booktour();
            if(strpos($model->mess,'http://')!== false || strpos($model->mess,'https://')!== false ){
                //spam , thong tin khong hop le
                $msg = Yii::t('app', 'Error!');         
                return $this->render('msg',array('msg'=>$msg,'model'=>$model,'booktour'=>$booktour));  
            }elseif(count($nummess)<=3){
                $msg = Yii::t('app', 'Error!');         
                return $this->render('msg',array('msg'=>$msg,'model'=>$model,'booktour'=>$booktour));  
            }else{  
                $booktour->title  = Yii::t('app', 'Request from contact tour on Authentik Travel');
                $requesttxt = '<br />'.Yii::t('app', 'Contactar con nosotros');   
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Género').':</b>'.$model->slcgender; 
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Nombre completo').':</b>'.$model->title; 
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Tu nacionalidad').':</b>'.$model->nationality; 
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Tu número de teléfono').':</b>'.$model->phone; 
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Email').':</b>'.$model->email;             
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Cuenta de Skype').':</b>'.$model->skype; 
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Tu Whatsapp').':</b>'.$model->whatsapp; 
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Tu viber').':</b>'.$model->viber;  
                $requesttxt .= '<br /><b>'.Yii::t('app', '¿Qué manera de comunicación prefieres ?').':</b>';            
                if($model->contact1 !=''){
                    $requesttxt .=  $model->getContact($model->contact1).' ,';
                }
                if($model->contact2 !=''){
                    $requesttxt .=  $model->getContact($model->contact2).' ,';
                 }
                if($model->contact3 !=''){
                   $requesttxt .=  $model->getContact($model->contact3);
                } 
                if($model->contact4 !=''){
                   $requesttxt .=  $model->getContact($model->contact4);
                } 
                if($model->contact5 !=''){
                   $requesttxt .=  $model->getContact($model->contact5);
                }    
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Tu disponibilidad para conversar con nosostros via Skype/teléfono').':</b>'.$model->contacttxt; 
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Sujeto').':</b>'.$model->subject; 
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Tu mensaje').':</b>'.$model->mess; 
                $booktour->requesttxt  = $requesttxt;
                $booktour->type        = 1;//kieu la tour
                $booktour->source      = 5;//nguon tu web chinh
                $remoteip = ''; 
                if (getenv('HTTP_CLIENT_IP')){
                    $remoteip = 'CLIENT_IP-'.getenv('HTTP_CLIENT_IP');
                }else if(getenv('HTTP_X_FORWARDED_FOR')){
                    $remoteip = 'PROXY-'.getenv('HTTP_X_FORWARDED_FOR');
                }else if(getenv('HTTP_X_FORWARDED')){
                    $remoteip = getenv('HTTP_X_FORWARDED');
                }else if(getenv('HTTP_FORWARDED_FOR')){
                    $remoteip = getenv('HTTP_FORWARDED_FOR');
                }else if(getenv('HTTP_FORWARDED')){
                   $remoteip = getenv('HTTP_FORWARDED');
                }else if(getenv('REMOTE_ADDR')){
                    $remoteip = 'REMOTE_ADDR-'.getenv('REMOTE_ADDR');
                }else{
                    $ip = 'UNKNOWN';  
                }            
                $booktour->remoteip = $remoteip;                
                $booktour->ip          = Yii::$app->getRequest()->getUserIP();
                $booktour->create_date = date("Y-m-d H:i:s");
                $booktour->last_update = date("Y-m-d H:i:s");
                $detect = Yii::$app->mobileDetect;
                $booktour->is_mobile = 0;//la web
                $msg2 = Yii::t('app', '<br /><br /><div class="uk-text-warning">NOTA: En el caso de no recibir nuestra contesta dentro de 24hrs, por favor chequea el archivo de spam/papelera de tu email.<br /> Para tener más información, por favor mándanos un email a: es@authentiktravel.com o envíanos/llámanos a: +84 96 9 72 99 83.</div>');
                if($detect->isMobile()){
                     $booktour->is_mobile = 1;//la mobi
                     $msg2 = Yii::t('app', '<br /><br /><div class="uk-text-warning">NOTA: En el caso de no recibir nuestra contesta dentro de 24hrs,<br /> por favor chequea el archivo de spam/papelera de tu email.<br /> Para tener más información, por favor mándanos un email a:<br /> <a href="mailto:es@authentiktravel.com">es@authentiktravel.com</a> <br /> o envíanos/llámanos a: <br />+84 96 9 72 99 83.</div>');
                }
                if($detect->isTablet()){
                     $booktour->is_mobile = 2;//la Tablet
                }
                if ($booktour->save(false)) {
                    $model->SendEmail($model,1);
                    $model->SendEmailConfirm($model,0);   
                    $msg1 = Yii::t('app', 'Muchas gracias por mandar tu petición a Authentik Travel! <br />Nuestro equipo te responderá dentro de 12 – 24 hrs.');
                    $msg = $msg1.$msg2;

                    //chatbot telegram
                    $token = '5979049888:AAH3moIXs-ahuYbg_CN27Pwp5Z5ORQBuOgs';
                    $link = 'https://api.telegram.org:443/bot'.$token.'';
                     
                    $getupdate = file_get_contents($link.'/getUpdates');
                    $responsearray = json_decode($getupdate, TRUE);
               
                    $chatid = $responsearray['result'][0]['my_chat_member']['chat']['id'];
                    $message = '
                    Contact:
                    Giới tính: '. $post['ContactForm']['slcgender'] .'
                    Họ và tên: '. $post['ContactForm']['title'] .'
                    Quốc tịch: '.  $post['ContactForm']['nationality'] .'
                    Số điện thoại: '.  $post['ContactForm']['phone'] .'
                    Email: '.  $post['ContactForm']['email'] .'
                    Skype: '.  $post['ContactForm']['skype'] .'
                    Whatsapp: '.  $post['ContactForm']['whatsapp'] .'
                    Viber: '.  $post['ContactForm']['viber'] .'
                    Nội dung: '.  $post['ContactForm']['mess'] .'
                    ';
                    $parameter = array(
                            'chat_id' => '-1001717408228',//$chatid, 
                            'text' => $message
                            );
                    $request_url = $link.'/sendMessage?'.http_build_query($parameter); 
                    file_get_contents($request_url);
                    //end chatbot telegram

                    return $this->render('msg',array('msg'=>$msg,'model'=>$model,'booktour'=>$booktour)); 
                }
            }    
                
        }             
        return $this->render('contactus');
    }   
    public function actionTestmail() {
       echo  Yii::$app->mailer
            ->compose(array('html' =>'testmail'))
            ->setFrom(array('sm@authentiktravel.com'))
            ->setTo('donggv@gmail.com')
            ->setSubject('Test email authentiktravel.com')
            ->send();
       die('test');
    } 
    public function actionError() {
        return $this->render('error');
    }  

}
