<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Ourteam;
use common\models\Country;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\models\Log;
class OurteamController extends Controller {
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Ourteam');     
        return $result;
    } 
 public function actionIndex() {
         $model = new Ourteam();   
         $dataProvider = $model->search(Yii::$app->request->get());        
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Ourteam();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Ourteam'];
            $model->fulltxt     = str_replace("http://authentikvietnam.com", "https://authentikvietnam.com",$model->fulltxt);
            $model->last_update = date("Y-m-d H:i:s");
            if (isset($_FILES['Ourteam']["name"]["img"]) && $_FILES['Ourteam']["name"]["img"]!='') {
                $model = $this->_createImg($model,'ourteam');
             }
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }     
        $country = Country::getAllCountry();   
        return $this->render('create', array(
            'model' => $model,
            'country' => $country    
        ));
    }
 //update
  public function actionUpdate($id) {
       $model   = $this->loadModel($id);
       $img_old = $model->img;
       $post  = Yii::$app->request->post();
	   if ($model->load($post)) {  
             $model->attributes  = $post['Ourteam'];
             $model->fulltxt     = str_replace("http://authentikvietnam.com", "https://authentikvietnam.com",$model->fulltxt);
             $model->last_update = date("Y-m-d H:i:s");
             if (isset($_FILES['Ourteam']["name"]["img"]) && $_FILES['Ourteam']["name"]["img"]!='') {
                $model = $this->_createImg($model,'ourteam');
             }else{
                $model->img = $img_old;
             }
             $model->update();
       } 
      $country = Country::getAllCountry();
      return $this->render('update', array(
            'model' => $model,
            'country' => $country              
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
               // $fileName     = md5($rnd.$uploadedFile).'.'.$uploadedFile->getExtension();
                $fileName     = $uploadedFile->name;//.'.'.$uploadedFile->getExtension();
                $uploadedFile->saveAs($path.$fileName,true); 
                $model->img   = $fileName;
                $pathfile_thumb = $path.'245_245/'.$fileName;
                $pathfile     = $path.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(245,245))->save($pathfile_thumb ,array('quality' =>60));
                
           }
        return $model;
}
public function actionDelete($id) {
         $model = $this->loadModel($id);
         $model->status = -1;
         $model->update();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Ourteam::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;        
    } 
}