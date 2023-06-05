<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Article;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use common\models\Category;
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
class ArticleController extends Controller {
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
public function afterAction($action, $result){
        $result = parent::afterAction($action, $result);
        $id = 0;        
        $user_id = Yii::$app->user->identity->id;
        if($this->action->id=='update'){
           $id = $this->action->controller->actionParams['id'];  
        }
        Log::AddLog("add",$id,0,'',$this->action->id,'Article');     
        return $result;
    }
 public function actionIndex() {      
         $model = new Article();   
         $dataProvider = $model->search(Yii::$app->request->get());     
         $cate     = Category::getAllParentsTree();//getCateparent(1);//danh muc voi parent_id=1 
      
        return $this->render('index',array('model' =>$model,'cate' =>$cate,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model   = new Article();
        $post    = Yii::$app->request->post();
       
	    if ($model->load($post)) {  
            $model->attributes  = $post['Article'];
           //$model->fulltxt     = str_replace("http://authentik-travel.com", "https://authentik-travel.com",$model->fulltxt);
            $user     = Yii::$app->user->identity;
            $model->user_id     = $user->id;
            $model->user_modify = $user->id;           
            $model->last_update = date("Y-m-d H:i:s");
            $model->create_date = date("Y-m-d H:i:s");
            if (isset($_FILES['Article']["name"]["img"]) && $_FILES['Article']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'article','img');  
            }
            if($model->title==''){
                echo 'Error Title!';
                die();                
            }
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        $allcate = Category::getAllParentsTree();
        return $this->render('create', array(
            'model' => $model,
            'allcate' =>$allcate   
        ));
    }
    
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $img_old = $model->img;
       $post    = Yii::$app->request->post();
       $user_id = Yii::$app->user->identity->id;
	   if ($model->load($post)) {  
             $model->attributes = $post['Article'];
             $model->fulltxt     = str_replace("http://authentiktravel.es", "https://authentiktravel.es",$model->fulltxt);
             $model->user_modify= $user_id;
             $model->last_update = date("Y-m-d H:i:s");
             if (isset($_FILES['Article']["name"]["img"]) && $_FILES['Article']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'article','img');  
             }else{
                $model->img  = $img_old;
             }
             if($model->title==''){
                echo 'Error Title!';
                die();                
             }
            $user     = Yii::$app->user->identity;       
            $model->user_modify = $user->id;           
            $model->update();
       }
      $allcate = Category::getAllParentsTree();
      return $this->render('update', array(
            'model' => $model,
            'allcate' =>$allcate
        ));
    }
public function actionDelete($id) {
         $model = $this->loadModel($id);         
         $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Article::findOne($id);             
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
                $pathfile_thumb = $path.'340_220/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(340,220))->save($pathfile_thumb ,array('quality' =>60));
                $pathfile_thumb = $path.'450_230/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(450,230))->save($pathfile_thumb ,array('quality' =>60));
                $pathfile_thumb = $path.'370_221/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(370,221))->save($pathfile_thumb ,array('quality' =>60));
           }
        return $fileName;
   }
}