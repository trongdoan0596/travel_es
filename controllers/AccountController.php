<?php
namespace app\controllers;
use Yii;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Account;
use common\models\AccountFormLogin;
use common\models\AccountForm;
use common\models\AccountResetPasswordForm;
//use yii\base\InvalidParamException;
//use yii\web\BadRequestHttpException;
/**
 * Account controller
 */
class AccountController extends Controller {
    public $layout='main';
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
    public function actionLogin() {
        $model = new AccountFormLogin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $account     = Yii::$app->user->identity;
            $account_id  = $account->id;
            $account->last_update = date("Y-m-d H:i:s");
            $account->ip = Yii::$app->getRequest()->getUserIP();
            $account->update(false); 
            Yii::$app->session->setFlash('msg', 'Login thanh công');
            return $this->goHome();
        } else {
           // return $this->render('login', array('model' => $model));
           Yii::$app->session->setFlash('msg','Login không thanh cong.');
           //Yii::$app->homeUrl
           return $this->goHome();
        }       
         
    }
 public function actionLogintest() {
            $model = new AccountFormLogin();
            return $this->render('login', array('model' => $model));
         
 }
    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->goHome();
    }
    public function actionRegister(){
        $model = new AccountForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($account = $model->Register()) {
               /* if ($model->sendEmail($account,1)) {
                    Yii::$app->session->setFlash('success', 'Bạn hãy kiểm tra E-mail để chứng thực.');
                    $mail  = Yii::$app->mailer->compose()
                            ->setFrom(array(Yii::$app->params['supportEmail']=>'Support Timabc'))
                            ->setTo("donggv@gmail.com")
                            ->setSubject("E-mail đăng ký Thành Viên từ timabc.com")
                            ->setTextBody("Hi\n Bạn vừa có E-mail đăng ký Thành Viên từ timabc.com gửi với Email: ".$account->email." hãy mau vào xử lý\nThanks")
                            ->send();  
                           
                }else{
                    Yii::$app->session->setFlash('success', 'Lỗi, Chúng tôi không gửi được mật khẩu đến E-mail bạn cung cấp!');
                }   */              
                return $this->render('success');
            }
        }
        return $this->goHome();
        //return $this->render('register', array('model' => $model));
    }
//kích hoạt tai khoan
public function actionActived(){
     $token = Yii::$app->request->get('token','');
     Yii::$app->session->setFlash('success', 'Mã Token không đúng hoặc hết hạn!');
     if(!empty($token)){
        $model = Account::findOne(array('password_reset_token'=>$token,'status' =>0));
        if(!empty($model)){
            $model->status = 1;
            $model->generatePasswordResetToken();
            $model->update(false);
            Yii::$app->session->setFlash('success', 'Bạn đã kích hoạt thành công. <a href="http://authentikvietnam.com/account/login">Login</a>');
        }
     }
     return $this->render('success');
 } 
//resetpass   
 public function actionResetpass(){
    //gui mat khau vao E-mail cho user
     $token = Yii::$app->request->get('token','');
     Yii::$app->session->setFlash('success', 'Mã Token không đúng hoặc hết hạn!');
     if(!empty($token)){
        $model = Account::findOne(array('password_reset_token'=>$token));
        if(!empty($model)){
            if($model->status==0) $model->status = 1;
            $model->generatePasswordResetToken();
            $password = Yii::$app->security->generateRandomString(8);
            $model->setPassword($password);
            $model->update(false);
            $msg     = 'Mật khẩu được gửi từ authentikvietnam.com.'; 
            $e_mail  = $model->email;
            $info    = "Chào bạn\n\n Mật khẩu của bạn : ".$password." \n\n Trân trọng";
           //@mail($e_mail,$msg, "Chào bạn\n\n Mật khẩu của bạn : ".$password." \n\n Trân trọng");   
            $mail  = Yii::$app->mailer->compose()
                        ->setFrom(array(Yii::$app->params['supportEmail']=>'Support Authentikvietnam'))
                        ->setTo($e_mail)
                        ->setSubject($msg)
                        ->setTextBody($info)
                        ->send();  
                                 
            Yii::$app->session->setFlash('success', 'Bạn hãy kiểm tra E-mail để lấy thông tin mật khẩu. <a href="'.Yii::$app->homeUrl.'">Đăng nhập</a>');
         }
     }
     return $this->render('success');
 }
//yêu cầu lấy lại mật khẩu   
 public function actionResetpassword(){
        $model = new AccountResetPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           if ($model->sendEmailResetPass()) {
                Yii::$app->session->setFlash('success', 'Bạn hãy kiểm tra E-mail để chứng thực.');
           }else{
                Yii::$app->session->setFlash('success', 'Lỗi, Chúng tôi không gửi được mật khẩu đến E-mail bạn cung cấp!');
           }
           return $this->render('success');
        }
     return $this->render('resetpassword',array('model' => $model));
} 
public function actionError() {
        die('error');
        return $this->render('error');
    } 
    
/*****END*****/    
}
