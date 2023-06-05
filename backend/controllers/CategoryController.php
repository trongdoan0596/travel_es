<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Category;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\models\Log;
class CategoryController extends Controller {
    public $layout='main';
    public $enableCsrfValidation = false;
    public function Init() {
           if(Yii::$app->user->getIsGuest()){
              return Yii::$app->response->redirect(array('site/login'));     
              die('Error!');
           }
     }
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Category');     
        return $result;
    } 
 public function actionIndex() {      
         $model = new Category();   
         $dataProvider = $model->search(Yii::$app->request->get());
         $allcate = Category::getAllParentsTree();
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider,'allcate' =>$allcate));
    }
  //create
  public function actionCreate() {
        $model = new Category();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Category'];
            $model->fulltxt     = str_replace("http://authentiktravel.com", "https://authentiktravel.com",$model->fulltxt);
            if (isset($_FILES['Category']["name"]["img"]) && $_FILES['Category']["name"]["img"]!='') {
               $model->img = $this->_createImg($model,'cate','img');  
            }
            $lang = Yii::$app->request->cookies->getValue('language');	   
            if(empty($lang)){
               $lang = Yii::$app->request->get('language','');
            }            
            $user    = Yii::$app->user->identity;
            $model->user_id     = $user->id;
            $model->user_modify = $user->id;
            $model->lang = $lang;
            $model->last_update = date("Y-m-d H:i:s");           
            $model->create_date = date("Y-m-d H:i:s");
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
       $post  = Yii::$app->request->post();
	   if ($model->load($post) && $id>1) {  
             $model->attributes = $post['Category'];
             $model->fulltxt     = str_replace("http://authentiktravel.com", "https://authentiktravel.com",$model->fulltxt);
             if (isset($_FILES['Category']["name"]["img"]) && $_FILES['Category']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'cate','img');  
             }else{
                $model->img  = $img_old;
             }
             $user    = Yii::$app->user->identity;
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
       if($id>1){
            //loai truong hop Root
             $model = $this->loadModel($id);
             $model->delete();
         }
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Category::findOne($id);                  
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
                $pathfile_thumb = $path.'430_270/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(430,270))->save($pathfile_thumb ,array('quality' =>100));
           }
        return $fileName;
   }    
}