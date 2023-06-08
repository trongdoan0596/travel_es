<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\components\AccessRule;
use common\models\Log;
class UserController extends Controller {
    public $layout='main';
    // public function behaviors() {
    //     return array(
    //         'access' =>  array(
    //             'class' => AccessControl::className(),
    //             'ruleConfig' => array(
    //                                 'class' => AccessRule::className(),
    //                             ),
    //             'only' => array('index','create','update','myupdate'),
    //             'rules' => array(
    //                array(
    //                     'actions' => array('error'),
    //                     'allow' => true,
    //                 ),
    //                 array(
    //                     'actions' =>array('index','myupdate'),
    //                     'allow' => true,
    //                     'roles' =>array('@'),
    //                 ),
    //                 array(
    //                     'actions' =>array('create','update'),
    //                     'allow' => true,
    //                     'roles' =>array(User::ROLE_ADMIN),
    //                 ), 
    //               /*  array(
    //                     'actions' =>array('delete'),
    //                     'allow' => true,
    //                     'roles' =>array(User::ROLE_ADMIN),
    //                 ), */
    //             ),
    //            // 'denyCallback' => function ($rule, $action) {
    //              //   throw new \Exception('You are not allowed to access this page');
    //           //  }
    //         ),
    //         'verbs' => array(
    //             'class' => VerbFilter::className(),
    //             'actions' =>  array(
    //                 'logout' => array('post'),
    //             ),
    //         ),
    //     );
    // }

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
        Log::AddLog("add",$id,0,'',$this->action->id,'User');     
        return $result;
    }   
 public function actionIndex() {
         $model = new User();   
         $dataProvider = $model->search(array());
        return $this->render('index',array('model' => $model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new User();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['User'];
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->ip          = Yii::$app->getRequest()->getUserIP(); 
            $model->last_update = date("Y-m-d H:i:s");
            $model->created     = date("Y-m-d H:i:s");
            if (isset($_FILES['User']["name"]["img"]) && $_FILES['User']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'user','img');  
            }
            if ($model->save(false)) {
                $this->redirect(array('update', 'id' =>$model->id));
            }
        }
        return $this->render('create', array(
            'model' => $model,
        ));
    }
 //update
  public function actionUpdate($id) {
       $model   = $this->loadModel($id);
       $password_hash_old = $model->password_hash;
       $img_old = $model->img;
       $post  = Yii::$app->request->post();
       if($model->load($post)) {  
            $model->attributes  = $post['User'];
            if($model->password_hash != $password_hash_old){
               $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            }
            $model->last_update = date("Y-m-d H:i:s");
            $model->ip          = Yii::$app->getRequest()->getUserIP(); 
            if (isset($_FILES['User']["name"]["img"]) && $_FILES['User']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'user','img');  
            }else{
                $model->img = $img_old;
            }
            if ($model->save(false)) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
      return $this->render('update', array(
            'model' => $model,       
        ));
    }  
 //myupdate   
 public function actionMyupdate() {   
       $user = Yii::$app->user->identity;   
       $id   = $user->id;    
       $model   = $this->loadModel($id);
       $password_hash_old = $model->password_hash;
       $img_old = $model->img;
       $post  = Yii::$app->request->post();
       if($model->load($post)) {  
            $model->attributes  = $post['User'];
            if($model->password_hash != $password_hash_old){
               $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            }
            $model->last_update = date("Y-m-d H:i:s");
            $model->ip          = Yii::$app->getRequest()->getUserIP(); 
            if (isset($_FILES['User']["name"]["img"]) && $_FILES['User']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'user','img');  
            }else{
                $model->img = $img_old;
            }
            if ($model->save(false)) {
                $this->redirect(array('myupdate'));
            }
        }
      return $this->render('update', array(
            'model' => $model,       
        ));
    }
//delete
public function actionDelete($id) {
        /*$model = $this->loadModel($id);
        $model->delete();
        return $this->redirect(array('index'));
        */
    }
public function loadModel($id) {
        $model = User::findOne($id);
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
                $pathfile_thumb = $path.'250_250/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(250,250))->save($pathfile_thumb ,array('quality' =>100));
           }
        return $fileName;
   }           
}
