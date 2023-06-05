<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Review;
use common\models\Account;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\web\Response;
use common\models\Itemimg;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\models\Aliasurl;
use common\models\Settings;
use common\helper\StringHelper;
use common\models\Log;
class ReviewController extends Controller {
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
                        'actions' =>array('index','create','update','delete','delitemmg'),
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Review');     
        return $result;
    } 
 public function actionIndex() {
         $model = new Review();   
         $dataProvider = $model->search(Yii::$app->request->get());        
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Review();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Review'];  
            $model->fulltxt     = str_replace("http://authentiktravel.com", "https://authentiktravel.com",$model->fulltxt);
            if($model->img_default>0){
                $infoitem = Itemimg::getDetailInfo($model->img_default);
                $model->img_default = $infoitem->img;
            }
            $user = Yii::$app->user->identity;
            $model->user_create = $user->id;
            $model->user_modify = $user->id;              
            if($model->alias==''){
                $model->alias = StringHelper::formatUrlKey($model->title);
            }else{
                $model->alias = StringHelper::formatUrlKey($model->alias);
            }
            $model->last_update = date("Y-m-d H:i:s");
            if($model->create_date==''){
                $model->create_date = date("Y-m-d H:i:s");  
            }              
            if ($model->save()) {
                if (isset($_FILES['Review']["name"]["img"]) && $_FILES['Review']["name"]["img"]!='') {
                    $arr = $this->_createImg($model,'itemimgs','img');
                    if(count($arr)){
                        for ($i=0;$i<count($arr);$i++){
                            $namefile = $arr[$i]; 
                            $modelimg = new Itemimg();
                            $modelimg->img         = $namefile;   
                            $modelimg->title       = $model->title;
                            $modelimg->status      = 1;
                            $modelimg->ext_id      = $model->id;
                            $modelimg->type        = "review";
                            $modelimg->last_update = date("Y-m-d H:i:s");
                            $modelimg->create_date = date("Y-m-d H:i:s");
                            $modelimg->save(false);
                            if($i>=4){
                                break;
                            }
                        }
                    }
                }
                $chk_alias = Aliasurl::AddAliasUrl($model->alias,'review','view',$model->id,Aliasurl::ALIASURL_REVIEW,'addnew');
                if($chk_alias!=$model->alias){
                    $model->alias = $chk_alias;
                    $model->update();
                } 
                //tinh toan lai rating
                $data = Review::RatingReview();
                Settings::UpdateRating($data);
                $this->redirect(array('update','id' =>$model->id));
            }
        }
        $account = Account::getListAllAccount();    
        $itemimg = array();  
        $imgdefault = array();// Itemimg::getAllImageDefault();  
        return $this->render('create', array(
            'model' => $model,
            'account' => $account,
            'itemimg' => $itemimg,
            'imgdefault' => $imgdefault  
        ));
    }
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $post  = Yii::$app->request->post();
	   if ($model->load($post)) {  
             $model->attributes = $post['Review'];
             $model->fulltxt     = str_replace("http://authentiktravel.com", "https://authentiktravel.com",$model->fulltxt);
             if($model->img_default>0){
                $infoitem = Itemimg::getDetailInfo($model->img_default);
                $model->img_default = $infoitem->img;
             }
             $user     = Yii::$app->user->identity;            
             $model->user_modify = $user->id;    
             //$model->last_update = date("Y-m-d H:i:s");  
             if($model->alias==''){
                $model->alias = StringHelper::formatUrlKey($model->title);
              }else{
                $model->alias = StringHelper::formatUrlKey($model->alias);
             }
             if ($model->update()) {
                   $chk_alias = Aliasurl::AddAliasUrl($model->alias,'review','view',$model->id,Aliasurl::ALIASURL_REVIEW,'update');
                   if($chk_alias!=$model->alias){
                       $model->alias = $chk_alias;
                       $model->update();
                   }
                   if (isset($_FILES['Review']["name"]["img"]) && $_FILES['Review']["name"]["img"]!='') {
                        $arr = $this->_createImg($model,'itemimgs','img');
                        $n   = Itemimg::getAllImagetypeExt('review',$model->id);                  
                        if(count($arr)){
                            for ($i=0;$i<count($arr);$i++){
                                if(($i+count($n))>=5){
                                    break;
                                }
                                $namefile = $arr[$i]; 
                                $modelimg = new Itemimg();
                                $modelimg->img         = $namefile;   
                                $modelimg->title       = $model->title;
                                $modelimg->status      = 1;
                                $modelimg->ext_id      = $model->id;
                                $modelimg->type        = "review";
                                $modelimg->last_update = date("Y-m-d H:i:s");
                                $modelimg->create_date = date("Y-m-d H:i:s");
                                $modelimg->save(false);
                                
                            }
                        }
                  }
                //tinh toan lai rating
                $data = Review::RatingReview();                
                Settings::UpdateRating($data);   
              }
       } 
       $account = Account::getListAllAccount();
       $itemimg = Itemimg::getAllImagetypeExt('review',$model->id);
       $imgdefault =  array();//Itemimg::getAllImageDefault();
       return $this->render('update', array(
            'model' => $model,
            'account' => $account,
            'itemimg' => $itemimg,
            'imgdefault' => $imgdefault              
        ));
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
                    if (in_array ($file->extension,$ext_img)) {  
                        $fileName = md5($file->baseName).'.'.$file->extension;
                        $arr_name[$i] = $fileName;
                        $pathfile = $path.$fileName;
                        $file->saveAs($pathfile,true);
                        //echo $pathfile;die();
                        $image = Image::getImagine()->open($pathfile);
                        $size  = $image->getSize();
                        $h     = $size->getHeight();
                        $w     = $size->getWidth();
                        if($h>650 || $w>950){                   
                            Image::getImagine()->open($pathfile)->thumbnail(new Box(950,650))->save($pathfile ,array('quality' =>100));
                        }                                 
                        $pathfile_thumb = $path.'250_160/'.$fileName;
                        Image::getImagine()->open($pathfile)->thumbnail(new Box(250,160))->save($pathfile_thumb ,array('quality' =>60));
                        $pathfile_thumb = $path.'350_230/'.$fileName;
                        Image::getImagine()->open($pathfile)->thumbnail(new Box(350,230))->save($pathfile_thumb ,array('quality' =>60));                             
                        $pathfile_thumb = $path.'650_400/'.$fileName;
                        Image::getImagine()->open($pathfile)->thumbnail(new Box(650,400))->save($pathfile_thumb ,array('quality' =>100));
                       
                        $i++;
                    }
                }
           }
        return $arr_name;
}
public function actionDelete($id) {
         $model = $this->loadModel($id);
         $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Review::findOne($id); 
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;        
    }
 //Deletel itemimg
public function actionDelitemmg() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result['data'] = array();
        $result['error']= 0;
        $item_id = Yii::$app->request->post('item_id',0);
        $ext_id  = Yii::$app->request->post('ext_id',0);       
        if($item_id>0 && $ext_id >0){
            $model = Itemimg::getDetailItemimg('review',$item_id);
            if(!empty($model)){
                $model->delete();
                $result['error']     = 1;
            }            
        }
        return $result;
}     
}