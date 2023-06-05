<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Newsletters;
use yii\filters\VerbFilter;
class NewslettersController extends Controller {
    public $layout='main';
    public $enableCsrfValidation = false;
    public function behaviors() {
        return [
            'access' =>[
                'class' => AccessControl::className(),
                'rules' =>[
                     ['actions' =>['error'],'allow' => true],
                     ['actions' =>['index','delete'],'allow' =>true,'roles'=>['@']]
                ],
            ],
            'verbs' =>['class' => VerbFilter::className(),'actions' =>['logout' =>['post']]]
        ];
    }
    public function actions()  {
        return ['error'=>['class'=>'yii\web\ErrorAction']];
    }   
 public function actionIndex() {      
         $model = new Newsletters();
         $data = $model->search(Yii::$app->request->get());
         return $this->render('index',['model'=>$model,'data'=>$data]);
 }
public function actionDelete($id) {
         $model = $this->loadModel($id);
         $model->delete();
        return $this->redirect(['index']);
    }
public function loadModel($id) {
        $model = Newsletters::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    }
}