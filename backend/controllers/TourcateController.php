<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Tourcate;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use common\models\Tour;
use common\models\Country;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\web\Response;
use common\models\Aliasurl;
use common\helper\StringHelper;
use common\models\Log;
class TourcateController extends Controller {
    public $layout='main';
    public $enableCsrfValidation = false;
    public function Init() {
           if(Yii::$app->user->getIsGuest()){
               return Yii::$app->response->redirect(array('site/login'));     
               die('Error!');
           }
          /* $lang = Yii::$app->request->cookies->getValue('language');
           if(empty($lang)){
               $lang = Yii::$app->request->get('language','');
           }          
           Yii::$app->language = $lang;
           */
     }
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
                        'actions' =>array('index','create','update','delete','deleimgmain','alias'),
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Tourcate');     
        return $result;
    }    
public function actionAlias() {
        $rows = Tourcate::find()->all();
        if(!empty($rows)){
            foreach($rows as $row){
                if($row->alias!=''){
                    $row->alias = StringHelper::formatUrlKey($row->alias);
                }else{
                    $row->alias = StringHelper::formatUrlKey($row->title);
                }
                $row->update();
                Aliasurl::AddAliasUrl($row->alias,'tourcate','view',$row->id,Aliasurl::ALIASURL_TOUR_CATE,'addnew');
            }
        }
        die('ok');
        return $this->render('index');
    }
 public function actionIndex() {
         $model = new Tourcate();   
         $dataProvider = $model->search(Yii::$app->request->get());
         $countrys = Country::getCountry();
         $allcate  = Tourcate::getAllParentsTree();
     return $this->render('index',array('model' =>$model,'allcate'=>$allcate,'countrys' =>$countrys,'dataProvider'=>$dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Tourcate();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Tourcate'];
            if (isset($_FILES['Tourcate']["name"]["img"]) && $_FILES['Tourcate']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'tourcate','img');
            }           
            $user     = Yii::$app->user->identity;
            $model->user_id    = $user->id;
            $model->user_modify = $user->id;
            $model->country_id = 232;//mac dinh vn
            $lang = Yii::$app->request->cookies->getValue('language');	   
            if(empty($lang)){
               $lang = Yii::$app->request->get('language','');
            }  
            $model->lang = $lang;
            $model->create_date = date("Y-m-d H:i:s");
            $model->last_update = date("Y-m-d H:i:s");
            if($model->alias==''){
                $model->alias = StringHelper::formatUrlKey($model->title);
            }else{
                $model->alias = StringHelper::formatUrlKey($model->alias);
            }
            if ($model->save()) {
                 Tourcate::getPath($arr,$model->id);
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
                $chk_alias = Aliasurl::AddAliasUrl($model->alias,'tourcate','view',$model->id,Aliasurl::ALIASURL_TOUR_CATE,'addnew');
                if($chk_alias!=$model->alias){
                    $model->alias = $chk_alias;
                    $model->update();
                }
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        $country   = Country::getCountry();
        $allcate  = Tourcate::getAllParentsTree();
        return $this->render('create', array(
            'model' => $model,
            'country' =>$country,  
            'allcate' =>$allcate,
        ));
    }
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $img_old = $model->img;
       $post  = Yii::$app->request->post();
	   if ($model->load($post) && $id>1) {  
             $model->attributes = $post['Tourcate'];
             if (isset($_FILES['Tourcate']["name"]["img"]) && $_FILES['Tourcate']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'tourcate','img');
             }else{
                $model->img = $img_old;
             }            
             $model->country_id = 232;//mac dinh vn
             $user     = Yii::$app->user->identity;
             $model->user_modify = $user->id;
             $model->last_update = date("Y-m-d H:i:s");
             Tourcate::getPath($arr,$model->id);
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
             if($model->update()){
                   $chk_alias = Aliasurl::AddAliasUrl($model->alias,'tourcate','view',$model->id,Aliasurl::ALIASURL_TOUR_CATE,'update');
                   if($chk_alias!=$model->alias){
                       $model->alias = $chk_alias;
                       $model->update();
                   }
             } 
             $model->update();
       }      
      $country  = Country::getCountry();
      $allcate  = Tourcate::getAllParentsTree();
      return $this->render('update', array(
            'model' => $model,
            'country' =>$country,
            'allcate' =>$allcate,
        ));
    }
//upload file
 public function _createImg($model = null, $folder = null,$img = null) { 
           //Yii::$app->basePath;//?D:\xampp\htdocs\authentik-travel.com\backend
           $path         = substr(Yii::$app->basePath,0,-7).'media/'.$folder.'/'; 
           $rnd          = rand(0,9999);
           $uploadedFile = UploadedFile::getInstance($model,$img);
           $ext          = strtolower($uploadedFile->getExtension());
           $ext_img = array ("jpg", "gif", "png");
           $fileName='';
           if (in_array ($ext,$ext_img)) {  
                $fileName     = md5($rnd.$uploadedFile).'.'.$uploadedFile->getExtension();
                $uploadedFile->saveAs($path.$fileName,true);    
           }
        return $fileName;
}
 //Admin.Tour.deleimgmain
    public function actionDeleimgmain() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result['msg']    = '!';
        $result['error']  = 0;
        $result['data']   = '';
        $result['update'] = 0; 
        $id  = Yii::$app->request->post('id',0);        
        if($id>0){
             $model = Tourcate::getDetailTourCate($id);              
             if(!empty($model)){    
                $model->img=""; 
                $model->update();
                $result['error']  = 1;
             }            
        }
       return $result; 
   }
//view
public function actionView($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(array('view', 'id' => $model->id));
        } else {
            return $this->render('view', array('model' => $model));
        }
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
        $model = Tourcate::findOne($id);              
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    } 
}