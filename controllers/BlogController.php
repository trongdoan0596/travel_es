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
use common\models\Blog;
use common\models\Blogcate;
//use yii\base\InvalidParamException;
//use yii\web\BadRequestHttpException;
use common\models\Article;
/**
 * Blog controller
 */
class BlogController extends Controller {
   public $layout='mainblog';//main mainblog
   public $enableCsrfValidation = false;   
   public function actions()  {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
        );
    }
public function actionIndex(){    
        $cid     = Yii::$app->request->get('bcid',0);      
        $baseurl = Url::base(true);//'https://authentiktravel.es';          
        if($cid==0){  
               $alias = Yii::$app->request->get('title',''); 
               if($alias=='') $alias = Yii::$app->request->pathInfo; 
               $infocate = Blogcate::getDetailAlias($alias);  
               if(!empty($infocate)) $cid = $infocate->id;    
         }else{
            $infocate = Blogcate::getDetailBlogcate($cid); 
         }       
        $sql  = Blog::find()->where(['status'=>1]);
        if($cid>0){
            Blogcate::getAllIds($arr,$cid);
            if(!empty($arr)){
                //$strids = $cid.','.implode(",",$arr);
                $arr[]=$cid;
                $sql->andWhere(['in','catblog_id',$arr]);
                //$sql->andWhere('catblog_id IN('.$strids.')');
            }else{
                $sql->andWhere(['catblog_id'=>$cid]);
            }
        } 
        $txtseach = Yii::$app->request->post('txtseach','');
        if($txtseach!=''){
            $sql->andWhere(['like','list_tag',$txtseach]);
        }
        $txttag = Yii::$app->request->get('txttag','');
        if($txttag!=''){
            $txttag =  str_replace("-", " ",$txttag);
            $sql->andWhere(['like','list_tag',$txttag]);
        }
        $count  = clone $sql;
        $pages  = new Pagination(['totalCount'=>$count->count(),'pageSize'=>9]);
        $rows   = $sql->offset($pages->offset)->limit($pages->limit)->orderBy('last_update desc')->all();
        $title  = $metadesc = $metakey = '';
        $info   = Article::getDetailArticle(194);
        if(!empty($infocate)){
            $title = $infocate->title;             
            $metadesc = $infocate->metadesc;
            $metakey  = $infocate->metakey;            
        }else{                
            if(!empty($info)){             
                 if($info->metatitle!=''){
                    $title = $info->metatitle;
                 }else{
                    $title = $info->title; 
                 }   
                $metadesc = $info->metadesc;
                $metakey  = $info->metakey;
                if($info->img !=''){
                     $imgshare = $baseurl.Article::getImage($info);
                     $this->view->registerMetaTag(['property'=>'og:image','content'=>$imgshare]);
                } 
            } 
         }                  
        $this->view->title = $title; 
        $this->view->registerMetaTag(['name'=>'description','content'=>$metadesc]);
        $this->view->registerMetaTag(['name'=>'keywords','content'=>$metakey]);
        $this->view->registerMetaTag(['property'=>'og:site_name','content'=>'Authentik travel']);
        
        $url = $baseurl.'/blog';
        $this->view->registerMetaTag(['property'=>'og:url','content'=>$url]);
        $this->view->registerMetaTag(['property'=>'og:type','content'=>'website']);
        $this->view->registerMetaTag(['property'=>'og:title','content'=>$title]);
        $this->view->registerMetaTag(['property'=>'og:description','content'=>$metadesc]);
        $this->view->registerLinkTag(['rel'=>'canonical','href'=>$url]); 
        return $this->render('index',['rows'=>$rows,'pages'=>$pages,'info'=>$info,'cid'=>$cid,'infocate'=>$infocate]);
    } 
  
//View
 public function actionView() {       
       $id    = Yii::$app->request->get('id',0);      
       $model = '';
       if($id==0){    
           $alias = Yii::$app->request->get('title','');
           if(empty($alias)) $alias = Yii::$app->request->pathInfo;
           $model = Blog::getDetailAlias($alias);
       }else{
           $model = Blog::getDetailBlog($id);
       }       
       $url   = '#';$imgshare='#';  $metadesc=''; $keywords=''; 
       if(!empty($model)){               
                $baseurl = Url::base(true);//'https://authentiktravel.es';    
                $title   = $model->title;//Html::encode($model->title);
                $this->view->title = $title; 
                if($model->metadesc!=''){                   
                    $metadesc = $model->metadesc;
                } else{
                    $metadesc = $model->title;                    
                } 
                $this->view->registerMetaTag(['property'=>'og:site_name','content'=>'Authentik travel']);
                $this->view->registerMetaTag(['name'=>'description','content'=>$metadesc]);
                if($model->metakey!=''){
                    $metakey = $model->metakey;                   
                }else{
                    $metakey = $model->title;                    
                } 
                $keywords = $metakey;
                $this->view->registerMetaTag(['name'=>'keywords','content'=>$metakey]);
                $url = $baseurl.Blog::createUrl($model);                               
                $this->view->registerMetaTag(['property'=>'og:url','content'=>$url]);
                $this->view->registerMetaTag(['property'=>'og:type','content'=>'website']);
                $this->view->registerMetaTag(['property'=>'og:title','content'=>$title]);
                $this->view->registerMetaTag(['property'=>'og:description','content'=>$metadesc]);
                $this->view->registerLinkTag(['rel'=>'canonical','href'=>$url]);               
                if($model->img !=''){
                     $imgshare = $baseurl.Blog::getImage($model);
                     $this->view->registerMetaTag(['property'=>'og:image','content'=>$imgshare]);
                } 
                $cookies = Yii::$app->request->cookies;
                $blogids  = $cookies->getValue('aublogids');
                if($cookies->has('aublogids')){
                       $arr_ids = explode(",",$blogids);
                       if (!in_array ($model->id,$arr_ids)) {
                           $model->hit = $model->hit + 1;
                           $model->update();
                           $arr_ids[$model->id] = $model->id;
                           //update lai cookies
                            $cookies = Yii::$app->response->cookies;
                            $cookies->remove('aublogids');        
                            unset($cookies['aublogids']); 
                            $str_tmp = implode(",",$arr_ids);
                            $cookies->add(new \yii\web\Cookie(array('name'=>'aublogids','value'=>$str_tmp)));
                       }
                }else{
                     $model->hit = $model->hit + 1;  
                     $model->update();
                     $cookies = Yii::$app->response->cookies;
                     $cookies->add(new \yii\web\Cookie(array('name'=>'aublogids','value'=>$model->id)));      
                }
                //$keywords=$this->view->keywords;   
       }
	   return $this->render('view',['model'=>$model,'urlshare'=>$url,'imgshare'=>$imgshare,'metadesc'=>$metadesc,'keywords'=>$keywords]);
   } 
    public function actionError() {
        return $this->render('error');
    }
}
