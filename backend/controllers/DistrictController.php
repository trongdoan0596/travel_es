<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\District;//load models tu thu muc common , n?u load t? thu muc c?a app : app\models\Article;
use common\models\Region;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\models\Log;
class DistrictController extends Controller {
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
        Log::AddLog("add",$id,0,'',$this->action->id,'District');     
        return $result;
    }   
//List record
 public function actionIndex() {
         $model = new District();         
         $dataProvider = $model->search(Yii::$app->request->get());
         $regions = Region::getRegion();
        return $this->render('index',array('model' => $model,'dataProvider' => $dataProvider,'regions' => $regions));
    }
//create
public function actionCreate() {
        $model = new District();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['District'];
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        
        $regions = Region::getRegion();
        return $this->render('create', array(
            'model' => $model,
            'regions' => $regions,
        ));
    }
 //update
public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $post  = Yii::$app->request->post();
	   if ($model->load($post)) {  
             $model->attributes  = $post['District'];
             $model->update();
       }     
       $regions = Region::getRegion(); 
      return $this->render('update', array(
            'model' => $model,       
            'regions' => $regions,
        ));
    } 
//Delete  
public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = District::findOne($id);
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    }
          

}
