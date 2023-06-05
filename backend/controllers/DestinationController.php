<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Destination;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use common\models\Country;
//use common\models\Region;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use common\models\Log;
class DestinationController extends Controller {
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Destination');     
        return $result;
    }
 public function actionIndex() {
         $model = new Destination();   
         $dataProvider = $model->search(Yii::$app->request->get());        
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Destination();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Destination'];
            if (isset($_FILES['Destination']["name"]["img"]) && $_FILES['Destination']["name"]["img"]!='') {
                $model = $this->_createImg($model,'destination');
             }
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }        
        $allcountry = Country::getCountry();
        return $this->render('create', array(
            'model' => $model,
            'allcountry' => $allcountry
        ));
    }
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $post  = Yii::$app->request->post();
	   if ($model->load($post)) {  
             $model->attributes = $post['Destination'];
             if (isset($_FILES['Destination']["name"]["img"]) && $_FILES['Destination']["name"]["img"]!='') {
                $model = $this->_createImg($model,'destination');
             }
             $model->update();
       } 
       $allcountry = Country::getCountry();
       return $this->render('update', array(
            'model' =>$model,
            'allcountry' =>$allcountry
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
public function actionDelete($id) {
         $model = $this->loadModel($id);
         //$model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Destination::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;        
    } 
}