<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Blog;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use common\models\Blogcate;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\models\Destination;
use common\models\Aliasurl;
use common\models\Log;
use common\helper\StringHelper;
class BlogController extends Controller {
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
        //if($this->action->id!='index'){
            Log::AddLog("add",$id,0,'',$this->action->id,'Blog'); 
       // } 
        return $result;
    }
 public function actionIndex() {  
         $model = new Blog();   
         $dataProvider = $model->search(Yii::$app->request->get());     
         $cate     = Blogcate::getAllParentsTree();  
        return $this->render('index',array('model' =>$model,'cate' =>$cate,'dataProvider' => $dataProvider));
    }
   public function actionTest() {      
        /* $rows = Blog::find()->all();
         if(!empty($rows)){
              foreach($rows as $row){
                    $row->create_date = $row->last_update;
                    $row->update();
              }
         }
         die();*/
    }  
  //create
  public function actionCreate() {
        $model   = new Blog();
        $post    = Yii::$app->request->post();    
        $destination= Destination::getAllDestination();    
	    if ($model->load($post)) {  
            $model->attributes  = $post['Blog'];
            if($post['Blog']['destination_ids']!=''){
                $model->destination_ids = implode(",",$post['Blog']['destination_ids']);
            }
            $user     = Yii::$app->user->identity;
            $model->fulltxt     = str_replace("http://authentiktravel.com", "https://authentiktravel.com",$model->fulltxt);
            $model->user_id     = $user->id;
            $model->user_modify = $user->id;
            $model->last_update = date("Y-m-d H:i:s");    
           // if($model->create_date==''){
            $model->create_date = date("Y-m-d H:i:s");
           // } 
            if (isset($_FILES['Blog']["name"]["img"]) && $_FILES['Blog']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'blog','img');  
            }
            if($model->title==''){
                echo 'Error Title!';
                die();                
            }
            if($model->alias==''){
                $model->alias = StringHelper::formatUrlKey($model->title);
            }else{
                $model->alias = StringHelper::formatUrlKey($model->alias);
            }
            if ($model->save()) {
                $chk_alias = Aliasurl::AddAliasUrl($model->alias,'blog','view',$model->id,Aliasurl::ALIASURL_BLOG,'addnew');
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
            'allcate' =>$allcate, 
            'destination'=>$destination  
        ));
    }
    
 //update
  public function actionUpdate($id) {   
       $model = $this->loadModel($id);
       $img_old = $model->img;
       $post    = Yii::$app->request->post();
       $user_id = Yii::$app->user->identity->id;
       $destination= Destination::getAllDestination();      
	   if ($model->load($post)) {  
             $model->attributes = $post['Blog'];        
             if($model->destination_ids!=''){
                $model->destination_ids = implode(",",$model->destination_ids);
             }     
             $model->fulltxt     = str_replace("http://authentiktravel.com", "https://authentiktravel.com",$model->fulltxt);
             if (isset($_FILES['Blog']["name"]["img"]) && $_FILES['Blog']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'blog','img');  
             }else{
                $model->img  = $img_old;
             }
             if($model->title==''){
                echo 'Error Title!';
                die();                
            }
            $user     = Yii::$app->user->identity;         
            $model->user_modify = $user->id;          
            $model->last_update = date("Y-m-d H:i:s");   
            if($model->alias==''){
                   $model->alias = StringHelper::formatUrlKey($model->title);
               }else{
                   $model->alias = StringHelper::formatUrlKey($model->alias);
            }
            if ($model->update()) {
               $chk_alias = Aliasurl::AddAliasUrl($model->alias,'blog','view',$model->id,Aliasurl::ALIASURL_BLOG,'update');
               if($chk_alias!=$model->alias){
                   $model->alias = $chk_alias;
                   $model->update();
               }
            }      
          
       }
      $allcate = Blogcate::getAllParentsTree();
      return $this->render('update', array(
            'model' => $model,
            'allcate' =>$allcate,
            'destination'=>$destination 
        ));
    }
public function actionDelete($id) {
         $model = $this->loadModel($id);
         Aliasurl::getDelete($model->alias,'blog');
         $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Blog::findOne($id);
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
                $fileName    = str_replace(" ", "-",$uploadedFile->name);//md5($rnd.$uploadedFile).'.'.$uploadedFile->getExtension();
                if(file_exists($path.$fileName)) {   
                   $fileName = str_replace('.'.$ext,"",StringHelper::formatUrlKey(str_replace($ext,"-",$uploadedFile->name))).'_'.date("Y-m-d").'_'.rand(0,999).'.'.$ext;  
                }
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
                $pathfile_thumb = $path.'150_77/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(150,77))->save($pathfile_thumb ,array('quality' =>60));
                
                $pathfile_thumb = $path.'450_230/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(450,230))->save($pathfile_thumb ,array('quality' =>60));
               
           }
        return $fileName;
   }
}