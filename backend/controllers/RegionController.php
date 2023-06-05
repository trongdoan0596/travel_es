<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Region;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use common\models\Country;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\models\Log;
class RegionController extends Controller {
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
                        'actions' =>array('index','create','update'),//,'delete'
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Region');     
        return $result;
    }
 public function actionIndex() {
         $model = new Region();   
         $countrys = Country::getCountry();
         $dataProvider = $model->search(Yii::$app->request->get());
        return $this->render('index',array('model' =>$model,'countrys' =>$countrys,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Region();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Region'];
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        $country = Country::getCountry();
        return $this->render('create', array(
            'model' => $model,
            'country' =>$country,       
        ));
    }
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $post  = Yii::$app->request->post();
	   if ($model->load($post)) {  
             $model->attributes = $post['Region'];
             $model->update();
       }      
      $country = Country::getCountry();
      return $this->render('update', array(
            'model' => $model,
            'country' =>$country,       
        ));
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
         $model = $this->findModel($id);
         $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        //$model = Region::find()->where('id =:id',array(':id' =>$id))->multilingual()->one();
         $model = Region::findOne($id);   
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    } 
}
