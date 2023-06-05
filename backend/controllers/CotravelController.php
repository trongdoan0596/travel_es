<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Cotravel;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
class CotravelController extends Controller {
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
                        'actions' =>array('index','create','update','delete','uploadimg'),
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
         $model = new Cotravel();   
         $dataProvider = $model->search(Yii::$app->request->get());  
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Cotravel();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Cotravel'];
            if (isset($_FILES['Cotravel']["name"]["img"]) && $_FILES['Cotravel']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'cotravel','img');               
            }
            if($model->title==''){
                echo 'Error Title!';
                die();                
            }
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        return $this->render('create', array(
            'model' => $model
        ));
    }
    
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $img_old = $model->img;
       $post  = Yii::$app->request->post();
	   if ($model->load($post)) {  
             $model->attributes = $post['Cotravel'];
             if (isset($_FILES['Cotravel']["name"]["img"]) && $_FILES['Cotravel']["name"]["img"]!='') {
                 $model->img = $this->_createImg($model,'cotravel','img');               
             }else{
                $model->img  = $img_old;
             }
            if($model->title==''){
                echo 'Error Title!';
                die();                
            }
             $model->update();
       }
     
      return $this->render('update', array(
            'model' => $model
        ));
    }
public function actionDelete($id) {
         $model = $this->loadModel($id);
         $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Cotravel::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    }
 //upload file
 public function _createImg($model = null, $folder = null,$img = null) { 
           $path         = substr(Yii::$app->basePath,0,-7).'media/'.$folder.'/'; 
           $rnd          = rand(0,9999);
           $uploadedFile = UploadedFile::getInstance($model,$img);
           $ext          = strtolower($uploadedFile->getExtension());
           $ext_img = array ("jpg", "gif", "png");
           $fileName='';
           if (in_array ($ext,$ext_img)) {  
                $fileName     = md5($rnd.$uploadedFile).'.'.$uploadedFile->getExtension();
                $uploadedFile->saveAs($path.$fileName,true); 
                $pathfile = $path.$fileName;
                /*$size     = @getimagesize($pathfile);
                if(count($size)){
                    $w  = $size[0];
                    $h  = $size[1];
                    if($w>550 || $h>350){
	                   Image::thumbnail($pathfile,550,350)->save($pathfile);
                    }
                }*/
                $pathfile_thumb = $path.'370_221/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(370,221))->save($pathfile_thumb ,array('quality' =>100));
           }
        return $fileName;
   }
}