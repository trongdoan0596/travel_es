<?php
namespace common\models;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;
use common\helper\StringHelper;
use yii\helpers\Url;
/**
 * This is the model class for table "tbl_user".
 * @property integer $id
 * @property string  $username
 * @property string  $password_hash
 * @property string  $password_reset_token
 * @property string  $email
 * @property string  $phone
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $code_postal
 * @property string  $birtday
 * @property integer $gender
 * @property integer $gender_ext
 * @property integer $region_id
 * @property integer $country_id
 * @property integer $manager_id 
 * @property string  $passport 
 * @property string  $auth_key
 * @property integer $status
 * @property integer $note 
 * @property integer $live_country_id
 * @property integer $live_region_id
 * @property integer $live_address
 * @property integer $img
 * @property integer $created
 * @property integer $last_update 
 * @property string  $password write-only password
 * @property string  $user_modify
 * @property string  $user_created
 */
 
class Account extends ActiveRecord implements IdentityInterface {
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE  = 1;
    
    public $account_note;    
    public $account_address;
    public $region_id;//tinh thanh
    public $district_id;//quan huyen
    
    public static function tableName(){
        return 'au_account';
    }
    public function rules() {
        return array(
            //array('username', 'password', 'required'),
            //array('username', 'password', 'string', 'max' =>50),
            array(array('username','email','first_name','last_name','phone','status','birtday','gender','gender_ext','region_id',
                        'country_id','address','manager_id','passport','code_postal','note','live_country_id','live_region_id','live_address',
                        'img','last_update','created','user_modify','user_created'            
            ),'safe'),          
        );
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'country_id' => 'Country',
            'region_id'  => 'Region',
            'password' => 'Password',
            'birtday' => 'Birtday',
            'gender' => 'Gender',
            'gender_ext' => 'Gender Ext',
            'address'=>'Address',
            'passport'=>'Passport',
            'note'=>'Note',
            'live_country_id'=>'Country live',
            'live_region_id'=>'Region live',
            'live_address'=>'Address live',          
            'first_name'=>'Firts name', 
            'last_name'=>'Last name',
            'img'=>'Avatar',
            'code_postal'=>'Code postal'
        );
    }   
    
    public static function findIdentity($id){
         return static::findOne(array('id' => $id, 'status' => self::STATUS_ACTIVE));
    }

/* modified */
    public static function findIdentityByAccessToken($token, $type = null){
          return static::findOne(array('access_token' =>$token));
    }

    public static function findByAccountname($username){
        return static::findOne(array('username' => $username, 'status' => self::STATUS_ACTIVE));
    }
    public static function findByPasswordResetToken($token){
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
    return static::findOne(array(
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
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
    public function validatePassword($password){
       return Yii::$app->security->validatePassword($password,$this->password_hash);
    }
    public function setPassword($password){        
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    public function generateAuthKey() {        
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    public function generatePasswordResetToken(){
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
  	public function search($params){
        	$query =  Account::find();
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>20,
                 ),
            ));
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
          return $dataProvider;
	} 
  public static function getAccount($id){	 
      $model = Account::findOne($id);  
      return $model;     
   }
  public static function getListAllAccount(){
         $model = Account::find()
                     //->where('status =:status',array(':status' =>1))
                    ->orderBy('first_name asc,last_name asc')
                    ->all();
         $result = array();            
         if($model){           
            foreach($model as $row){
                $result[$row->id] =  $row->first_name . ' ' . $row->last_name;              
            }
        }           
        return $result;
  }
  public static function getInfoEmail($email){
        $model = Account::find()
                    ->where('email =:email',array(':email' =>$email))                                     
                    ->one();   
        return $model;
	} 
  public static function AddAcount($email){
        $password = StringHelper::Rand_string(8);
        $model = new Account(); 
        $model->first_name = "No";
        $model->last_name  = "No";
        $model->username   = $email;
        $model->email      = $email;
        $model->phone      = "";
        $model->setPassword($password);
        $model->generateAuthKey();
        $model->generatePasswordResetToken();
        $model->status      = 1;
        $model->created     = date("Y-m-d H:i:s");
        $model->last_update = date("Y-m-d H:i:s");
        $model->ip = Yii::$app->getRequest()->getUserIP();
        $model->save(false);
      return $model;     
   } 
 public static function getAvatar($row,$width = 0, $height = 0) {    
        $retUrl = Url::base().'/media/user/avatar.png';
        if($row->img){
          $retUrl = Url::base().'/media/user/'.$row->img;
        }
        return $retUrl;
  }
//Post comment
   public static function ChkInfoEmail($email,$fullname){
        $model = Account::find()
                    ->where('email =:email',array(':email' =>$email))                                     
                    ->one();  
        $id = 0;           
        if(!empty($model)){
            $id  = $model->id;
        }else{
            //them moi
            $password = StringHelper::Rand_string(8);
            $model = new Account(); 
            $model->first_name = $fullname;
            $model->last_name  = "No";
            $model->username   = $email;
            $model->email      = $email;
            $model->phone      = "";
            $model->setPassword($password);
            $model->generateAuthKey();
            $model->generatePasswordResetToken();
            $model->status      = 0;
            $model->created     = date("Y-m-d H:i:s");
            $model->last_update = date("Y-m-d H:i:s");
            $model->ip = Yii::$app->getRequest()->getUserIP();
            $model->save(false);
            $id  = $model->id;
        }         
        return $id;
	}            
}
