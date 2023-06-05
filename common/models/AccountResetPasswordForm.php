<?php
namespace common\models;
use Yii;
use yii\base\Model;
use common\models\Account;
class AccountResetPasswordForm extends Model {
    public $email;
    public $verifyCode;
    /**
     * @dongta
     */
    public function rules(){
        return array(
            array('email', 'filter', 'filter' => 'trim'),
            array('email', 'required'),
            array('email', 'email', 'message'=>'Email Không đúng định dạng'),//Email is not valid
            //array('email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'E-mail đã tồn tại'),
            array( array('verifyCode'), 'captcha','message' => 'Bạn phải nhập mã chứng thực!'),
            
        );
    }
 public function attributeLabels() {
        return array(
            'email' => 'E-mail',
            'verifyCode' => 'Mã chứng thực',
        );
    }
//Send link de reset mat khau
 public function sendEmailResetPass(){
        $account = Account::findOne(array('email' => $this->email));
        if (!empty($account) && $account->status >0) {
            $account->generatePasswordResetToken();
            $account->update(false);
            //gui email de reset mat khau
            $msg     = 'Email lấy lại mật khẩu từ timabc.com.';  
            $link    = 'http://timabc.com/account/resetpass?token='.$account->password_reset_token;
            $e_mail  = $account->email;
            $info    = "Chào bạn\n Để lấy lại mật khẩu bạn hãy click vào link sau : ".$link." \n Trân trọng";
            $mail    = Yii::$app->mailer->compose()
                            ->setFrom(array(Yii::$app->params['supportEmail']=>'Support Timabc'))
                            ->setTo($e_mail)
                            ->setSubject($msg)
                            ->setTextBody($info)
                            ->send();  
                            
            //@mail($e_mail,$msg, "Chào bạn\n Để lấy lại mật khẩu bạn hãy click vào link sau : ".$link." \n Trân trọng");            
            return true;
        }
        return false;
    }
/*****END******/    
}
