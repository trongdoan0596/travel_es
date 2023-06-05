<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\imagine\Image;
use common\models\Itemimg;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\helper\StringHelper;
use common\models\Log;
class ItemimgController extends Controller {
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Itemimg');     
        return $result;
    }
 public function actionIndex() {
         $model = new Itemimg();   
         $dataProvider = $model->searchBackend(Yii::$app->request->get());
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Itemimg();
        $user_id = Yii::$app->user->identity->id;
        $post    = Yii::$app->request->post();
	    if ($model->load($post)) {  
	         if (isset($_FILES['Itemimg']["name"]["img"]) && $_FILES['Itemimg']["name"]["img"]!='') {
                    $arr = $this->_createImg($model,'itemimgs','img');
                    if(count($arr)){
                        for ($i=0;$i<count($arr);$i++){
                            $namefile = $arr[$i]; 
                            $modelimg = new Itemimg();
                            $modelimg->img         = $namefile;   
                            $modelimg->title       = $model->title;
                            $modelimg->status      = 1;
                            $modelimg->type        = $model->type;
                            $modelimg->ext_id      = 0;
                            $modelimg->last_update = date("Y-m-d H:i:s");
                            $modelimg->create_date = 0;date("Y-m-d H:i:s");
                            $modelimg->save(false);
                        }
                    }
             }               
           $this->redirect(array('index'));
        }
        return $this->render('create', array(
            'model' => $model            
        ));
    }
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $post      = Yii::$app->request->post();
       $img_old = $model->img;
       $user_id = Yii::$app->user->identity->id;
	   if ($model->load($post)) {  
            $model->attributes  = $post['Itemimg'];
            $model->img         = $img_old;
            $model->last_update = date("Y-m-d H:i:s");
            $model->update(false);
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
//upload file
 public function _createImg($model = null, $folder = null,$img = null) { 
           $path    = substr(Yii::$app->basePath,0,-7).'media/'.$folder.'/'; 
           $files   = UploadedFile::getInstances($model,$img);
           $ext_img = array ("jpg", "gif", "png");
           $arr_name= array();
           if(!empty($files)){
                $i=0;
                foreach ($files as $file) {
                    $ext = strtolower($file->extension);
                    if (in_array ($ext,$ext_img)) {  
                        $name = str_replace('.'.$ext,"",StringHelper::formatUrlKey(str_replace($ext,"-",$file->baseName))).'.'.$ext; 
                        if(file_exists($path.$name)) {   
                            $name = str_replace('.'.$ext,"",StringHelper::formatUrlKey(str_replace($ext,"-",$file->baseName))).'_'.date("Y-m-d").'_'.rand(0,999).'.'.$ext;  
                        }
                        $fileName = str_replace(" ","-",strtolower($name));//md5($file->baseName).'.'.$ext;
                        $arr_name[$i] = $fileName;
                        $pathfile = $path.$fileName;
                      
                        $file->saveAs($pathfile,true);
                        $size     = @getimagesize($pathfile);
                        if(count($size)){
                            $w  = $size[0];
                            $h  = $size[1];
                            if($w>950 || $h>600){
        	                   Image::thumbnail($pathfile,650,400)->save($pathfile);
                            }
                        }    
                        $pathfile_thumb = $path.'550_350/'.$fileName;
                        Image::getImagine()->open($pathfile)->thumbnail(new Box(550,350))->save($pathfile_thumb ,array('quality' =>100));                                  
                        $pathfile_thumb = $path.'250_160/'.$fileName;
                        Image::getImagine()->open($pathfile)->thumbnail(new Box(250,160))->save($pathfile_thumb ,array('quality' =>100));
                        $pathfile_thumb = $path.'350_230/'.$fileName;
                        Image::getImagine()->open($pathfile)->thumbnail(new Box(350,230))->save($pathfile_thumb ,array('quality' =>100));                             
                        $pathfile_thumb = $path.'650_400/'.$fileName;
                        Image::getImagine()->open($pathfile)->thumbnail(new Box(650,400))->save($pathfile_thumb ,array('quality' =>100));
                       
                        $i++;
                    }
                }
           }
        return $arr_name;
}
public function loadModel($id) {       
        $model = Itemimg::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    } 
/********End class**********/      
}