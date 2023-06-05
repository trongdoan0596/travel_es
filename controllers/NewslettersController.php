<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\helpers\Json;
use common\models\Newsletters;
/**
 * Newsletters controller
 */
class NewslettersController extends Controller {
   public $layout='main';
   public $enableCsrfValidation = false;
   public function actions()  {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),            
        );
    }   
    public function actionAddnewsletter() {      
        Yii::$app->response->format = Response::FORMAT_JSON;
        $e_mail = Yii::$app->request->post('e_mail',''); 
        $data['msg'] ='Error!';
        $data['error'] = 0;
        if (filter_var($e_mail, FILTER_VALIDATE_EMAIL)) {
            $chk = Newsletters::chkEmail($e_mail);
            if(empty($chk)){
                //add new
                  $model = new Newsletters();
                  $model->e_mail = $e_mail;
                  $model->ip     = Yii::$app->getRequest()->getUserIP();
                  $model->status = 0;//chua doc
                  $model->create_date = date("Y-m-d H:i:s");
                  if($model->save(false)) {
                     $data['error'] = 1;
                     $data['msg'] = Yii::t('app','Thanks register E-mail for newsletters');
                  }           
            }else{
                $data['msg'] = Yii::t('app','Email already exists');
            }            
        }else{           
            $data['msg'] = 'Error validate email!';
        }        
        return $data;
    }   
    public function actionError() {
        return $this->render('error');
    }
}