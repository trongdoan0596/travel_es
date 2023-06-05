<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Log;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
class LogController extends Controller {
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
                        'actions' =>array('index','view','delete'),
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
         $user_id = Yii::$app->user->identity->id;
         $model = new Log();   
         $data  = $model->search(Yii::$app->request->get()); 
         if($user_id==3){
            return $this->render('admin',array('model' =>$model,'dataProvider' =>$data));
         }else{
            return $this->render('index',array('model' =>$model,'dataProvider' =>$data));
         }
         
        
 }
public function actionDelete($id) {
         $model = $this->loadModel($id);
         $user_id = Yii::$app->user->identity->id;
         if($user_id==3){//dongta
             $model->delete();
         }else{
            $model->status = -1;
            $model->update();
         }         
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Log::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    }
}