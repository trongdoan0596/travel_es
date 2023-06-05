<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use yii\helpers\Json;
use common\models\Comment;
use common\models\CommentForm;
use common\models\Account;
use common\models\CommentitemForm;
//use yii\base\InvalidParamException;
//use yii\web\BadRequestHttpException;
/**
 * Comment controller
 */
class CommentController extends Controller {
    public $layout='main';
    public $enableCsrfValidation = false;
   /* public function behaviors() {
        return array(
            'access' =>  array(
                'class' => AccessControl::className(),
                'rules' => array(
                   array(
                        'actions' => array('post','error'),
                        'allow' => true,
                    ),                    
                ),
            ),            
        );
    }
*/
    public function actions()  {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
        );
    }
    public function Init() {       
            $cookies = Yii::$app->response->cookies;
            $lang = Yii::$app->request->get('language',''); 
            if($lang){
                if(isset(Yii::$app->params['languages'][$lang])){
                    Yii::$app->language = $lang;
                    $cookies->add(new \yii\web\Cookie(array('name'  => 'language','value' => $lang)));
                }
            }elseif($cookies->has('language')){
                Yii::$app->language = $cookies->getValue('language');
            }
    }
    public function actionIndex() {
       die('ddd');
    }
    public function actionSavecm() {         
            Yii::$app->response->format = Response::FORMAT_JSON;
           // $result['msg']  = '';
            //$result['error']  = 0;
            $model = new CommentForm();      
            $post  = Yii::$app->request->post();            
	        if($model->load($post) && $model->validate()) {   
	            $model->attributes  = $post['CommentForm'];
	            if(strpos($post['CommentForm']['message'],'http://')!== false || strpos($post['CommentForm']['message'],'https://')!== false ){
                    //spam , thong tin khong hop le
                    $result['error'] = 0;
                    $result['msg']    = Yii::t('app', 'Error!'); 
                }else{   
                    $comment = new Comment();
                    $comment->attributes  = $post['CommentForm'];
                    $comment->user_id     = Account::ChkInfoEmail($post['CommentForm']['youremail'],$post['CommentForm']['fullname']);  
                    $comment->title       = $post['CommentForm']['fullname']; 
                    $comment->ordering    = 0;
                    $comment->status      = 1;//chua dc hien thi
                    $comment->ip          = Yii::$app->getRequest()->getUserIP();;
                    $comment->last_update = date("Y-m-d H:i:s");
                    $comment->create_date = date("Y-m-d H:i:s");                ;  
                    $result['error']  = 1;
                    $result['data']  = array();
                    $result['msg']    = 'Add successful!';
                    if ($comment->save(false)) {                    
                        $model->SendAdminComment($comment,1);  
                    }    
                   // Yii::$app->session->setFlash('success', 'Add successful!');                
                }                 
            }else{
                $result['error'] = 0;
                $result['msg']    = '';
                $result['data']  = $model->errors;
       } 
      return $result;
      Yii::$app->end();
   }
    public function actionGetfrm() {         
            Yii::$app->response->format = Response::FORMAT_JSON;
            $type       = Yii::$app->request->post('type',''); 
            $extid      = Yii::$app->request->post('extid',0);          
            $commentid  = Yii::$app->request->post('commentid',0); 
            $result['msg']  = '';
            $result['error']  = 0;
            $model = new CommentitemForm();
	        $result['tmp'] = $this->renderPartial('frmitemcomment',array(
                         'model'=>$model,'ext_id'=>$extid,'comment_id'=>$commentid,'type'=>$type),true); 
            return $result;
            Yii::$app->end();
   }

    public function actionValidateform() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new CommentForm();
        $model->load(Yii::$app->request->post());
        $result = ActiveForm::validate($model);
        return $result;
    } 
}