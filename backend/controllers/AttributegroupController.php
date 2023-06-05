<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Attributegroup;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
class AttributegroupController extends Controller {
    public $layout='main';
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

 public function actionIndex() {      
         $model = new Attributegroup();   
         $dataProvider = $model->search(Yii::$app->request->get());         
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Attributegroup();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Attributegroup'];
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        return $this->render('create', array(
            'model' => $model
          
        ));
    }
 //update
  public function actionUpdate($id) {
       $model = $this->loadModel($id);
       $post  = Yii::$app->request->post();
	   if ($model->load($post) && $id>1) {  
             $model->attributes = $post['Attributegroup'];
             $model->update();
       }   
      return $this->render('update', array(
            'model' => $model
        ));
    }
public function actionDelete($id) {
        if($id>1){//loai tru truong hop default
              $model = $this->loadModel($id);
              $model->delete();
        }
      
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Attributegroup::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    } 
}