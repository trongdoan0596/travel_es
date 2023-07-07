<?php
namespace app\models;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "tbl_user".
 * @property integer $id
 * @property string  $username
 * @property string  $password_hash
 * @property string  $password_reset_token
 * @property string  $email
 * @property string  $fullname
 * @property string  $auth_key
 * @property integer $status
 * @property integer $role
 * @property integer $skype
 * @property integer $phone
 * @property integer $img
 * @property integer $last_update
 * @property integer $created 
 * @property string  $password write-only password
 */
 
class User extends ActiveRecord implements IdentityInterface {
    
    const STATUS_DELETED  = -1;
    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE   = 1;
    
    const ROLE_ADMIN      = 1;
    const ROLE_MANAGER    = 2;
    const ROLE_SALES      = 3;
    const ROLE_INPUT      = 4;//nhap du lieu
    const ROLE_MARKETING  = 5;//marketing  
    const ROLE_ACC        = 6;//ke toan
    
    const ROOT_MANAGER_ID = 5;//ID cua nguoi quan ly' cac' dieu hanh ,co the nhin thay tat ca danh sach cac booktour  
              
    public static function tableName(){
        return 'tbl_user';
    }
    public function rules() {
        return array(
            //array('username', 'password', 'required'),
           // array('username', 'password', 'string', 'max' => 100),
            
            array('username', 'filter', 'filter' => 'trim'),
            array('username', 'required'),
            array('username', 'unique', 'targetClass' => '\app\models\Account', 'message' => 'Username already exits'),
            array('username', 'string', 'min' =>5, 'max' =>15),
            array('email', 'filter', 'filter' => 'trim'),
            array('email', 'required'),
            array('email', 'email', 'message'=>'Email is not valid'),
            array('email', 'unique','targetClass' => '\common\models\Account', 'message' => 'Email already exists'),
          
            array('password_hash', 'required'),
            array('password_hash', 'string', 'min' =>6,'max'=>150),
            array('role', 'required'),
            array(array('username','email','fullname','status','role','skype','phone','img','last_update','created'),'safe'),          
        );
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return array(
            'id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'role'=>'Role'
        );
    }   

    public static function findIdentity($id){        
        //  return static::findOne(array('id' => $id, 'status' => self::STATUS_ACTIVE,'role' =>array('roleam' =>self::ROLE_ADMIN)));
         return static::findOne(array('id' => $id, 'status' => self::STATUS_ACTIVE));
    }

/* modified */
    public static function findIdentityByAccessToken($token, $type = null){
        //   return static::findOne(array('access_token' => $token,'role' =>array('roleam' =>self::ROLE_ADMIN)));
          return static::findOne(array('access_token' => $token));
    }

    public static function findByUsername($username){
        // return static::findOne(array('username' => $username, 'status' => self::STATUS_ACTIVE, 'role' =>array('roleam' =>self::ROLE_ADMIN)));
        return static::findOne(array('username' => $username, 'status' => self::STATUS_ACTIVE));
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token){
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
     return static::findOne(array(
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
            'role' => self::ROLE_ADMIN,
        ));
    }
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    public function getId(){
        return $this->getPrimaryKey();
    }
    public function getAuthKey() {
        return $this->auth_key;
    }
    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password){
       return Yii::$app->security->validatePassword($password,$this->password_hash);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password){        
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {        
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken(){
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
  	public function search($params){
        	$query =  User::find();
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>20,
                 ),
            ));
           $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC)
                //'attributes' => array('id','title','status')
            ));
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
          return $dataProvider;
	} 
    public static function getAllRole() {
            return array(
                    self::ROLE_ADMIN =>'Administrator',
                    self::ROLE_MANAGER =>'Manager',
                    self::ROLE_SALES =>'Sales',
                    self::ROLE_INPUT =>'Input Manager',
                    self::ROLE_MARKETING =>'Marketing'
            );       
    }
    public static function getRole($role) {
        if ($role>0) {
            $arrRole = self::getAllRole();
            return isset($arrRole[$role]) ? $arrRole[$role] : 'Select Role';
        } else {
            return  'Select Role';
        }
    }  
     public static function getAllStatus() {
        return array(0 => 'Ẩn', 1 => 'Hiện');
    }
     public static function getStatus($status) {
        if ($status) {
            $arrStatus = self::getAllStatus();
            return isset($arrStatus[$status]) ? $arrStatus[$status] : ' ';
        } else {
            return 'Ẩn';
        }
    }
     //dung trong backend
   public static function getImg($row,$width = 0, $height = 0) {    
        $retUrl = '../../media/no_img.png';
        if($row->img){
          $retUrl = '../../media/user/'.$row->img;
        }
        return $retUrl;
    } 
}
