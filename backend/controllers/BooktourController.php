<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Booktour;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use common\models\Tourcate;
use common\models\Days;
use common\models\Region;
//use common\models\Country;
use common\models\Log;

class BooktourController extends Controller {
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
                        'actions' =>array('index','update','delete'),
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Booktour');     
        return $result;
    }
 public function actionIndex() {      
         $user_id = Yii::$app->user->identity->id;
         $model = new Booktour();   
         $dataProvider = $model->search(Yii::$app->request->get());  
         $catetour = Tourcate::getCateTourparent(1);//danh muc voi parent_id=1
         if($user_id==3){
            return $this->render('admin',array('model' =>$model,'catetour' =>$catetour,'dataProvider' => $dataProvider));
         }else{
            return $this->render('index',array('model' =>$model,'catetour' =>$catetour,'dataProvider' => $dataProvider));
         }
        
    }    
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $img_old = $model->img;
       $post  = Yii::$app->request->post();
	   if ($model->load($post)) {  
            $model->attributes = $post['Booktour'];
             if($model->title==''){
                echo 'Error Title!';
                die();                
             }
             //$model->update();
       }
    //  $catetour = Tourcate::getCateTourparent(1);//danh muc voi parent_id=1
    //  $allcity  = Region::getRegion();//danh sach cac city
      return $this->render('update', array(
            'model' => $model,
            //'catetour' => $catetour,
            //'allcity' => $allcity
        ));
    }
public function actionDelete($id) {
         $model = $this->loadModel($id);
         $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Booktour::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    }
 
}