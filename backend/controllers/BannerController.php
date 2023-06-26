<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\AuBannerHome;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

class BannerController extends Controller {
    public $layout='main';
    public $enableCsrfValidation = false;
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
                        'actions' =>array('index','create','update','delete'),
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
         $model = new AuBannerHome();   
         $dataProvider = $model->search(array());
        return $this->render('index',array('model' => $model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new AuBannerHome();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Banner'];
            if (isset($_FILES['Banner']["name"]["img"]) && $_FILES['Banner']["name"]["img"]!='') {
                $model = $this->_createImg($model,'banner');
            }
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        return $this->render('create', array(
            'model' => $model,
        ));
    }
 //update
  public function actionUpdate($id) {
       $model   = $this->loadModel($id);
       $post  = Yii::$app->request->post();
	   if ($model->load($post)){
	        $model->attributes  = $post['Banner'];
	        if (isset($_FILES['Banner']["name"]["img"]) && $_FILES['Banner']["name"]["img"]!='') {
                $model = $this->_createImg($model,'banner');
            }
            $model->update();
       }      
      return $this->render('update', array(
            'model' => $model,       
        ));
    }  
//upload file
 public function _createImg($model = null, $folder = null) { 
           //Yii::$app->basePath;//?D:\xampp\htdocs\authentik-travel.com\backend
           $path         = substr(Yii::$app->basePath,0,-7).'media/'.$folder.'/'; 
           $rnd          = rand(0,9999);
           $uploadedFile = UploadedFile::getInstance($model,'img');
           $ext          = strtolower($uploadedFile->getExtension());
           $ext_img = array ("jpg", "gif", "png");
           if (in_array ($ext,$ext_img)) {  
                $fileName     = md5($rnd.$uploadedFile).'.'.$uploadedFile->getExtension();
                $uploadedFile->saveAs($path.$fileName,true); 
                $model->img   = $fileName;
           }
        return $model;
}
//view
public function actionView($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(array('view', 'id' => $model->id));
        } else {
            return $this->render('view', array('model' => $model));
        }
    }
public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Banner::findOne($id);
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    }
            
}
