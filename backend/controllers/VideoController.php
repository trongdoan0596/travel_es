<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Video;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\models\Log;
class VideoController extends Controller {
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
public function afterAction($action, $result){
        $result = parent::afterAction($action, $result);
        $id = 0;        
        $user_id = Yii::$app->user->identity->id;
        if($this->action->id=='update'){
           $id = $this->action->controller->actionParams['id'];  
        }
        Log::AddLog("add",$id,0,'',$this->action->id,'Video');     
        return $result;
    }
 public function actionIndex() {      
         $model = new Video();   
         $dataProvider = $model->search(Yii::$app->request->get()); 
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model   = new Video();
        $post    = Yii::$app->request->post();
        $user_id = Yii::$app->user->identity->id;
	    if ($model->load($post)) {  
            $model->attributes  = $post['Video'];
            $model->create_date = date("Y-m-d H:i:s");
            $model->last_update = date("Y-m-d H:i:s");
            if (isset($_FILES['Video']["name"]["img"]) && $_FILES['Video']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'video','img');  
            }   
            preg_match('/src="([^"]+)"/', $model->embedcode, $match);
            $model->url = $match[1];            
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
       $post    = Yii::$app->request->post();
       $user_id = Yii::$app->user->identity->id;
	   if ($model->load($post)) {  
             $model->attributes = $post['Video'];            
             $model->last_update = date("Y-m-d H:i:s");             
             if (isset($_FILES['Video']["name"]["img"]) && $_FILES['Video']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'video','img');  
             }else{
                $model->img  = $img_old;
             }      
             preg_match('/src="([^"]+)"/', $model->embedcode, $match);
             $model->url = $match[1]; 
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
        $model = Video::findOne($id);       
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
                $fileName     = $uploadedFile->name;
                $uploadedFile->saveAs($path.$fileName,true); 
                $pathfile = $path.$fileName;
                $pathfile_thumb = $path.'340_214/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(340,214))->save($pathfile_thumb ,array('quality' =>100));                             
                 Image::getImagine()->open($pathfile)->thumbnail(new Box(160,90))->save($path.'160_90/'.$fileName,array('quality' =>100));   
            }
        return $fileName;
   }
}