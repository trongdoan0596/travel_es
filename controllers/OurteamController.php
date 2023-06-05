<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Ourteam;
use yii\data\Pagination;
use common\models\Article;
/**
 * Ourteam controller
 */
class OurteamController extends Controller {
   public $layout='main';
   public function actions()  {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
        );
    }
    public function actionIndex() {         
        $query  = Ourteam::find()->where("status =:status AND country_id=:country_id",array(":status" =>1,":country_id" =>232));
        $count  = clone $query;
        $pages  = new Pagination(array('totalCount' => $count->count(),'pageSize'=>150));
        $rows   = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->orderBy('ordering asc')
                        ->all();
        $info = Article::getDetailArticle(181);   
        if(!empty($info)){    
             $baseurl = 'https://authentiktravel.es';
             $title = $this->view->title; 
             if($info->metatitle!=''){
                $title = $info->metatitle;
             }        
             $this->view->title = $title; 
             $metadesc = $info->title;  
             if($info->metadesc!='') $metadesc = $info->metadesc;
             $metakey = $info->title;        
             if($info->metakey!='') $metakey = $info->metakey;  
             $url = $baseurl.'/authentik-teams';    
             $this->view->registerMetaTag(array('name'=>'description','content'=>$metadesc));
             $this->view->registerMetaTag(array('name'=>'keywords','content'=>$metakey));
             $this->view->registerMetaTag(array('property'=>'og:url','content'=>$url));
             $this->view->registerMetaTag(array('property'=>'og:type','content'=>'website'));                                            
             $this->view->registerMetaTag(array('property'=>'og:title','content'=>$title));                                   
             $this->view->registerMetaTag(array('property'=>'og:description','content'=>$metadesc));
             $this->view->registerMetaTag(array('property'=>'og:site_name','content'=>'Authentik travel'));   
             if($info->img !=''){
                 $img = Article::getImage($info);
                 $this->view->registerMetaTag(array('property'=>'og:image','content'=>$baseurl.$img));       
             }                
        }                
        return $this->render('index',array('rows' =>$rows,'pages' =>$pages,'info' =>$info));    
      
        
    }
public function actionView() {       
       $id    = Yii::$app->request->get('id',0);
       //$title = Yii::$app->request->get('title','');       
       $model = Ourteam::getDetailOurteam($id);
       if(!empty($model)){
          $this->view->title = $model->title; 
       }
       $rows  = Ourteam::getListOurteam();
	   return $this->render('view',array(
            'model' => $model,
            'rows' => $rows
            ));
   }
//ourteam in france
    public function actionIndexfr() {
         $this->view->title = "Nos correspondants bénévols"; 
         $this->view->registerMetaTag(array(
                'name'=>'description',
                'content'=>"Notre équipe Authentik Nos correspondants bénévols"
          ));
         $this->view->registerMetaTag(array(
                'name'=>'keywords',
                'content'=>"Notre équipe Authentik Nos correspondants bénévols"
            ));   
                            
        $query  = Ourteam::find()->where("status =:status AND country_id!=232",array(":status" =>1));
        $count  = clone $query;
        $pages  = new Pagination(array('totalCount' => $count->count(),'pageSize'=>20));
        $rows   = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->orderBy('ordering asc')
                        ->all();
        return $this->render('indexfr',array('rows' =>$rows,'pages' =>$pages));         
    }  
    public function actionError() {
        return $this->render('error');
    } 
    

}
