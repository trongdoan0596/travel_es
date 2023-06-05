<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Menu;
use common\models\Category;
use common\models\Tourcate;
use common\models\Article;
use common\models\Tour;
use common\models\Blogcate;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\helper\StringHelper;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use common\models\Log;
class MenuController extends Controller {
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
                        'actions' =>array('index','create','update','delete','changetype'),
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Menu');     
        return $result;
    }
 public function actionIndex() {      
         $model = new Menu();   
         $dataProvider = $model->search(Yii::$app->request->get());    
         $allmenu = Menu::getAllParentsTreeFilter();     
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider,'allmenu' =>$allmenu));
    }
  //create
  public function actionCreate() {
        $model = new Menu();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Menu'];
            
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
            if (isset($_FILES['Menu']["name"]["img"]) && $_FILES['Menu']["name"]["img"]!='') {
                $model = $this->_createImg($model,'menu');
            }
            if($model->ext_id>0){
                  $infoext ='';
                  switch ($model->type) {
                            case 1:
                                //Article
                                $infoext = Article::getDetailArticle($model->ext_id);                                
                                break;
                            case 2:
                                //Article Category
                                $infoext = Category::getDetailCategory($model->ext_id);
                                break;
                            case 3:
                                 //Tour
                                 $infoext = Tour::getDetailTour($model->ext_id);
                                break;
                            case 4:
                                //Tour Category
                                $infoext = Tourcate::getDetailTourCate($model->ext_id);
                            break;   
                            case 5:
                                //Blog Category
                                $infoext = Blogcate::getDetailBlogcate($model->ext_id);
                            break;  
                  }
                  if(!empty($infoext)){
                        if(trim($infoext->alias)!=''){
                               $model->alias   = StringHelper::formatUrlKey($infoext->alias); 
                          }else{
                               $model->alias  = StringHelper::formatUrlKey($infoext->title); 
                        }                                         
                  } 
             }
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        $allmenu = Menu::getAllParentsTree();
        $ext_id_arr = array();
        return $this->render('create', array(
            'model' => $model,
            'allmenu' =>$allmenu,
            'ext_id_arr'=>$ext_id_arr
        ));
    }
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $img_old = $model->img;
       $post  = Yii::$app->request->post();
	   if ($model->load($post) && $id>1) {  
             $model->attributes = $post['Menu'];                  
             $user    = Yii::$app->user->identity;          
             $model->user_modify = $user->id;             
             $model->last_update = date("Y-m-d H:i:s");
             if (isset($_FILES['Menu']["name"]["img"]) && $_FILES['Menu']["name"]["img"]!='') {
                $model = $this->_createImg($model,'menu');
             }else{
                $model->img = $img_old;
             }
             if($model->ext_id>0){
                  $infoext ='';
                  switch ($model->type) {
                            case 1:
                                //Article
                                $infoext = Article::getDetailArticle($model->ext_id);                                
                                break;
                            case 2:
                                //Article Category
                                $infoext = Category::getDetailCategory($model->ext_id);
                                break;
                            case 3:
                                 //Tour
                                 $infoext = Tour::getDetailTour($model->ext_id);
                                break;
                            case 4:
                                //Tour Category
                                $infoext = Tourcate::getDetailTourCate($model->ext_id);
                            break;    
                           case 5:
                                //Blog Category
                                $infoext = Blogcate::getDetailBlogcate($model->ext_id);
                            break;   
                  }
                  if(!empty($infoext)){
                        if(trim($infoext->alias)!=''){
                               $model->alias   = StringHelper::formatUrlKey($infoext->alias); 
                          }else{
                               $model->alias  = StringHelper::formatUrlKey($infoext->title); 
                        }                                         
                  } 
             }
             $model->update();
       } 
       $ext_id_arr[0] = '--Select--';
       switch ($model->type) {
                case 1:
                    //Article
                    $rows = Article::getListArticle();
                    if(!empty($rows)){
                         foreach ($rows as $row) { 
                            $ext_id_arr[$row->id] = $row->title;
                         }
                      }
                    break;
                case 2:
                    //Article Category
                    $rows = Category::getAllParentsTree();
                    $tmp = '';
                    if(!empty($rows)){  
                        foreach ($rows as $key => $value) {
                            $ext_id_arr[$key] = $value;
                        }
                      }
                    break;
                case 3:
                     //Tour
                    $rows = Tour::getListTour();                       
                    if(!empty($rows)){
                         foreach ($rows as $row) { 
                            $ext_id_arr[$row->id] = $row->title;
                         }
                      }                        
                    break;
                case 4:
                    //Tour Category
                    $rows = Tourcate::getAllParentsTree();
                    $tmp = '';
                    if(!empty($rows)){     
                        foreach ($rows as $key => $value) {
                            $ext_id_arr[$key] = $value;
                        }                        
                     }                     
                break;  
                 case 5:
                    //Blog Category
                    $rows = Blogcate::getAllParentsTree();
                    $tmp = '';
                    if(!empty($rows)){                          
                        foreach ($rows as $key => $value) {
                            $ext_id_arr[$key] = $value;
                        } 
                                 
                      }                     
                break;      
            }
      
      $allmenu = Menu::getAllParentsTree();
      return $this->render('update', array(
            'model' => $model,
            'allmenu' =>$allmenu,
            'ext_id_arr'=>$ext_id_arr
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
        $model = Menu::findOne($id);             
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    } 
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
 //.Menu.ChangeType
  public function actionChangetype() {       
           $result['error']= 1;
           $result['msg']  = '';
           $result['data'] = '';
           $type_id  = Yii::$app->request->post('type_id',0);
           switch ($type_id) {
                    case 1:
                        //Article
                        $rows = Article::getListArticle();
                        $tmp = '';
                        if(!empty($rows)){
                             foreach ($rows as $row) { 
                                $tmp .= '<option value="'.$row->id.'">'.$row->title.'</option>';//array('id'=>$row->id,'name'=>$row->name);
                             }
                          }
                         $result['data'] = $tmp;  
                        break;
                    case 2:
                        //Article Category
                        $rows = Category::getAllParentsTree();
                        $tmp = '';
                        if(!empty($rows)){
                              while (list ($k, $v) = each ($rows)) {
                                 $tmp .= '<option value="'.$k.'">'.$v.'</option>';
                              }                     
                          }
                         $result['data'] = $tmp;  
                        break;
                    case 3:
                         //Tour
                        $rows = Tour::getListTour();
                        $tmp = '';
                        if(!empty($rows)){
                             foreach ($rows as $row) { 
                                $tmp .= '<option value="'.$row->id.'">'.$row->title.'</option>';
                             }
                          }
                         $result['data'] = $tmp;  
                        break;
                    case 4:
                        //Tour Category
                        $rows = Tourcate::getAllParentsTree();
                        $tmp = '';
                        if(!empty($rows)){
                            while (list ($k, $v) = each ($rows)) {
                               $tmp .= '<option value="'.$k.'">'.$v.'</option>';
                            }
                          }
                         $result['data'] = $tmp; 
                        break; 
                    case 5:
                        //Blog Category
                        $rows = Blogcate::getAllParentsTree();
                        $tmp = '';
                        if(!empty($rows)){
                            while (list ($k, $v) = each ($rows)) {
                               $tmp .= '<option value="'.$k.'">'.$v.'</option>';
                            }
                          }
                         $result['data'] = $tmp; 
                        break;            
                }
        echo json_encode($result,true);
        exit(1);
    }    
}