<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Account;
use app\models\AccountForm;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\helpers\Json;
use common\models\Country;
use common\models\Region;
use common\helper\StringHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\models\Log;
class AccountController extends Controller {
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
                        'actions' =>array('index','create','update','delete','delavatar'),
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Account');     
        return $result;
    } 
 public function actionIndex() {      
         $model = new Account();   
         $dataProvider = $model->search(Yii::$app->request->get());         

         if(!empty($_GET['date_start']) && !empty($_GET['date_end']) && isset($_GET['_export']))
         {
            $date_start = $_GET['date_start'];
            $date_end = $_GET['date_end'];

            $query =  Account::find()
            ->where(['between', 'created', $date_start, $date_end ])->all();
            if(!empty($query)){
                $this->exportData($query);
            }
            
         }
         
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
    private function exportData($dataProvider){
        if( !empty($dataProvider) ){
            $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet=0;

            $objPHPExcel->setActiveSheetIndex($sheet);

            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'first name');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, 'last name');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, 'email');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, 'phone');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, 'create');
        

            foreach ($dataProvider as $dk => $dv){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $dk+2, $dv->first_name);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $dk+2, $dv->last_name);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $dk+2, $dv->email);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $dk+2, $dv->phone);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $dk+2, $dv->created);
            }

            header('Content-Type: application/vnd.ms-excel');
            $filename = "test.xls";
            header('Content-Disposition: attachment;filename='.$filename .' ');
            header('Cache-Control: max-age=0');
            $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xls');
            $objWriter->save('php://output');
            die();

        }
    }
  //create
  public function actionCreate() {
        $model = new AccountForm();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
	        $model_new = new Account();            
            $model_new->attributes  = $post['AccountForm'];
            if($model->password_hash==""){
                $model->password_hash = StringHelper::Rand_string(8);
            } 
            $model_new->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);            
            if($model->username==""){
               $model->username =str_replace(" ","", $model->first_name.$model->last_name); 
            }
            $model_new->status      = 1;
            $model_new->ip = Yii::$app->getRequest()->getUserIP();
            $model_new->last_update = date("Y-m-d H:i:s");
            $model_new->created     = date("Y-m-d H:i:s");
            if (isset($_FILES['AccountForm']["name"]["img"]) && $_FILES['AccountForm']["name"]["img"]!='') {
                //print_r($_FILES['AccountForm']);die();
                $model_new->img = $this->_createImg($model,'user','img');  
            }
            if ($model_new->save(false)) {
                $this->redirect(array('update', 'id' => $model_new->id));
            }
            
        }
        $country = Country::getAllCountry();
        $regionarray  = array();
        $allcountry   = $country;
        foreach($allcountry as $row){
    	      $listData = ArrayHelper::map(Region::getAllRegion($row->id),'id','title');
              $regionarray[$row->id] = $listData;
          }
        
        return $this->render('create', array(
            'model' => $model,
            'country' => $country,
            'regionarray' =>$regionarray,
        ));
    }
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $img_old = $model->img;
       $password_hash_old = $model->password_hash;
       $post  = Yii::$app->request->post();
	   if ($model->load($post)) {  
             $model->attributes = $post['Account'];
             if($model->username==""){
                $model->username =str_replace(" ","",$model->first_name.$model->last_name); 
             }
             if($model->password_hash !=$password_hash_old && strlen($model->password_hash)>=6){
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
             }else{
                 $model->password_hash = $password_hash_old;
             }
             if (isset($_FILES['Account']["name"]["img"]) && $_FILES['Account']["name"]["img"]!='') {
                $model->img = $this->_createImg($model,'user','img');  
             }else{
                $model->img  = $img_old;
             }
         $model->update();
       }
      $country = Country::getAllCountry();
      $regionarray  = array();
      $allcountry   = $country;
      foreach($allcountry as $row){
	      $listData = ArrayHelper::map(Region::getAllRegion($row->id),'id','title');
          $regionarray[$row->id] = $listData;
      }
      return $this->render('update', array(
            'model' => $model,
            'country' => $country,
            'regionarray' =>$regionarray,
        ));
    }
public function actionDelete($id) {  
        $model = $this->loadModel($id);
        $model->delete();       
        return $this->redirect(array('index'));
    }
public function actionDelavatar(){  
    Yii::$app->response->format = Response::FORMAT_JSON;
        $result['error']= 0;
        $id = Yii::$app->request->post('id',0);        
        $model = $this->loadModel($id);
        if(!empty($model)){
            $model->img='';
            $model->update();
            $result['error']= 1;
        }
       return $result;  
}
public function loadModel($id) {
        $model = Account::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    }
 public function actionError() {  
        die('Sorry,Error!');
    }
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