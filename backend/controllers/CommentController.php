<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Comment;
use common\models\Account;
use common\models\Blog;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\helper\StringHelper;
use common\models\Log;
class CommentController extends Controller {
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
        Log::AddLog("add",$id,0,'',$this->action->id,'Comment');     
        return $result;
    }
 public function actionIndex() {      
         $model = new Comment();   
         $dataProvider = $model->search(Yii::$app->request->get());  
        return $this->render('index',array('model' =>$model,'dataProvider' => $dataProvider));
    }
  //create
  public function actionCreate() {
        $model = new Comment();
        $post  = Yii::$app->request->post();
	    if ($model->load($post)) {  
            $model->attributes  = $post['Comment'];
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
	   if ($model->load($post)) {  
             $model->attributes = $post['Comment'];
             if($model->status==1 && $model->send_mail==1 && $model->comment_id>0 ){
                $info    = $model->getDetailComment($model->comment_id);
                //get url blog
                $blog    = Blog::getDetailBlog($info->ext_id);
                $title_blog='';
                 if(trim($blog->alias)!=''){
                       $title_blog  = StringHelper::formatUrlKey($blog->alias); 
                    }else{
                       $title_blog  = StringHelper::formatUrlKey($blog->title);
                 }  
                $url     = 'https://authentikvietnam.com/'.$title_blog.'-b'.$info->ext_id;
                //get email account
                $account = Account::getAccount($info->user_id);
                //send mail for account
                $model->SendEmailNotify($model,$account,$url);
             }
             $model->update();
       }
      return $this->render('update', array(
            'model' => $model
        ));
    }
public function actionDelete($id) {
         $model = $this->loadModel($id);
         $model->status = -1;
         $model->update();
        return $this->redirect(array('index'));
    }
public function loadModel($id) {
        $model = Comment::findOne($id);       
        if ($model === null)
             throw new \yii\web\NotFoundHttpException;
        return $model;
    }

}