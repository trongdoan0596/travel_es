<?php
namespace common\models;
use Yii;
use yii\base\Model;
use common\models\Account;
class AccountFormLogin extends Model {
    public $username;
    public $password;
    public $rememberMe = true;
    private $_account;
    /**
     * @dongta
     */
    public function rules(){
        return array(
            // username and password are both required
            array('username', 'filter', 'filter' => 'trim'),
            array('username', 'required'),
            array('rememberMe', 'boolean'),
            // password is validated by validatePassword()
            array('password', 'validatePassword'),
            array('password', 'required'),
            array('password', 'string', 'min' => 6),
            
        );
    }
 public function attributeLabels() {
        return array(
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'E-mail',
            'fullname' => 'Fullname',
            'phone' => 'Phone'
        );
    }
    public function validatePassword($attribute,$params) {
        if (!$this->hasErrors()) {
            $account = $this->getAccount();
            if (!$account || !$account->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }
    public function login(){
        if ($this->validate()) {
           return Yii::$app->user->login($this->getAccount(),$this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
    protected function getAccount() {
        if ($this->_account === null) {
            $this->_account = Account::findByAccountname($this->username);
        }
        return $this->_account;
    }
}
