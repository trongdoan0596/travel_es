<?php
namespace app\models;
use Yii;
use yii\base\Model;
use app\models\Account;
class AccountForm extends Model {   
    public $id;
    public $username;
    public $email;
    public $first_name;
    public $last_name;
    public $phone;
    public $status;
    public $birtday;
    public $gender;
    public $gender_ext;
    public $region_id;
    public $country_id;
    public $address;
    public $password_hash;
    public $manager_id;
    public $passport;
    public $code_postal;
    public $live_country_id;
    public $live_region_id;
    public $live_address; 
    public $img; 
    public $last_update;
    public $created;

    public function rules(){
        return array(
            // username and password are both required
            array('username', 'filter', 'filter' => 'trim'),
            array('username', 'required'),
            array('username', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'Username already exits'),
            array('username', 'string', 'min' =>5, 'max' =>30),
            
            /* array('username', 'filter', 'filter' => 'trim'),
            array('username', 'required'),
            array('username', 'number', 'min' =>10),
            array('username', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'Số điện thoại đã tồn tại'),
           */
            array('first_name', 'filter', 'filter' => 'trim'),
            array('first_name', 'required'),
            array('last_name', 'filter', 'filter' => 'trim'),
            array('last_name', 'required'),
            
          /* array('phone', 'filter', 'filter' => 'trim'),
            array('phone', 'required'),
            array('phone', 'number', 'min' =>25,'max' =>40),
            array('phone', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'Phone number already exists'),
            
            
            array('email', 'filter', 'filter' => 'trim'),
            array('email', 'required'),
            array('confirmemail', 'required'),
            array('confirmemail', 'compare', 'compareAttribute'=>'email'),
   
            array('email', 'email', 'message'=>'Email is not valid'),
            array('email', 'unique','targetClass' => '\common\models\Account', 'message' => 'Email already exists'),
            */
           // array('phone', 'string', 'min' =>10, 'max' => 255),
           // array(array('username', 'password'), 'required'),
           // array('fullname', 'required'),
           // array('fullname', 'string', 'min' =>4),
            //array('email', 'uniqueEmail'),    
           // array('phone','uniqueEmail1'),    
            // rememberMe must be a boolean value
            // password is validated by validatePassword()
            //array('password', 'validatePassword'),
            //array('password', 'required'),
            //array('password', 'string', 'min' =>6,'max'=>20),
            //array('confirmpassword', 'required'),
            //array('confirmpassword', 'compare', 'compareAttribute'=>'password' ),
            //array( array('verifyCode'), 'captcha'),
           
            
        );
    }
   public function attributeLabels() {
        return array(
            'username' => 'username',
            'password' => 'password',
            'email' => 'E-mail',
            'phone' => 'Phone',
            'live_country_id'=>'Country live',
            'live_region_id'=>'Region live',
            'live_address'=>'Address live',
            'img'=>'Avatar (250x250)' 
        );
    }
    public function getAllStatus() {
        return array(-1 =>'Đã Xóa',0 => 'Chưa Kích hoạt', 1 => 'Kích hoạt');
    }
    public function getStatus($status) {
        if ($status) {
            $arrStatus = self::getAllStatus();
            return isset($arrStatus[$status]) ? $arrStatus[$status] : ' ';
        } else {
            return 'Chưa Kích hoạt';
        }
    } 
    public function getAllGender() {
        return array(0 =>'Male',1 =>'Female');
    }
    public function getGender($gender) {
        if ($gender) {
            $arr = self::getAllGender();
            return isset($arr[$gender]) ? $arr[$gender] : ' ';
        }else {
            return 'Undefine';
        }
    }
    public function getAllGenderExt() {
        return array('M' =>'M','Mme' =>'Mme','Mlle' =>'Mlle');
    }
    public function getGenderExt($genderext) {
        if ($genderext) {
            $arr = self::getAllGenderExt();
            return isset($arr[$genderext]) ? $arr[$genderext] : ' ';
        }else {
            return 'Undefine';
        }
    } 
}
