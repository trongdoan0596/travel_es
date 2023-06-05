<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Blogcate;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\models\Aliasurl;
use common\helper\StringHelper;
use common\models\Log;
class BlogcateController extends Controller {
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
        //if($this->action->id!='index'){
            Log::AddLog("add",$id,0,'',$this->action->id,'Blogcate'); 
       // } 
        return $result;
    }
 public function actionIndex() {      
         $model = new Blogcate();   
         $dataProvider = $model->search(Yii::$app->request->get());
         $allcate = Blogcate::getAllParentsTree();               
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider,'allcate' => $allcate));
    }
  //create
  public function actionCreate() {
        $model = new Blogcate();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Blogcate'];
            $user     = Yii::$app->user->identity;
            $model->user_id    = $user->id;
            $model->user_modify = $user->id;
            $model->create_date = date("Y-m-d H:i:s");
            $model->last_update = date("Y-m-d H:i:s");            
            if (isset($_FILES['Blogcate']["name"]["img"]) && $_FILES['Blogcate']["name"]["img"]!='') {
               $model->img = $this->_createImg($model,'blogcate','img');  
            }
            if($model->alias==''){
                $model->alias = StringHelper::formatUrlKey($model->title);
            }else{
                $model->alias = StringHelper::formatUrlKey($model->alias);
            }
            if ($model->save()) {
                 Blogcate::getPath($arr,$model->id);
                 if(count($arr)){
                     $i = 0;$str='';
                     while ($i <count($arr)){                    
                         if($str=='') $str = $arr[$i];
                           else $str = $arr[$i].'/'.$str;
                        $i++;
                     }
                     $model->path = $str;
                     $model->update();
                 }
                //add alias
                $chk_alias = Aliasurl::AddAliasUrl($model->alias,'blogcate','view',$model->id,Aliasurl::ALIASURL_BLOG_CATE,'addnew');
                if($chk_alias!=$model->alias){
                    $model->alias = $chk_alias;
                    $model->update();
                } 
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        $allcate = Blogcate::getAllParentsTree();
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
             $model->attributes = $post['Blogcate'];
             if (isset($_FILES['Blogcate']["name"]["img"]) && $_FILES['Blogcate']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'blogcate','img');  
             }else{
                $model->img  = $img_old;
             }
            $user     = Yii::$app->user->identity;          
            $model->user_modify = $user->id;           
            $model->last_update = date("Y-m-d H:i:s");
            $arr=array();
            Blogcate::getPath($arr,$model->id);
            if(count($arr)){
                $i = 0;$str='';
                while ($i <count($arr)){                    
                     if($str=='') $str = $arr[$i];
                       else $str = $arr[$i].'/'.$str;
                    $i++;
                }
                $model->path = $str;
             } 
            if($model->alias==''){
                   $model->alias = StringHelper::formatUrlKey($model->title);
               }else{
                   $model->alias = StringHelper::formatUrlKey($model->alias);
             }
             if($model->update()) {
                   $chk_alias = Aliasurl::AddAliasUrl($model->alias,'blogcate','view',$model->id,Aliasurl::ALIASURL_BLOG_CATE,'update');
                   if($chk_alias!=$model->alias){
                       $model->alias = $chk_alias;
                       $model->update();
                   }
             }           
       }   
      $allcate = Blogcate::getAllParentsTree();
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
        $model = Blogcate::findOne($id); 
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