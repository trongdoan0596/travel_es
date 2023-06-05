<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use common\models\Tour;
use common\models\Tourcate;
use common\models\Tourdetail;
use common\models\Tourextentions;
use common\models\Article;
use common\models\Region;
use common\models\CustomizeForm;
use common\models\Booktour;
use common\models\RequestpriceForm;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\base\InvalidParamException;
//use yii\web\BadRequestHttpException;
/**
 * Tour controller
 */
 class TourController extends Controller {
    public $layout='main';    
    public $enableCsrfValidation = false;
    public function actions()  {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
        );
    }
    public function actionAlltour() {       
        $country_id  = Yii::$app->request->get('country_id',0);
        $cat_id      = Yii::$app->request->get('cat_id',0);
        $start_id    = Yii::$app->request->get('start_id',0);
        $numberday   = Yii::$app->request->get('numberday',0);
        $lang        = Yii::$app->language;           
        $query  = Tour::find();        
        $query->andWhere("status =:status",array(":status" =>1));
        if($country_id>0){
            $query->andWhere("find_in_set(".$country_id.",country_ids)");
        }
        if($cat_id>0){
            $query->andWhere("cat_id =:cat_id",array(":cat_id" =>$cat_id));
        }
        if($start_id>0){
            $query->andWhere("start =:start",array(":start" =>$start_id));
        }    
        if($numberday>0){
            $query->andWhere("num_day =:num_day",array(":num_day" =>$numberday));
        }
        $count  = clone $query;
        $pages  = new Pagination(array('totalCount' => $count->count(),'pageSize'=>9));
        $rows   = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->orderBy('num_day asc')
                        ->all();  
        $tourcate = array();   
        $info    = Article::getDetailArticle(191);    
        if(!empty($info)){
            $baseurl = Url::base(true);//'https://authentiktravel.es';
            $this->view->title = $info->title; 
            if($info->metatitle!=''){
                $this->view->title = $info->metatitle; 
            }else{
                $this->view->title = $info->title; 
            }            
            $this->view->registerMetaTag(array('name'=>'description','content'=>$info->metadesc));
            $this->view->registerMetaTag(array('name'=>'keywords','content'=>$info->metakey));
            if($info->img!=''){
                $img = Article::getImage($info);
                $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));      
            }
        }               
        return $this->render('alltour',array(
                'rows' =>$rows,
                'pages' =>$pages,
                'info' =>$info,
                'country_id' =>$country_id,
                'cat_id' =>$cat_id,
                'start_id' =>$start_id                 
               ));
    }
    public function actionIndex() {
        $tourcate=array();$catid = 0;
       // $catid  = Yii::$app->request->get('catid',0);
       // if($catid==0){         
           $alias   = Yii::$app->request->get('title','');          
           if($alias=='') $alias = Yii::$app->request->pathInfo;                   
           $tourcate = Tourcate::getDetailAlias($alias);
           //die('aaaa');        
           if(!empty($tourcate)){
              $catid = $tourcate->id;             
           } 
         //  echo 'AAA:'.$alias;
        //}else{
        //   $tourcate = Tourcate::getDetailTourCate($catid); 
      //  }
        $startfrom  = Yii::$app->request->get('startfrom',0);            
        $query  = Tour::find();
        $query->andWhere("status =:status",array(":status" =>1)); 
        if($catid>0){
            Tourcate::getAllIds($arr,$catid);
            if(!empty($arr)){                          
                $strids = $catid.','.implode(",",$arr);
                $query->andWhere('cat_id IN('.$strids.')');
            }else{
                $query->andWhere("cat_id =:cat_id",array(":cat_id" =>$catid));  
            }
        }
        if($startfrom>0){
            $query->andWhere("start =:start",array(":start" =>$startfrom));
        }
        $count  = clone $query;
        $pages  = new Pagination(array('totalCount' => $count->count(),'pageSize'=>9));
        $rows   = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->orderBy('num_day asc')
                        ->all();
       
        if($catid>0){           
            $baseurl = Url::base(true);//'https://authentiktravel.es';
            $title = '';
            if(!empty($tourcate)){
                if($tourcate->metatitle!=''){
                    $title = $tourcate->metatitle;
                }else{
                    $title = $tourcate->title;
                }
                $this->view->title = $title; 
                if($tourcate->metadesc!='') $metadesc = $tourcate->metadesc;
                  else $metadesc = $tourcate->title;
                $this->view->registerMetaTag(array('name'=>'description','content'=>$metadesc));
                if($tourcate->metakey!='') $metakey = $tourcate->metakey;
                     else $metakey = $tourcate->title;
                $this->view->registerMetaTag(array('name'=>'keywords','content'=>$metakey));   
                $url = $baseurl.$tourcate->createUrl($tourcate);                               
                $this->view->registerMetaTag(array('property'=>'og:url','content'=>$url));
                $this->view->registerMetaTag(array('property'=>'og:type','content'=>'website'));                                            
                $this->view->registerMetaTag(array('property'=>'og:title','content'=>$title));                               
                $this->view->registerMetaTag(array('property'=>'og:description','content'=>$metadesc));                        
                if($tourcate->img !=''){
                     $img = $tourcate->getImage($tourcate);
                     $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));       
               }                
            }    
        }
        return $this->render('index',array(
                'rows' =>$rows,
                'pages' =>$pages,
                'tourcate' =>$tourcate,
                'catid' =>$catid,
                'startfrom' =>$startfrom
               ));
    }
   public function actionView() { 
       $id      = Yii::$app->request->get('tid',0);       
       $model = '';
       if($id==0){    
           $alias   = Yii::$app->request->get('title',''); 
           $model   = Tour::getDetailAlias($alias);            
       }else{
           $model   = Tour::getDetailTour($id);  
       } 
       $details = $start =array();
       $url = '#';
       if(!empty($model)){
            $start   = Region::getRegionName($model->start);
            $details = Tourdetail::GetTourdetail($model->id);            
            $baseurl = Url::base(true);//'https://authentiktravel.es';
            $title = '';
            if($model->metatitle!=''){
                $title = $model->metatitle;
            }else{
                $title = $model->title;
            }
            $this->view->title = $title; 
            if($model->metadesc!='') $metadesc = $model->metadesc;
              else $metadesc = $model->title;
            $this->view->registerMetaTag(array('name'=>'description','content'=>$metadesc));
            if($model->metakey!='') $metakey = $model->metakey;
                 else $metakey = $model->title;
            $this->view->registerMetaTag(array('name'=>'keywords','content'=>$metakey));   
            $url = $baseurl.$model->createUrl($model);                               
            $this->view->registerMetaTag(array('property'=>'og:url','content'=>$url));
            $this->view->registerMetaTag(array('property'=>'og:type','content'=>'website'));                                            
            $this->view->registerMetaTag(array('property'=>'og:title','content'=>$title));                               
            $this->view->registerMetaTag(array('property'=>'og:description','content'=>$metadesc));  
            $this->view->registerMetaTag(array('property'=>'og:site_name','content'=>'Authentik vietnam'));                        
            if($model->img !=''){
                 $img = $model->getImage($model);
                 $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));       
            }  
                
       }
       return $this->render('view',array(
                'model' => $model,
                'details' => $details,
                'start' => $start,
                'urlshare'=>$url
        ));
   }
 //requestprice  
    public function actionRequestprice() { 
       $id      = Yii::$app->request->get('tid',0);
       $model   = Tour::getDetailTour($id);  
       $details = $start =array();
       if(!empty($model)){
            $start   = Region::getRegionName($model->start);
            $details = Tourdetail::GetTourdetail($model->id);
            $this->view->title = Yii::t('app', 'Tailor-made travel request ').$model->title; 
       }
       $modelform = new RequestpriceForm();
       $post      = Yii::$app->request->post();
       $msg       = '';
       if ($modelform->load($post)) {  	      
            $modelform->attributes  = $post['RequestpriceForm'];
            if(!empty($model)){
                $booktour = new Booktour();
                $booktour->title  = Yii::t('app', 'Tailor-made travel request: ').$model->title;                           
                $requesttxt="";                
                $requesttxt .= '<br /><b>'.Yii::t('app','Título del tour').'</b>'.$model->title; 
                $requesttxt .= '<br /><b>'.Yii::t('app','Tour ID').':</b>'.$model->id; 
                $requesttxt .= '<br /><b>'.Yii::t('app','Género').':</b>'.$modelform->title;    
                $requesttxt .= '<br /><b>'.Yii::t('app','Nombre').':</b>'.$modelform->name;    
                $requesttxt .= '<br /><b>'.Yii::t('app','Nacionalidad').':</b>'.$modelform->nationality;    
                $requesttxt .= '<br /><b>'.Yii::t('app','Dirección').':</b>'.$modelform->address; 
                $requesttxt .= '<br /><b>'.Yii::t('app','Teléfono ').':</b>'.$modelform->phone;
                $requesttxt .= '<br /><b>'.Yii::t('app','Email').':</b>'.$modelform->email;
                $requesttxt .= '<br /><b>'.Yii::t('app','Skype').':</b>'.$modelform->skype;
                $requesttxt .= '<br /><b>'.Yii::t('app','Tu WhatsApp').':</b>'.$modelform->whatsapp;
                $requesttxt .= '<br /><b>'.Yii::t('app','Tu Viber').':</b>'.$modelform->viber;
                $requesttxt .= '<br /><b>'.Yii::t('app','¿Qué manera de comunicación prefieres ?').':</b>';
                if($modelform->contact1 !=''){
                     $requesttxt .= '<br />'.$modelform->getContact($modelform->contact1).' ,';
                }
                if($modelform->contact2 !=''){
                    $requesttxt .= '<br />'.$modelform->getContact($modelform->contact2).' ,';
                }
                if($modelform->contact3 !=''){
                   $requesttxt .= '<br />'.$modelform->getContact($modelform->contact3).' ,';
                }
                if($modelform->contact4 !=''){
                   $requesttxt .= '<br />'.$modelform->getContact($modelform->contact4).' ,';
                } 
                if($modelform->contact5 !=''){
                   $requesttxt .= '<br />'.$modelform->getContact($modelform->contact5).' ,';
                }        
                $requesttxt .= '<br /><b>'.Yii::t('app', 'El mejor momento para teléfono o skype').':</b>'.$modelform->contacttxt;
                $requesttxt .= '<br /><b>'.Yii::t('app','Número de participantes').':</b>';
                if($modelform->adult !=''){                    
                   $requesttxt .= '<br />'.Yii::t('app','Adulto(s) y').':'.$modelform->adult;
                }
                if($modelform->children !=''){                    
                   $requesttxt .= '<br />'.Yii::t('app', 'Niños menos de 12 años').':'.$modelform->children;
                }
                if($modelform->depart !=''){                    
                   $requesttxt .= '<br /><b>'.Yii::t('app', 'Fecha de llegada').':</b> '.$modelform->depart;
                }
                if($modelform->arrivaldate_other_m !='' && $modelform->arrivaldate_other_y !=''){                    
                   $requesttxt .= '<br /><b>'.Yii::t('app', 'Si no, ¿ En qué mes prefieres ?').':</b> '.$modelform->arrivaldate_other_m.','.$modelform->arrivaldate_other_y;
                }              
                $requesttxt .= '<br /><b>'.Yii::t('app','Edad').':</b>';
                if($modelform->age1 >0){
                     $requesttxt .= '<br />'.$modelform->getAge($modelform->age1).', ';
                }
                if($modelform->age2 >0){
                    $requesttxt .= '<br />'.$modelform->getAge($modelform->age2).', ';
                }
                if($modelform->age3 >0){
                   $requesttxt .= '<br />'.$modelform->getAge($modelform->age3).', ';
                }            
                if($modelform->age4 >0){
                   $requesttxt .= '<br />'.$modelform->getAge($modelform->age4).', ';
                }
                if($modelform->age5 >0){
                   $requesttxt .= '<br />'.$modelform->getAge($modelform->age5).', ';
                }
                if($modelform->age6 >0){
                   $requesttxt .= '<br />'.$modelform->getAge($modelform->age6).', ';
                }   
                $requesttxt .= '<br /><b>'.Yii::t('app','Comidas').':</b>';
                if($modelform->meals1 >0){
                     $requesttxt .= '<br />'.$modelform->getMeals($modelform->meals1).', ';
                }
                if($modelform->meals2 >0){
                    $requesttxt .= '<br />'.$modelform->getMeals($modelform->meals2).', ';
                }
                if($modelform->meals3 >0){
                   $requesttxt .= '<br />'.$modelform->getMeals($modelform->meals3).', ';
                }  
                $requesttxt .= '<br /><b>'.Yii::t('app','Hotel').':</b>';
                if($modelform->hotel1>0){
                     $requesttxt .= '<br />'.$modelform->getHotelType($modelform->hotel1).', ';
                }
                if($modelform->hotel2 >0){
                    $requesttxt .= '<br />'.$modelform->getHotelType($modelform->hotel2).', ';
                }
                if($modelform->hotel3 >0){
                   $requesttxt .= '<br />'.$modelform->getHotelType($modelform->hotel3).', ';
                }  
                if($modelform->hotel4 >0){
                   $requesttxt .= '<br />'.$modelform->getHotelType($modelform->hotel4).', ';
                } 
                if($modelform->hotel5 >0){
                   $requesttxt .= '<br />'.$modelform->getHotelType($modelform->hotel5).', ';
                } 
                $requesttxt .= '<br /><b>'.Yii::t('app','Tu mensaje').':</b>';
                if($modelform->mess !=''){
                   $requesttxt .= '<br />'.$modelform->mess;
                }   
                $requesttxt .= '<b><br />'.Yii::t('app', '¿Cómo nos encontrabas?').':</b>';
                if($modelform->how_did_id>0){
                   $requesttxt .= '<br />-'.$modelform->getHowDidUs($modelform->how_did_id);    
                 }
                if($modelform->howdidtxt!=''){
                   $requesttxt .= '<br />-'.$modelform->howdidtxt;    
                 }       
                $requesttxt .= '<br /><b>'.Yii::t('app', 'IP').':</b>'.Yii::$app->getRequest()->getUserIP();
                $requesttxt .= '<br /><b>'.Yii::t('app', 'Fecha de crear').':</b>'.date("Y-m-d H:i:s");    
            
                $booktour->requesttxt  = $requesttxt;
                $booktour->tour_id     = $model->id;
                $booktour->cat_id      = $model->cat_id;
                $booktour->type        = 1;//kieu la tour
                $booktour->source      = 5;//nguon tu web chinh
                $booktour->ip          = Yii::$app->getRequest()->getUserIP();
                 /*	$remoteip = $_SERVER['REMOTE_ADDR'];//lay dia chi that cua user
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    //check ip from share internet
                    $remoteip = $_SERVER['HTTP_CLIENT_IP'];
                }else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    //to check ip is pass from proxy
                    $remoteip = 'PROXY-'.$_SERVER['HTTP_X_FORWARDED_FOR'];
                } */
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
                   $booktour->is_mobile = 2;//la table
                }
                if ($booktour->save(false)) {
                     //gui email cho quan tri
                    $modelform->SendEmailAdmin($modelform,$model);                        
                    $modelform->SendEmailConfirm($modelform,$model); 
                    $msg1 = Yii::t('app', '¡Muchas gracias por mandar tu petición a Authentik Travel! <br />Nuestro equipo te responderá dentro de 12 – 24 hrs.');
                    $msg = $msg1.$msg2;             
                    return $this->render('msg',array('msg'=>$msg,'model'=>$model,'booktour'=>$booktour));
                }                
            }            
       }     
       return $this->render('requestprice',array(
                'model' => $model,
                'modelform' => $modelform,
                'details' => $details,
                'start' => $start,
                'msg' => $msg
        ));
   }
 //customize tour
 public function actionCustomize() { 
       $model = new CustomizeForm(); 
       $this->view->title = Yii::t('app', 'Viaje a Vietnam'); 
       $post  = Yii::$app->request->post();
       $slccouple  = Yii::$app->request->get('slccouple',0);
       $slcyear    = Yii::$app->request->get('slcyear','');
	   if ($model->load($post)) {  	      
            $model->attributes  = $post['CustomizeForm'];
            //save to booktour
            $booktour = new Booktour();
            $booktour->title  = Yii::t('app', 'Request from customize tour on Authentiktravel');
            $requesttxt = Yii::t('app', 'Customize tour').'<br />';    
            if($model->vietnammap!=''){    
                $str = '';
                $arr = explode("[-|-]",$model->vietnammap);
                foreach ($arr as $key => $value) { 
                //while (list($key, $value) = each ($arr)) {                     
                     if($value!=''){
                        if($str=='') $str = $value;
                           else $str .= ' - '.$value;
                     }
                 }
                 if($str!=''){
                    $model->vietnammap = $str;
                    $requesttxt .= '<br /><b>'.Yii::t('app', 'Vietnam').':</b>'.$str;
                 } 
             }
             //lao
             if($model->laosmap!=''){    
                $str = '';
                $arr = explode("[-|-]",$model->laosmap);
                foreach ($arr as $key => $value) { 
               // while (list($key, $value) = each ($arr)) {                     
                     if($value!=''){
                        if($str=='') $str = $value;
                           else $str .= ','.$value;
                     }
                 }
                 if($str!=''){
                    $model->laosmap = $str;
                    $requesttxt .= '<br /><b>'.Yii::t('app', 'Laos').':</b> '.$str;
                 } 
             }
             //cambodia
              if($model->cambodiamap!=''){    
                $str = '';
                $arr = explode("[-|-]",$model->cambodiamap);
                foreach ($arr as $key => $value) { 
                //while (list($key, $value) = each ($arr)) {                     
                     if($value!=''){
                        if($str=='') $str = $value;
                           else $str .= ','.$value;
                     }
                 }
                 if($str!=''){
                    $model->cambodiamap = $str;
                    $requesttxt .= '<br /><b>'.Yii::t('app', 'Camboya').':</b>'.$str;
                 } 
             }
             //other
             if($model->mapother!=''){    
                $str = '';
                $arr = explode("[-|-]",$model->mapother);
                foreach ($arr as $key => $value) { 
                //while (list($key, $value) = each ($arr)) {                     
                     if($value!=''){
                        if($str=='') $str = $value;
                           else $str .= ','.$value;
                     }
                 }
                 if($str!=''){
                    $model->mapother = $str;
                    $requesttxt .= '<br /><b>'.Yii::t('app', 'Otros destinos').':</b>'.$str;
                 } 
             }
             
            $requesttxt  .= '<b>'.Yii::t('app', 'Tu perfil').':</b><br /> - '.$model->getProfile($model->profile_id).'<br />';
            $requesttxt .= '<b>'.Yii::t('app', 'Los participantes').':</b>';
            if($model->number_adults !=''){
               $requesttxt .= '<br />'.Yii::t('app', 'Número de Adultos').'- '.$model->number_adults;
               $booktour->adults  = intval($model->number_adults);
            }
            if($model->number_children !=''){
               $requesttxt .= '<br />'.Yii::t('app', 'Número de niños (1-12 años)').' - '.$model->number_children;
               $booktour->children  = intval($model->number_children);
            }          
            $requesttxt .= '<b><br />'.Yii::t('app', 'Tus tipos de alojamiento').':</b>';             
            if($model->typeacc1>0){
               $requesttxt .= '<br />-'.$model->getAccType($model->typeacc1);    
            }
            if($model->typeacc2>0){
               $requesttxt .= '<br />-'.$model->getAccType($model->typeacc2);    
            }
            if($model->typeacc3>0){
               $requesttxt .= '<br />-'.$model->getAccType($model->typeacc3);    
            }
            if($model->typeacc4>0){
               $requesttxt .= '<br />-'.$model->getAccType($model->typeacc4);    
            }
            if($model->typeacc5>0){
               $requesttxt .= '<br />-'.$model->getAccType($model->typeacc5);    
            }
            $requesttxt .= '<b><br />'.Yii::t('app', 'Propósito del tour').':</b>';
            if($model->purposes_id>0){
               $requesttxt .= '<br />-'.$model->getPurPoses($model->purposes_id);    
            }
            if($model->purposesothertxt !=''){
               $requesttxt .= '<br />-'.$model->purposesothertxt;    
            }               
            $requesttxt .= '<b><br />'.Yii::t('app', 'Tipo de tour').':</b>';
            if($model->typetour1>0){
               $requesttxt .= '<br />-'.$model->getType($model->typetour1);    
            }
            if($model->typetour2>0){
               $requesttxt .= '<br />-'.$model->getType($model->typetour2);    
            } 
            if($model->typetour3>0){
               $requesttxt .= '<br />-'.$model->getType($model->typetour3);    
            }               
            $requesttxt .= '<b><br />'.Yii::t('app', 'Comidas').':</b>';
            if($model->meals1>0){
               $requesttxt .= '<br />-'.$model->getMeals($model->meals1);    
            } 
            if($model->meals2>0){
               $requesttxt .= '<br />-'.$model->getMeals($model->meals2);    
            } 
            if($model->meals3>0){
               $requesttxt .= '<br />-'.$model->getMeals($model->meals3);    
            } 
            $requesttxt .= '<b><br />'.Yii::t('app', 'Tus actividades favorit').':</b>';
            if($model->gowith1>0){
               $requesttxt .= '<br />-'.$model->getGoWith(1).' : '.$model->getGoWithLabel($model->gowith1);    
            }
            if($model->gowith2>0){
               $requesttxt .= '<br />-'.$model->getGoWith(2).' : '.$model->getGoWithLabel($model->gowith2);  
            }
            if($model->gowith3>0){
               $requesttxt .= '<br />-'.$model->getGoWith(3).' : '.$model->getGoWithLabel($model->gowith3);  
            }
            if($model->gowith4>0){
               $requesttxt .= '<br />-'.$model->getGoWith(4).' : '.$model->getGoWithLabel($model->gowith4);  
            }
            if($model->gowith5>0){
               $requesttxt .= '<br />-'.$model->getGoWith(5).' : '.$model->getGoWithLabel($model->gowith5);  
            }
            if($model->gowith6>0){
               $requesttxt .= '<br />-'.$model->getGoWith(6).' : '.$model->getGoWithLabel($model->gowith6);  
            }
            if($model->gowith7>0){
               $requesttxt .= '<br />-'.$model->getGoWith(7).' : '.$model->getGoWithLabel($model->gowith7);  
            }
            if($model->gowith8>0){
               $requesttxt .= '<br />-'.$model->getGoWith(8).' : '.$model->getGoWithLabel($model->gowith8);  
            }
            if($model->gowith9>0){
               $requesttxt .= '<br />-'.$model->getGoWith(9).' : '.$model->getGoWithLabel($model->gowith9);  
            }
            
             $requesttxt .= '<b><br />'.Yii::t('app', 'Descripciones de viaje').':</b>';
             if($model->descriptiontxt !=''){
                 $requesttxt .= '<br />-'.$model->descriptiontxt;    
             } 
             $requesttxt .= '<b><br />'.Yii::t('app', 'Tu fecha de viaje').':</b>';            
             if($model->arrivaldatetxt !=''){
                $requesttxt .= '<br />Día de llegada - '.$model->arrivaldatetxt;
             }
             if($model->arrivaldate_other_m !='' && $model->arrivaldate_other_y !=''){
                $requesttxt .= '<br />Si no, ¿Qué mes prefieres ? - '.$model->arrivaldate_other_m.'/'.$model->arrivaldate_other_y;
             } 
             $requesttxt .= '<br />-'.Yii::t('app', 'Have you booked your international flight');
             if($model->flight_id==1){
                $requesttxt .= '<br />-Yes';
             }else if($model->flight_id==2){
                $requesttxt .= '<br />-No';
             } 
             if($model->number_nights!=''){
               $requesttxt .= '<br />'.Yii::t('app', 'Duración de tu viaje').'-'.$model->number_nights;    
             }              
             $requesttxt .= '<b><br />'.Yii::t('app', 'Tu presupuesto').':</b>';
             if($model->budgettxt!=''){
               $requesttxt .= '<br />-'.$model->budgettxt;    
             } 
             $requesttxt .= '<b><br />'.Yii::t('app', '¿Cómo nos encontrabas?').':</b>';
             if($model->how_did_id>0){
               $requesttxt .= '<br />-'.$model->getHowDidUs($model->how_did_id);    
             }
             if($model->howdidtxt!=''){
               $requesttxt .= '<br />-'.$model->howdidtxt;    
             }           
            $requesttxt .= '<b><br />'.Yii::t('app', 'Tus detalles').'</b><br />';
            $requesttxt .= '<br /><b>'.Yii::t('app', 'Género').':</b>'.$model->slcgender; 
            $requesttxt .= '<br /><b>'.Yii::t('app', 'Nombre').':</b>'.$model->firstname;    
            $requesttxt .= '<br /><b>'.Yii::t('app', 'Apellido').':</b>'.$model->lastname;    
            $requesttxt .= '<br /><b>'.Yii::t('app', 'Nacionalidad').':</b>'.$model->nationality;    
            $requesttxt .= '<br /><b>'.Yii::t('app', 'Dirección').':</b>'.$model->address;    
            //$requesttxt .= '<br />'.Yii::t('app', 'Postalcode').':'.$model->postalcode;    
            //$requesttxt .= '<br />'.Yii::t('app', 'City').':'.$model->city;    
            $requesttxt .= '<br /><b>'.Yii::t('app', 'Teléfono').':</b>'.$model->phone;
            $requesttxt .= '<br /><b>'.Yii::t('app', 'Email').':</b>'.$model->email;
            $requesttxt .= '<br /><b>'.Yii::t('app','Cuenta de Skype').':</b>'.$model->skype;
            $requesttxt .= '<br /><b>'.Yii::t('app','Tu WhatsApp').':</b>'.$model->whatsapp;
            $requesttxt .= '<br /><b>'.Yii::t('app','Tu Viber').':</b>'.$model->viber;
            $requesttxt .= '<b><br />'.Yii::t('app', '¿Qué manera de comunicación prefieres ?').':</b>';
            if($model->contact1>0){
               $requesttxt .= '<br />-'.$model->getContact($model->contact1);    
            }
            if($model->contact2>0){
               $requesttxt .= '<br />-'.$model->getContact($model->contact2);    
            }
            if($model->contact3>0){
               $requesttxt .= '<br />-'.$model->getContact($model->contact3);    
            }
            if($model->contact4>0){
               $requesttxt .= '<br />-'.$model->getContact($model->contact4);    
            }
             if($model->contact5>0){
               $requesttxt .= '<br />-'.$model->getContact($model->contact5);    
            }
            $requesttxt .= '<br /><b>'.Yii::t('app','El mejor momento para teléfono o skype').':</b>'.$model->contacttxt;
            $requesttxt .= '<br /><b>'.Yii::t('app', 'IP').':</b>'.Yii::$app->getRequest()->getUserIP();  
            $requesttxt .= '<br /><b>'.Yii::t('app', 'Fecha de crear').':</b>'.date("Y-m-d H:i:s");
            $booktour->requesttxt  = $requesttxt;
            $booktour->type        = 1;//kieu la tour
            $booktour->source      = 5;//nguon tu web chinh
            $booktour->ip          = Yii::$app->getRequest()->getUserIP();          
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
                //co nen tao thong tin khach hang luon ko ,neu chua co tao moi,
                // neu co roi thi gan thong cho user dua vao cai' gi ,email hay phone               
                //gui email cho khach
                $model->SendEmailAccount($model,$booktour);
                //gui email cho quan tri
                $model->SendEmailAdmin($model,$booktour);
                //thong bao da dat thanh cong  
                $msg1 = Yii::t('app', '¡Muchas gracias por mandar tu petición a Authentik Travel! <br />Nuestro equipo te responderá dentro de 12 – 24 hrs.');  
                $msg = $msg1.$msg2;
                return $this->render('msg',array('msg'=>$msg,'model'=>$model,'booktour'=>$booktour));
            }
       } 
       return $this->render('customize',array('model'=>$model,'slccouple'=>$slccouple,'slcyear'=>$slcyear));
  }
//book tour
   public function actionCustomizeaccount() { 
       return $this->render('customizeaccount',array());
   }
}
