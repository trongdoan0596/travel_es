<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Aliasurl;
use yii\filters\VerbFilter;
use yii\web\Response;
use common\models\Log;
class AliasurlController extends Controller {
    public $layout='main';
    public $enableCsrfValidation = false;
    public function behaviors() {
        return [
            'access' =>[
                'class' => AccessControl::className(),
                'rules' =>[
                     ['actions' =>['error'],'allow' => true],
                     ['actions' =>['index','update','delete'],'allow' =>true,'roles'=>['@']]
                ],
            ],
            'verbs' =>['class' => VerbFilter::className(),'actions' =>['logout' =>['post']]]
        ];
    }
  public function actions()  {
        return ['error'=>['class'=>'yii\web\ErrorAction']];
    }   
 public function afterAction($action, $result){
        $result = parent::afterAction($action, $result);
        $id = 0;        
        $user_id = Yii::$app->user->identity->id;
        if($this->action->id=='update'){
           $id = $this->action->controller->actionParams['id'];  
        }
        Log::AddLog("add",$id,0,'',$this->action->id,'Aliasurl');     
        return $result;
    }  
 public function beforeAction($event){
        $user_id = Yii::$app->user->identity->id;
        if($user_id==2 || $user_id==3 ){
            return true;
        }else{
            $this->redirect(['site/permission']);
        }
 }
 public function actionIndex() {      
         $model = new Aliasurl();
         $data = $model->search(Yii::$app->request->get());
         return $this->render('index',['model'=>$model,'data'=>$data]);
 }
public function actionDelete($id) {
         $model = $this->loadModel($id);
         $model->delete();
        return $this->redirect(['index']);
    }
public function loadModel($id) {
        $model = Aliasurl::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    }
}