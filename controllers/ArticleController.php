<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;
//use yii\helpers\HtmlPurifier;
use common\models\Article;
use common\models\Category;
use common\models\QuestionForm;
//use yii\base\InvalidParamException;
//use yii\web\BadRequestHttpException;
/**
 * Article controller
 */
class ArticleController extends Controller {
   public $layout='main';
   public $enableCsrfValidation = false;
   public function actions()  {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
        );
    }
    public function actionIndex() {
        return $this->render('index');        
    }
    public function actionViewaboutus() { 
        $id    = 174;
        $model = Article::getDetailArticle($id);   
        $url   = '#';
       if(!empty($model)){
                $baseurl = Url::base(true);//'https://authentiktravel.es';
                $title =  '';             
                if($model->metatitle!=''){
                    $title = $model->metatitle;
                 }else{
                    $title = $model->title; 
                 }
                 $this->view->title = $title;
                if($model->metadesc!='') $metadesc = $model->metadesc;
                  else $metadesc = $title;
                $this->view->registerMetaTag(array('name'=>'description','content'=>$metadesc));
                if($model->metakey!='') $metakey = $model->metakey;
                  else $metakey = $model->title;
                $this->view->registerMetaTag(array('name'=>'keywords','content'=>$metakey));     
                $url = $baseurl.Article::createUrl($model);                               
                $this->view->registerMetaTag(array('property'=>'og:url','content'=>$url));
                $this->view->registerMetaTag(array('property'=>'og:type','content'=>'website'));                                            
                $this->view->registerMetaTag(array('property'=>'og:title','content'=>$title));                                   
                $this->view->registerMetaTag(array('property'=>'og:description','content'=>$metadesc));
                $this->view->registerMetaTag(array('property'=>'og:site_name','content'=>'Authentik vietnam'));             
                if($model->img !=''){
                     $img = Article::getImage($model);
                     $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));       
                }      
       }
	   return $this->render('aboutus',array(
            'model' => $model
            ));
    }
   public function actionView() {       
       $id    = Yii::$app->request->get('id',0);
       $model = Article::getDetailArticle($id);
       $tmp   = 'view';
       switch ($id) {
            case 104:
            case 7:
                $tmp = 'aboutus';
                break;
            case 1:
                $tmp = 'view';
                break;                    
        }
       $url   = '#';
       if(!empty($model)){
                $baseurl = Url::base(true);//'https://authentiktravel.es';
                $title = '';                
                if($model->metatitle!=''){
                    $title = $model->metatitle;
                 }else{
                    $title = $model->title; 
                 }
                $this->view->title = $title; 
                if($model->metadesc!='') $metadesc = $model->metadesc;
                  else $metadesc = $title;                  
                $this->view->registerMetaTag(array('name'=>'description','content'=>$metadesc));
                if($model->metakey!='') $metakey = $model->metakey;
                  else $metakey = $model->title;
                $this->view->registerMetaTag(array('name'=>'keywords','content'=>$metakey));     
                $url = $baseurl.Article::createUrl($model);                               
                $this->view->registerMetaTag(array('property'=>'og:url','content'=>$url));
                $this->view->registerMetaTag(array('property'=>'og:type','content'=>'website'));                                            
                $this->view->registerMetaTag(array('property'=>'og:title','content'=>$title));                                   
                $this->view->registerMetaTag(array('property'=>'og:description','content'=>$metadesc));
                $this->view->registerMetaTag(array('property'=>'og:site_name','content'=>'Authentik vietnam'));                
                if($model->img !=''){
                     $img = Article::getImage($model);
                     $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));       
                }            
                        
       }
	   return $this->render($tmp,array(
            'model' => $model
            ));
   }
 //about us
    public function actionApropos() { 
       $model = Article::getDetailArticle(7);
	   return $this->render('aboutus',array(
            'model' => $model
            ));
   }   
   /*recruitment*/
   public function actionRecruitment() {
         $cid = 39;
         $info = Category::getDetailCategory($cid);
         $url ='#';
         if(!empty($info)){             
             $baseurl = Url::base(true);//'https://authentiktravel.es';
             $title = $info->title; 
             if($info->metatitle!=''){
                $this->view->title = $info->metatitle;
             }        
             $this->view->title = $title; 
             $metadesc = $info->title;  
             if($info->metadesc!='') $metadesc = $info->metadesc;
             $metakey = $info->title;        
             if($info->metakey!='') $metakey = $info->metakey; 
             $url = $baseurl.'/recruitment';
             $this->view->registerMetaTag(array('name'=>'description','content'=>$metadesc));
             $this->view->registerMetaTag(array('name'=>'keywords','content'=>$metakey));             
             $this->view->registerMetaTag(array('property'=>'og:url','content'=>$url));
             $this->view->registerMetaTag(array('property'=>'og:type','content'=>'website'));                                            
             $this->view->registerMetaTag(array('property'=>'og:title','content'=>$title));                                   
             $this->view->registerMetaTag(array('property'=>'og:description','content'=>$metadesc));
             $this->view->registerMetaTag(array('property'=>'og:site_name','content'=>'Authentik vietnam')); 
             if($info->img !=''){
                 $img = Category::getImage($info);
                 $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));       
             }
         }       
                            
        $query  = Article::find()->where("cat_id =:cat_id AND status =:status",array(":cat_id" =>$cid,":status" =>1));       
        $rows   = $query->orderBy('ordering asc')->all();
        return $this->render('recruitment',array('rows' =>$rows,'info' =>$info,'urlshare'=>$url));        
    }
   //beforetrips
 public function actionBeforetrips() {        
         $cid   = 26;
         $info  = Category::getDetailCategory($cid);         
         $model = new QuestionForm();
         $post  = Yii::$app->request->post();  
         $url ='#';       
	     if ($model->load($post)) {  
            $model->attributes  = $post['QuestionForm'];
            //luu thong tin vao            
            $article = new Article();
            $article->id          = '';
            $article->title       = 'Question - '.date("d/m/Y H:i:s");          
            $article->cat_id      = $model->cat_id;
            $article->status      = 0;
            $article->introtxt    = $model->mess.'--/-- Infomation : Title / '.$model->title.' - Name / '.$model->name.' - Country / '.$model->country.' - Phone / '.$model->phone.' - E-mail / '.$model->email;    
            $article->last_update = date("Y-m-d H:i:s");
            $article->create_date = date("Y-m-d H:i:s");
            if ($article->save(false)){
                $model->SendEmail($model,$article);
            } 
            Yii::$app->session->setFlash('msg', 'Thank you send mail for us.');          
         }         
         if(!empty($info)){             
             $baseurl = Url::base(true);//'https://authentiktravel.es';
             $title = $info->title; 
             if($info->metatitle!=''){
                $this->view->title = $info->metatitle;
             }        
             $this->view->title = $title; 
             $metadesc = $info->title;  
             if($info->metadesc!='') $metadesc = $info->metadesc;
             $metakey = $info->title;        
             if($info->metakey!='') $metakey = $info->metakey;  
             $url = $baseurl.'/before-the-trips';           
             $this->view->registerMetaTag(array('property'=>'og:site_name','content'=>'Authentik travel')); 
             $this->view->registerMetaTag(array('name'=>'description','content'=>$metadesc));
             $this->view->registerMetaTag(array('name'=>'keywords','content'=>$metakey));             
             $this->view->registerMetaTag(array('property'=>'og:url','content'=>$url));
             $this->view->registerMetaTag(array('property'=>'og:type','content'=>'website'));                                            
             $this->view->registerMetaTag(array('property'=>'og:title','content'=>$title));                                   
             $this->view->registerMetaTag(array('property'=>'og:description','content'=>$metadesc));
             $this->view->registerMetaTag(array('property'=>'og:site_name','content'=>'Authentik travel')); 
             if($info->img !=''){
                 $img = Category::getImage($info);
                 $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));       
             }
        }       
        //list category       
        $rows   = Category::getCateparent($cid,'ordering asc');        
        return $this->render('beforetrips',array('rows' =>$rows,'info' =>$info,'urlshare'=>$url));        
    }
 //travelinformation
 public function actionTravelinformation() {
         $cid = 31;
         $info = Category::getDetailCategory($cid);
         $model = new QuestionForm();
         $post  = Yii::$app->request->post();  
         $url ='#';              
	     if ($model->load($post)) {  
            $model->attributes  = $post['QuestionForm'];
            //luu thong tin vao            
            $article = new Article();
            $article->id          = '';
            $article->title       = 'Question - '.date("d/m/Y H:i:s");          
            $article->cat_id      = $model->cat_id;
            $article->status      = 0;
            $article->introtxt    = $model->mess.'--/-- Infomation : Title / '.$model->title.' - Name / '.$model->name.' - Country / '.$model->country.' - Phone / '.$model->phone.' - E-mail / '.$model->email;    
            $article->last_update = date("Y-m-d H:i:s");
            $article->create_date = date("Y-m-d H:i:s");
            if ($article->save(false)){
                $model->SendEmail($model,$article);
            } 
            Yii::$app->session->setFlash('msg', 'Thank you send mail for us.');          
         }     
         
         if(!empty($info)){            
             $baseurl = Url::base(true);//'https://authentiktravel.es';
             $title = $info->title; 
             if($info->metatitle!=''){
                $this->view->title = $info->metatitle;
             }        
             $this->view->title = $title; 
             $metadesc = $info->title;  
             if($info->metadesc!='') $metadesc = $info->metadesc;
             $metakey = $info->title;        
             if($info->metakey!='') $metakey = $info->metakey;   
             $url = $baseurl.'/travel-information';           
             $this->view->registerMetaTag(array('property'=>'og:site_name','content'=>'Authentik travel')); 
             $this->view->registerMetaTag(array('name'=>'description','content'=>$metadesc));
             $this->view->registerMetaTag(array('name'=>'keywords','content'=>$metakey));             
             $this->view->registerMetaTag(array('property'=>'og:url','content'=>$url));
             $this->view->registerMetaTag(array('property'=>'og:type','content'=>'website'));                                            
             $this->view->registerMetaTag(array('property'=>'og:title','content'=>$title));                                   
             $this->view->registerMetaTag(array('property'=>'og:description','content'=>$metadesc));
             $this->view->registerMetaTag(array('property'=>'og:site_name','content'=>'Authentik travel')); 
             if($info->img !=''){
                 $img = Category::getImage($info);
                 $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));       
             }
        }       
        //list category       
        $rows   = Category::getCateparent($cid,'ordering asc'); 
        return $this->render('travelinformation',array('rows' =>$rows,'info' =>$info,'urlshare'=>$url));      
    }
    
    public function actionError() {
        return $this->render('error');
    } 
    

}
