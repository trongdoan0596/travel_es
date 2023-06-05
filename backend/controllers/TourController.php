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
use common\models\Tour;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use common\models\Tourdetail;
use common\models\Days;
use common\models\Region;
use common\models\Tourcate;
use common\models\Tourextentions;
use common\models\Country;
use common\models\Itemimg;
use common\models\Destination;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\models\Aliasurl;
use common\helper\StringHelper;
use common\models\Log;
class TourController extends Controller {
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
                        'actions' =>array('index','create','update','delete','addnewday','delenewday','editday',                                          
                                          'addext','deleext','editext','deleimg','deleimgmain','itemimg','searchimgitem',
                                          'alias'
                                  ),
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

    public function actions(){
        return array('error' => array('class' => 'yii\web\ErrorAction'));
    }
    public function afterAction($action, $result){
        $result = parent::afterAction($action, $result);
        $id = 0;        
        $user_id = Yii::$app->user->identity->id;
        if($this->action->id=='update'){
           $id = $this->action->controller->actionParams['id'];  
        }
        Log::AddLog("add",$id,0,'',$this->action->id,'Tour');     
        return $result;
    }
    public function actionAlias() {
        $rows = Tour::find()->all();
        if(!empty($rows)){
            foreach($rows as $row){
                if($row->alias!=''){
                    $row->alias = StringHelper::formatUrlKey($row->alias);
                }else{
                    $row->alias = StringHelper::formatUrlKey($row->title);
                }
                $row->update();
                Aliasurl::AddAliasUrl($row->alias,'tour','view',$row->id,Aliasurl::ALIASURL_BLOG,'addnew');
            }
        }
        die('ok');
        return $this->render('index');
    }
    public function actionIndex() {
         $model = new Tour();   
         $dataProvider = $model->search(Yii::$app->request->get());
         $citys    = Region::getRegion();
         $catetour = Tourcate::getCateTourparent(1);//danh muc voi parent_id=1
        return $this->render('index',array('model' =>$model,'catetour' =>$catetour,'citys' =>$citys,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Tour();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Tour'];
            if($model->title==''){
                echo 'Error Title!';
                die();                
            }
            if($model->country_ids!='') $model->country_ids = implode(",",$model->country_ids);
            if($model->destination_ids!='')  $model->destination_ids = implode(",",$model->destination_ids);
            if (isset($_FILES['Tour']["name"]["img"]) && $_FILES['Tour']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'tour','img');               
             }
            //image 1
             if (isset($_FILES['Tour']["name"]["img1"]) && $_FILES['Tour']["name"]["img1"]!='') {
                $model->img1 = $this->_createHomeImg($model,'tour/340_270','img1');               
             }
             //image 2
             if (isset($_FILES['Tour']["name"]["img2"]) && $_FILES['Tour']["name"]["img2"]!='') {
                $model->img2 = $this->_createHomeImg($model,'tour/430_270','img2');               
             }
             //image 3
             if (isset($_FILES['Tour']["name"]["img3"]) && $_FILES['Tour']["name"]["img3"]!='') {
                $model->img3 = $this->_createHomeImg($model,'tour/610_270','img3');               
             }
             if (isset($_FILES['Tour']["name"]["pdf"]) && $_FILES['Tour']["name"]["pdf"]!='') {
                $model->pdf = $this->_createPdf($model,'tour/pdf');
             } 
             if (isset($_FILES['Tour']["name"]["imgmap"]) && $_FILES['Tour']["name"]["imgmap"]!='') {
                $model->imgmap = $this->_createMapImg($model,'tour/imgmap','imgmap');
             }   
            $user     = Yii::$app->user->identity;
            $model->user_id    = $user->id;
            $model->user_modify = $user->id;   
            $model->create_date = date("Y-m-d H:i:s");           
            $model->last_update = date("Y-m-d H:i:s");
            if($model->alias==''){
                $model->alias = StringHelper::formatUrlKey($model->title);
            }else{
                $model->alias = StringHelper::formatUrlKey($model->alias);
            }
            if ($model->save()) {
                $chk_alias = Aliasurl::AddAliasUrl($model->alias,'tour','view',$model->id,Aliasurl::ALIASURL_TOUR,'addnew');
                if($chk_alias!=$model->alias){
                    $model->alias = $chk_alias;
                    $model->update();
                }
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
       
        $catetour = Tourcate::getAllParentsTree();
        $allcity  = Region::getRegion();//danh sach cac city
        $tourdetail = array();
        $days       = array();//Days::getDays();
        $alltour    = array();
        $alltourext = array();
        $country    = Country::getCountry();
        $destination= Destination::getAllDestination();
        return $this->render('create', array(
            'model' => $model,          
            'catetour' =>$catetour,
            'allcity' =>$allcity,  
            'tourdetail' =>$tourdetail, 
            'days' =>$days,             
            'alltour' =>$alltour,
            'alltourext' =>$alltourext,
            'country' =>$country,
            'destination' =>$destination                
        ));
    }
 //update
  public function actionUpdate($id) {
       $model   = $this->loadModel($id);
       $img_old = $model->img;
       $img_1   = $model->img1;
       $img_2   = $model->img2;
       $img_3   = $model->img3;
       $pdf_old    = $model->pdf;
       $imgmap_old = $model->imgmap;
       $post  = Yii::$app->request->post();
	   if ($model->load($post)) {  
             $model->attributes  = $post['Tour'];
             if($model->title==''){
                echo 'Error Title!';
                die();                
             }             
             if($model->country_ids!='') $model->country_ids = implode(",",$model->country_ids);
             if($model->destination_ids!='')  $model->destination_ids = implode(",",$model->destination_ids);
             if (isset($_FILES['Tour']["name"]["img"]) && $_FILES['Tour']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'tour','img');               
             }else{
               $model->img  = $img_old;
             }
             //image 1
             if (isset($_FILES['Tour']["name"]["img1"]) && $_FILES['Tour']["name"]["img1"]!='') {
                $model->img1 = $this->_createHomeImg($model,'tour/340_270','img1');               
             }else{
                $model->img1  = $img_1;
             }
             //image 2
             if (isset($_FILES['Tour']["name"]["img2"]) && $_FILES['Tour']["name"]["img2"]!='') {
                $model->img2 = $this->_createHomeImg($model,'tour/430_270','img2');               
             }else{
                $model->img2  = $img_2;
             }
             //image 3
             if (isset($_FILES['Tour']["name"]["img3"]) && $_FILES['Tour']["name"]["img3"]!='') {
                $model->img3 = $this->_createHomeImg($model,'tour/610_270','img3');               
             }else{
                $model->img3  = $img_3;
             }
             
             if (isset($_FILES['Tour']["name"]["pdf"]) && $_FILES['Tour']["name"]["pdf"]!='') {
                $model->pdf = $this->_createPdf($model,'tour/pdf');
             }else{
                $model->pdf  = $pdf_old;
             }  
             if (isset($_FILES['Tour']["name"]["imgmap"]) && $_FILES['Tour']["name"]["imgmap"]!='') {
                $model->imgmap = $this->_createMapImg($model,'tour/imgmap','imgmap');
             }else{
                $model->imgmap  = $imgmap_old;
             }
             $user     = Yii::$app->user->identity;            
             $model->user_modify = $user->id;    
             $model->last_update = date("Y-m-d H:i:s");
             if($model->alias==''){
               $model->alias = StringHelper::formatUrlKey($model->title);
             }else{
               $model->alias = StringHelper::formatUrlKey($model->alias);
             }
             if($model->update()){
                   $chk_alias = Aliasurl::AddAliasUrl($model->alias,'tour','view',$model->id,Aliasurl::ALIASURL_TOUR,'update');
                   if($chk_alias!=$model->alias){
                       $model->alias = $chk_alias;
                       $model->update();
                   }
             }
       }     
      $catetour   = Tourcate::getAllParentsTree();
      $allcity    = Region::getRegion();//danh sach cac city
      $tourdetail = Tourdetail::GetTourdetail($id);
      $days       = Days::getDays();
      $alltour    = Tour::getListTour();
      $alltourext = Tourextentions::GetTourExt($id);
      $country    = Country::getCountry();
      $destination= Destination::getAllDestination();
      return $this->render('update', array(
            'model' => $model,
            'catetour' =>$catetour, 
            'allcity' =>$allcity,
            'tourdetail' =>$tourdetail, 
            'days' =>$days, 
            'alltour' =>$alltour,
            'alltourext' =>$alltourext,
            'country' =>$country,
            'destination' =>$destination      
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
                $name = str_replace('.'.$ext,"",StringHelper::formatUrlKey(str_replace($ext,"-",$uploadedFile->name))).'_'.date("Y-m-d").'.'.$ext; 
                if (file_exists($path.$name)) {   
                     $name = str_replace('.'.$ext,"",StringHelper::formatUrlKey(str_replace($ext,"-",$uploadedFile->name))).'_'.date("Y-m-d").'_'.rand(0,999).'.'.$ext;  
                }               
                $fileName = str_replace(" ","-",strtolower($name));//md5($rnd.$uploadedFile).'.'.$uploadedFile->getExtension();
                $uploadedFile->saveAs($path.$fileName,true); 
                $pathfile = $path.$fileName;                
                $pathfile_thumb = $path.'370_221/'.$fileName;
                Image::getImagine()->open($pathfile)->thumbnail(new Box(370,221))->save($pathfile_thumb ,array('quality' =>60));
                //$pathfile_thumb = $path.'340_270/'.$fileName;
               // Image::getImagine()->open($pathfile)->thumbnail(new Box(340,270))->save($pathfile_thumb ,array('quality' =>60));
                //$pathfile_thumb = $path.'430_270/'.$fileName;
                //Image::getImagine()->open($pathfile)->thumbnail(new Box(430,270))->save($pathfile_thumb ,array('quality' =>60));
                //$pathfile_thumb = $path.'610_270/'.$fileName;
                //Image::getImagine()->open($pathfile)->thumbnail(new Box(610,270))->save($pathfile_thumb ,array('quality' =>100));
               
                
           }
        return $fileName;
}
 public function _createHomeImg($model = null, $folder = null,$img = null) { 
           //Yii::$app->basePath;//?D:\xampp\htdocs\authentik-travel.com\backend
           $path         = substr(Yii::$app->basePath,0,-7).'media/'.$folder.'/'; 
           //$rnd          = rand(0,9999);
           $uploadedFile = UploadedFile::getInstance($model,$img);
           $ext          = strtolower($uploadedFile->getExtension());
           $ext_img = array ("jpg", "gif", "png");
           $fileName='';
           if (in_array ($ext,$ext_img)) {  
                $fileName     = str_replace(" ", "-",$uploadedFile->name);//$fileName = md5($rnd.$uploadedFile).'.'.$uploadedFile->getExtension();
                $uploadedFile->saveAs($path.$fileName,true);
           }
        return $fileName;
}
 public function _createMapImg($model = null, $folder = null,$img = null) { 
           //Yii::$app->basePath;//?D:\xampp\htdocs\authentik-travel.com\backend
           $path         = substr(Yii::$app->basePath,0,-7).'media/'.$folder.'/'; 
           //$rnd        = rand(0,9999);
           $uploadedFile = UploadedFile::getInstance($model,$img);
           $ext          = strtolower($uploadedFile->getExtension());
           $ext_img = array ("jpg", "gif", "png");
           $fileName='';
           if (in_array ($ext,$ext_img)) {  
                $fileName     = $uploadedFile->name;//md5($rnd.$uploadedFile).'.'.$uploadedFile->getExtension();
                $uploadedFile->saveAs($path.$fileName,true);                
           }
        return $fileName;
}
 public function _createPdf($model = null, $folder = null) { 
           $path         = substr(Yii::$app->basePath,0,-7).'media/'.$folder.'/'; 
           $rnd          = rand(0,9999);
           $uploadedFile = UploadedFile::getInstance($model,'pdf');
           $ext          = strtolower($uploadedFile->getExtension());
           $ext_img = array ("pdf");
           $fileName = '';
           if (in_array ($ext,$ext_img)) {  
                $fileName     = md5($rnd.$uploadedFile).'.'.$uploadedFile->getExtension();
                $uploadedFile->saveAs($path.$fileName,true); 
           }
        return $fileName;
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
         $model = $this->loadModel($id);
         $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Tour::findOne($id);
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    } 
 /***********************/
 //Admin.Tour.Editday   
 public function actionEditday() {
        $result = array();
        $tour_id   = Yii::$app->request->post('tour_id',0); 
        $day_id    = Yii::$app->request->post('day_id',0);
        $model = Tourdetail::GetInfoTourdetail($tour_id,$day_id);
        if(!empty($model)){
             $result['id']         = $model->id;
             $result['day_id']     = $model->day_id;
             $result['title']      = $model->title;
             $result['fulltxt']    = $model->fulltxt; 
             $result['img']        = $model->img; 
        }                  
        echo json_encode($result,true);
        exit(1);
    }   
 //Admin.Tour.Delenewday
 public function actionDelenewday() {
        $result ='';
        $tour_id   = Yii::$app->request->post('tour_id',0); 
        $day_id    = Yii::$app->request->post('day_id',0);
        if($tour_id>0 && $day_id>0){
             $chk = Tourdetail::DelTourdetail($tour_id,$day_id);
             if($chk==1) $result='Delete Ok.';
        }
        echo $result;        
        exit(1);
    } 
//Admin.Tour.Addnewday
public function actionAddnewday() {
        $tour_id   = Yii::$app->request->post('tour_id',0); 
        $day_id    = Yii::$app->request->post('day_id',0);
        $titleday  = Yii::$app->request->post('titleday','');
        $txtday    = Yii::$app->request->post('txtday',''); 
        $imgroom   = Yii::$app->request->post('imgroom',''); 
        $tourdetai_id = Yii::$app->request->post('tourdetai_id',0);  
        $result['msg']  = 'Error!';
        $result['data'] = '';
        $baseUrl = Url::base(true);
        if($tour_id>0){
            //add day new            
            if($day_id>0){
                $chk = Tourdetail::chkTourdetail($tour_id,$day_id);
                $a_tmp = array();
                $a_tmp['title']       = $titleday;                
                $a_tmp['tour_id']     = $tour_id;
                $a_tmp['day_id']      = $day_id;
                $a_tmp['fulltxt']     = $txtday; 
                $a_tmp['img']         = $imgroom;                                             
                if(empty($chk)){                    
                    //add new                    
                    $tourdetail = new Tourdetail();
                    $tourdetail->attributes = $a_tmp;                   
                   // if (isset($_FILES['imgroom']["name"]) && $_FILES['imgroom']["name"]!='') {
                    //      $tourdetail->img = $this->_createImgAjax('imgroom');
                    //} 
                    $user     = Yii::$app->user->identity;
                    $tourdetail->user_id     = $user->id;
                    $tourdetail->user_modify = $user->id;                   
                    $tourdetail->create_date = date("Y-m-d H:i:s");
                    $tourdetail->last_update = date("Y-m-d H:i:s");
                    if($tourdetail->save()){
                        $result['data'] = '<tr class="odd" id="day_'.$tourdetail->id.'">
                                              <td>'.$tourdetail->days->title.'</td>
                                              <td>'.$tourdetail->title.'</td>                                             
                                              <td style="white-space: nowrap;">
                                               <span class="glyphicon glyphicon-pencil" onclick="Editday('.$tourdetail->tour_id.','.$tourdetail->day_id.');" style="cursor: pointer;"></span> &nbsp;&nbsp;
                                               <span class="glyphicon glyphicon-trash" onclick="Dele('.$tourdetail->tour_id.','.$tourdetail->day_id.','.$tourdetail->id.');" style="cursor: pointer;"></span>
                                              </td>
                                           </tr>';
                       $result['msg'] ='Add new successful!';
                    }                    
                }else{ //if(empty($chk))
                  //$result['data'] = 'Error!';       
                    if((int)$tourdetai_id>0){
                        //update day
                         $model = Tourdetail::findOne($tourdetai_id);
                         $img_old = $model->img;
                         $model->attributes = $a_tmp;
                         /*if (isset($_FILES['imgroom']["name"]) && $_FILES['imgroom']["name"]!='') {
                              $model->img = $this->_createImgAjax('imgroom');
                         }else{
                            $model->img   = $img_old;
                         }*/
                         $user     = Yii::$app->user->identity;                       
                         $model->user_modify = $user->id;                                 
                         $model->last_update = date("Y-m-d H:i:s");
                         if ($model->update()) {
                           $result['data'] = ' <td style="white-space: nowrap;">'.$model->days->title.'</td>
                                              <td>'.$model->title.'</td>                                              
                                              <td style="white-space: nowrap;">
                                                 <span class="glyphicon glyphicon-pencil" onclick="Editday('.$model->tour_id.','.$model->day_id.');" style="cursor: pointer;"></span> &nbsp;&nbsp;
                                                 <span class="glyphicon glyphicon-trash" onclick="Dele('.$model->tour_id.','.$model->day_id.','.$tourdetai_id.');" style="cursor: pointer;"></span>
                                               </td>';     
                           $result['msg'] ='Update successful!';
                         }                        
                    }
                }                
            }           
        }
       // echo CJSON::encode($result);
        echo json_encode($result,true);
        exit(1);
        //Yii::app()->end();
    }     
//Admin.Tour.Editext
 public function actionEditext() {
        $result   = array();
        $tour_id  = Yii::$app->request->post('tour_id',0);
        $ext_id   = Yii::$app->request->post('ext_id',0);
        $model    = Tourextentions::GetInfoTourExt($ext_id);
        if(!empty($model)){
            $result['id']        = $model->id;
            $result['tour_id']   = $model->tour_id;
            $result['ext_id']    = $model->ext_id;
            $result['status']    = $model->status;
            $result['ordering']  = $model->ordering;  
            $result['create_date'] = date("Y-m-d H:i:s");
            $result['last_update'] = date("Y-m-d H:i:s");  
        }
        echo json_encode($result,true);
        exit(1);
   }
   //Admin.Tour.Deleimg
   public function actionDeleimg() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result['msg']    = '!';
        $result['error']  = 0;
        $result['data']   = '';
        $result['update'] = 0;   
        $day_id   = Yii::$app->request->post('day_id',0);  
        $tour_id  = Yii::$app->request->post('tour_id',0);
        if($day_id>0 && $tour_id>0){
             $model = Tourdetail::GetInfoTourdetail($tour_id,$day_id);
             if(!empty($model)){
                $model->img="";
                $model->update();
                $result['error']  = 1;
             }            
        }
       return $result; 
   }
   //Admin.Tour.deleimgmain
    public function actionDeleimgmain() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result['msg']    = '!';
        $result['error']  = 0;
        $result['data']   = '';
        $result['update'] = 0; 
        $tour_id  = Yii::$app->request->post('tour_id',0);
        $idimg    = Yii::$app->request->post('idimg','');
        if($tour_id>0){
             $model = Tour::findOne($tour_id);              
             if(!empty($model)){                
                switch ($idimg) {                     
                         case '1':
                            $model->img1="";
                            break;
                         case '2':
                            $model->img2="";
                            break;
                         case '3':
                            $model->img3="";
                            break;
                         case '4'://delete imgmap
                            $model->imgmap="";
                            break;      
                         default:
                            $model->img="";
           
                    }
                $model->update();
                $result['error']  = 1;
             }            
        }
       return $result; 
   }
  //Admin.Tour.Deleext
  public function actionDeleext() {
        $result ='';       
        $ext_id   = Yii::$app->request->post('ext_id',0);
        if($ext_id>0){
             $model = Tourextentions::GetInfoTourExt($ext_id);
             if(!empty($model)){
                $model->delete();
                $result='Delete Ok.';
             }
        }
        echo $result;            
        exit(1);
   }
  //Admin.Tour.Addsee     
  public function actionAddext() {
        $tour_id  = Yii::$app->request->post('tour_id',0);
        $ext_id   = Yii::$app->request->post('ext_id',0);
        $ordering = Yii::$app->request->post('ordering',0);
        $tourext_id     = Yii::$app->request->post('tourext_id',0); 
        $status   = Yii::$app->request->post('status',0);
        $result['msg']  = '';
        $result['data'] = '';
        if($tour_id>0){
            //add day new
            if($tourext_id>0){
                $chk = Tourextentions::chkTourextdetail($tour_id,$tourext_id);
                $a_tmp = array();
                $a_tmp['tour_id']   = $tour_id;
                $a_tmp['ordering']  = $ordering;  
                $a_tmp['ext_id']    = $tourext_id; 
                $a_tmp['status']    = $status;
                $a_tmp['create_date'] = date("Y-m-d H:i:s");
                $a_tmp['last_update'] = date("Y-m-d H:i:s");    
                if(empty($chk)){                    
                    //add new
                    $model = new Tourextentions();
                    $model->attributes = $a_tmp;
                    $user  = Yii::$app->user->identity;
                    $model->user_id     = $user->id;
                    $model->user_modify = $user->id;
                    $lang = Yii::$app->request->cookies->getValue('language');	   
                    if(empty($lang)){
                       $lang = Yii::$app->request->get('language','');
                    }  
                    $model->lang = $lang; 
                    if($model->save(false)){
                       $status    = Tourextentions::getStatus($model->status);
                       $id  = $model->id;
                       $cls="even";
                       $result['data'] = '<tr class="'.$cls.'" id="ext_'.$id.'" >
                              <td style="white-space: nowrap;">'.$model->tour->title.'</td>
                              <td>'.$status.'</td>
                              <td>'.$model->ordering.'</td>
                              <td style="white-space: nowrap;">
                                 <img src="../themes/admin/images/edit.png" height="18" width="18" style="cursor: pointer;" onclick="Editsee('.$model->tour_id.','.$model->id.');" />
                                 <img src="../themes/admin/images/delete.png" height="18" width="18" style="cursor: pointer;" onclick="Delesee('.$model->tour_id.','.$model->id.');" />
                              </td>
                       </tr>' ;                     
                       $result['msg'] ='Add new successful!';
                    }                    
                }else{ //if(empty($chk))
                    if((int)$ext_id>0){
                        //update day
                         $model = Tourextentions::findOne($ext_id);
                         $model->attributes = $a_tmp;
                         $user  = Yii::$app->user->identity;                       
                         $model->user_modify = $user->id;                                 
                         $model->last_update = date("Y-m-d H:i:s");
                         if ($model->update(false)) {
                            $status    = Tourextentions::getStatus($model->status);
                            $result['data'] = '
                                      <td style="white-space: nowrap;">'.$model->tour->title.'</td>
                                      <td>'.$status.'</td>
                                      <td>'.$model->ordering.'</td>
                                      <td style="white-space: nowrap;">
                                         <img src="../themes/admin/images/edit.png" height="18" width="18" style="cursor: pointer;" onclick="Editsee('.$model->tour_id.','.$model->id.');" />
                                         <img src="../themes/admin/images/delete.png" height="18" width="18" style="cursor: pointer;" onclick="Delesee('.$model->tour_id.','.$model->id.');" />
                                      </td>' ;               
                           $result['msg'] ='Update successful!';
                         }  
                                               
                    }
                }                
            } //end if($hotel_id>0)          
         }
        echo json_encode($result,true);
        exit(1);
    }    
//upload file bang ajax
 public function _createImgAjax($imgroom = null) { 
          $rnd          = rand(0,9999);
          $uploadedFile = UploadedFile::getInstanceByName($imgroom);//'imgmenu'
         // $ext          = strtolower($uploadedFile->getExtension()); 
          $mime = \yii\helpers\FileHelper::getMimeType($uploadedFile->tempName);
          $file = md5(time().'_'.$rnd).'.'.$uploadedFile->getExtension();
          $url  = Yii::$app->urlManager->createAbsoluteUrl('/media/tour/days/'.$file);
          $url  = str_replace("backend/", "",$url);
          $uploadPath = substr(Yii::$app->basePath,0,-7).'media/tour/days/'.$file;
          $move = $uploadedFile->saveAs($uploadPath);
        return $file;
}     
//load hinh anh trong itemimg
public function actionItemimg() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result['error'] = 0;
        $result['data']  = '';  
        $rows    = Itemimg::getAllImage();    
        if(!empty($rows)){
             $result['data']  = $rows;
             $result['error'] = 1;
        }                  
       return $result;
}     
//searchimgitem
public function actionSearchimgitem() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result['data'] = array();
        $term  = Yii::$app->request->post('term','');       
        if(!empty($term)){
           $txt  = ucfirst($term);
           $rows = Itemimg::find()
                                ->select(array('id','title','img','type'))                                
                                ->where('status =1 AND (title LIKE "%'.$term.'%" OR title LIKE "%'.$txt.'%")')
                                ->orderBy('title ASC')                                
                                ->all();
           if(!empty($rows)){
               foreach ($rows as $row) {                   
                  $result['data'][]= $row;
               } 
           } 
        }
        return $result;
}     
}