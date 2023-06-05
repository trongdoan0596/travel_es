<?php
namespace common\models;
use Yii;
use yii\base\Model;
use common\models\Account;
class AccountForm extends Model {
    public $username;
    public $password;
    public $verifyCode;
    public $confirmpassword;
    public $rememberMe = true;
    private $_account;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $note;
    public $confirmemail;
    /**
     * @dongta
     */
    public function rules(){
        return array(
            // username and password are both required
           /*array('username', 'filter', 'filter' => 'trim'),
            array('username', 'required'),
            array('username', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'Tên đăng nhập đã tồn tại'),
            array('username', 'string', 'min' =>5, 'max' => 255),
            */
            /* array('username', 'filter', 'filter' => 'trim'),
            array('username', 'required'),
            array('username', 'number', 'min' =>10),
            array('username', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'Số điện thoại đã tồn tại'),
           */
            array('first_name', 'filter', 'filter' => 'trim'),
            array('first_name', 'required'),
            array('last_name', 'filter', 'filter' => 'trim'),
            array('last_name', 'required'),
            
           // array('phone', 'filter', 'filter' => 'trim'),
            //array('phone', 'required'),
           // array('phone', 'number', 'min' =>10),
           // array('phone', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'Phone number already exists'),
            
            
            array('email', 'filter', 'filter' => 'trim'),
            array('email', 'required'),
           // array('confirmemail', 'required'),
           // array('confirmemail', 'compare', 'compareAttribute'=>'email'),
   
            array('email', 'email', 'message'=>'Email is not valid'),
            array('email', 'unique','targetClass' => '\common\models\Account', 'message' => 'Email already exists'),
           // array('phone', 'string', 'min' =>10, 'max' => 255),
           // array(array('username', 'password'), 'required'),
           // array('fullname', 'required'),
           // array('fullname', 'string', 'min' =>4),
            //array('email', 'uniqueEmail'),    
           // array('phone','uniqueEmail1'),    
            // rememberMe must be a boolean value
            array('rememberMe', 'boolean'),
            // password is validated by validatePassword()
            //array('password', 'validatePassword'),
            array('password', 'required'),
            array('password', 'string', 'min' =>6,'max'=>20),
            array('confirmpassword', 'required'),
            array('confirmpassword', 'compare', 'compareAttribute'=>'password' ),
            array( array('verifyCode'), 'captcha'),
            
        );
    }
 public function attributeLabels() {
        return array(
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'E-mail',
            'phone' => 'Phone',
            'note' => 'Note'
        );
    }
 public function Register(){
       if ($this->validate()) {
            $account = new Account();
            $account->first_name = $this->first_name;
            $account->last_name  = $this->last_name;
            $account->username   = $this->email;
            $account->email      = $this->email;
            $account->phone      = $this->phone;
            $account->setPassword($this->password);
            $account->generateAuthKey();
            $account->generatePasswordResetToken();
            $account->status      = 1;
            $account->created     = date("Y-m-d H:i:s");
            $account->last_update = date("Y-m-d H:i:s");
            $account->ip = Yii::$app->getRequest()->getUserIP();
            if ($account->save(false)) {
                return $account;
            }
        }
        return null;
    } 
  /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail($accouunt= "",$type=0){
        if($accouunt==""){
           $accouunt = Accouunt::findOne(array(
                'status' => User::STATUS_ACTIVE,
                'email' => $this->email,
            )); 
        }
        if (!empty($accouunt)) {
            if($type==1){
                //kich hoat tai khoan
                $msg     = 'Email kích hoạt tài khoản từ authentikvietnam.com.';  
                $link    = 'http://authentikvietnam.com/account/actived?token='.$accouunt->password_reset_token;
                $e_mail  = $accouunt->email;
                $info    = "Chào bạn\n Để kích hoạt tài khoản bạn hãy click vào link sau : ".$link." \n Trân trọng";
                //@mail($e_mail,$msg,$info);
                $mail  = Yii::$app->mailer->compose()
                        ->setFrom(array(Yii::$app->params['supportEmail']=>'Support Authentikvietnam'))
                        ->setTo($e_mail)
                        ->setSubject($msg)
                        ->setTextBody($info)
                        ->send();          
                return true;
            }           
        }       
        return false;
    }    
     
}
