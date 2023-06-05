<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Service;
use common\models\Serviceprice;
use common\models\Article;
use common\models\Booktour;
class ToolsController extends Controller {
    public $layout='main';
    public $enableCsrfValidation = false;//fix Bad Request (#400),Unable to verify your data submission
    public function behaviors() {
        return array(
            'access' =>  array(
                'class' => AccessControl::className(),
                'rules' => array(
                   array(
                        'actions' => array('error'),
                        'allow' => true,
                    ),
                    array(
                         'actions' =>array('index','article',
                         'review','blog','blogcate','tour','tourcate','tourdetail','tourextentions'
                        ),
                        'allow' => true,
                        'roles' =>array('@'),
                    ),
                ),
            ),
            'verbs' => array(
                'class' => VerbFilter::className(),
                'actions' =>  array(
                    'logout' => array('post'),
                ),
            ),
        );
    }

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
//article
 public function actionArticle() {   
        $connec = Yii::$app->getDb();
        /*****Serviceprice*****/
        $sql    = 'ALTER TABLE fr_article DROP INDEX IDX_ARTICLE_CATEID';
        $connec->createCommand($sql)->query();
        $sql    = 'ALTER TABLE fr_article ADD INDEX IDX_ARTICLE_CATEID(cat_id, status)';        
        $connec->createCommand($sql)->query();
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_article';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_article';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
//Booktour
 public function actionBooktour() {   
        $connec = Yii::$app->getDb();       
        $sql    = 'ALTER TABLE fr_booktour DROP INDEX IDX_FR_BOOK_TOURID';
        $connec->createCommand($sql)->query();
        $sql    = 'ALTER TABLE fr_booktour ADD INDEX IDX_FR_BOOK_TOURID(tour_id)';        
        $connec->createCommand($sql)->query();
        
        $sql    = 'ALTER TABLE fr_booktour DROP INDEX IDX_FR_BOOK_USERID';
        $connec->createCommand($sql)->query();
        $sql    = 'ALTER TABLE fr_booktour ADD INDEX IDX_FR_BOOK_USERID(user_id)';        
        $connec->createCommand($sql)->query();
        
        $sql    = 'ALTER TABLE fr_booktour DROP INDEX IDX_FR_BOOK_SALES_ID';
        $connec->createCommand($sql)->query();
        $sql    = 'ALTER TABLE fr_booktour ADD INDEX IDX_FR_BOOK_SALES_ID(sales_id, id, status)';        
        $connec->createCommand($sql)->query();
        
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_booktour';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_booktour';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
 //Review
 public function actionReview() {   
        $connec = Yii::$app->getDb();      
        $sql    = 'ALTER TABLE fr_review DROP INDEX IDX_REVIEW_STATUS';
        $connec->createCommand($sql)->query();
        $sql    = 'ALTER TABLE fr_review ADD INDEX IDX_REVIEW_STATUS(status)';        
        $connec->createCommand($sql)->query();      
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_review';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_review';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    }     
 //Blog
 public function actionBlog() {   
        $connec = Yii::$app->getDb();      
        $sql    = 'ALTER TABLE fr_blog DROP INDEX IDX_BLOG_STATUS';
        $connec->createCommand($sql)->query();
        $sql    = 'ALTER TABLE fr_blog ADD INDEX IDX_BLOG_STATUS(status)';        
        $connec->createCommand($sql)->query();
        $sql    = 'ALTER TABLE fr_blog DROP INDEX IDX_BLOG_CATEID';
        $connec->createCommand($sql)->query();
        $sql    = 'ALTER TABLE fr_blog ADD INDEX IDX_BLOG_CATEID(catblog_id, status)';        
        $connec->createCommand($sql)->query();
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_blog';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_blog';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
//Blogcate
 public function actionBlogcate() {   
        $connec = Yii::$app->getDb();
        /*****Serviceprice*****/
       // $sql    = 'ALTER TABLE fr_article DROP INDEX IDX_ARTICLE_CATEID';
       // $connec->createCommand($sql)->query();
       // $sql    = 'ALTER TABLE fr_article ADD INDEX IDX_ARTICLE_CATEID(cat_id, status)';        
        //$connec->createCommand($sql)->query();
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_blogcate';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_blogcate';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
    //Tour
 public function actionTour() {   
        $connec = Yii::$app->getDb();
        /*****Serviceprice*****/
       // $sql    = 'ALTER TABLE fr_article DROP INDEX IDX_ARTICLE_CATEID';
       // $connec->createCommand($sql)->query();
       // $sql    = 'ALTER TABLE fr_article ADD INDEX IDX_ARTICLE_CATEID(cat_id, status)';        
        //$connec->createCommand($sql)->query();
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_tour';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_tour';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
  public function actionTourcate() {   
        $connec = Yii::$app->getDb();
        /*****Serviceprice*****/
       // $sql    = 'ALTER TABLE fr_article DROP INDEX IDX_ARTICLE_CATEID';
       // $connec->createCommand($sql)->query();
       // $sql    = 'ALTER TABLE fr_article ADD INDEX IDX_ARTICLE_CATEID(cat_id, status)';        
        //$connec->createCommand($sql)->query();
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_tourcate';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_tourcate';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
public function actionTourdetail() {   
        $connec = Yii::$app->getDb();
        /*****Serviceprice*****/
       // $sql    = 'ALTER TABLE fr_article DROP INDEX IDX_ARTICLE_CATEID';
       // $connec->createCommand($sql)->query();
       // $sql    = 'ALTER TABLE fr_article ADD INDEX IDX_ARTICLE_CATEID(cat_id, status)';        
        //$connec->createCommand($sql)->query();
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_tourdetail';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_tourdetail';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
public function actionTourextentions() {   
        $connec = Yii::$app->getDb();
        /*****Serviceprice*****/
       // $sql    = 'ALTER TABLE fr_article DROP INDEX IDX_ARTICLE_CATEID';
       // $connec->createCommand($sql)->query();
       // $sql    = 'ALTER TABLE fr_article ADD INDEX IDX_ARTICLE_CATEID(cat_id, status)';        
        //$connec->createCommand($sql)->query();
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_tourextentions';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_tourextentions';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    }   
public function actionBooktourcomment() {   
        $connec = Yii::$app->getDb();      
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_booktourcomment';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_booktourcomment';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    }  
public function actionBooktourdetail() {   
        $connec = Yii::$app->getDb();      
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_booktourdetail';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_booktourdetail';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
public function actionBooktouremail() {   
        $connec = Yii::$app->getDb();      
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_booktouremail';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_booktouremail';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
public function actionBooktourgroup() {   
        $connec = Yii::$app->getDb();      
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_booktourgroup';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_booktourgroup';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    } 
public function actionBooktourprice() {   
        $connec = Yii::$app->getDb();      
        /*******REPAIR table********/
        $sql    = 'REPAIR TABLE fr_booktourprice';        
        $connec->createCommand($sql)->query();
        /*******OPTIMIZE*********/
        $sql    = 'OPTIMIZE TABLE fr_booktourprice';        
        $connec->createCommand($sql)->query();   
        return $this->render('index');
    }                         
}