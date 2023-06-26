<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\User;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller {
    public $layout='main';
    public $enableCsrfValidation = false;
    public function behaviors() {
        return array(
            'access' =>  array(
                'class' => AccessControl::className(),
                'rules' => array(
                   array(
                        'actions' => array('login','error'),
                        'allow' => true,
                    ),
                    array(
                        'actions' =>array('logout','index','update','uploadimg','language','login'),
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
        return $this->render('index');
    }
   
    public function actionLogin()  {        
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }       
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {          
            $user     = Yii::$app->user->identity;
            $user_id  = $user->id;
            $model_user = User::findOne($user_id);           
            $model_user->last_update = date("Y-m-d H:i:s");
            $model_user->ip = Yii::$app->getRequest()->getUserIP();
            $model_user->update(false); 
            return $this->redirect(array('category/index')); 
        } else {           
            return $this->render('login', array(
                   'model' => $model
               )
            );
        }
    }
    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->goHome();
    }
     public function actionError(){
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error',array('exception' => $exception));
        }
    }
//upload image from ckeditor
public function actionUploadimg() {  
        $uploadedFile = UploadedFile::getInstanceByName('upload'); 
        $mime = \yii\helpers\FileHelper::getMimeType($uploadedFile->tempName);
        $file = $uploadedFile->name;//time()."_".$uploadedFile->name;
        $url  = Yii::$app->urlManager->createAbsoluteUrl('/media/ckeditor/'.$file);
        $url  = str_replace("backend/", "",$url);
        $uploadPath = substr(Yii::$app->basePath,0,-7).'media/ckeditor/'.$file; //Yii::getAlias('@webroot').'/media/ckeditor/'.$file;
        //extensive suitability check before doing anything with the file�
        if ($uploadedFile==null){
           $message = "No file uploaded.";
        }else if ($uploadedFile->size == 0) {
           $message = "The file is of zero length.";
        }else if ($mime!="image/jpeg" && $mime!="image/png" && $mime!="image/jpg" && $mime!="application/pdf") {
           $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
        }else if ($uploadedFile->tempName==null)    {
           $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
        }else {
          $message = 'Upload was successful';//$uploadPath;          
          $move = $uploadedFile->saveAs($uploadPath);
          if(!$move){
             $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
          } 
        }
        $funcNum = $_GET['CKEditorFuncNum'] ;
        //die($url);
       if($mime=="application/pdf"){
           // $url .='/'.$file;
            //http://localhost/authentikvietnam.com/media/ckeditor/1480649469_note.pdf
           // echo 'Copy link paste to Url: '.$url;
           // echo "<script type='text/javascript'>document.getElementById('cke_112_textInput').innerHTML ='"+$url+"';</script>";        
           //echo "<script type='text/javascript'>document.getElementById('cke_112_textInput').innerHTML ='"+$url+"';</script>";
           echo '<div style="height:40px;padding-bottom: 14px;display: inline-block;"><input style="width:320px !important;" type="text" id="linkfile" value="'.$url.'" /></div>';
           // die();
        } 
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";        
    } 
//  die(1);
    
}
