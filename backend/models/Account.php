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
 * @property string  $phone
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $code_postal
 * @property string  $birtday
 * @property integer $sex
 * @property integer $region_id
 * @property integer $country_id
 * @property integer $manager_id 
 * @property string  $passport 
 * @property string  $auth_key
 * @property integer $status
 * @property integer $live_country_id
 * @property integer $live_region_id
 * @property integer $live_address
 * @property integer $img
 * @property integer $created
 * @property integer $last_update 
 * @property string  $password write-only password
 */
 
class Account extends ActiveRecord{
    public static function tableName(){
        return 'au_account';
    }
   public function rules() {
        return array(
            //array('username', 'password', 'required'),
            //array('username', 'password', 'string', 'max' =>50),
            array(array('username','email','first_name','last_name','phone','status','birtday','gender','region_id',
                        'country_id','address','manager_id','passport','code_postal','live_country_id','live_region_id','live_address','img','last_update','created'            
            ),'safe'),        
        );
    }
    public function attributeLabels(){
        return array(
             'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'country_id' => 'Country',
            'region_id'  => 'Region',
            'password' => 'Password',
            'birtday' => 'Birtday',
            'gender' => 'Gender',
            'address'=>'Address',
            'passport'=>'Passport',
            'first_name'=>'First name', 
            'last_name'=>'Last name',
            'code_postal'=>'Code postal',
            'img'=>'Avatar (250x250)'     
        );
    } 
    public static function getAllStatus() {
        return array(-1 =>'Đã Xóa',0 => 'Chưa Kích hoạt', 1 => 'Kích hoạt');
    }
    public static function getStatus($status) {
        if ($status) {
            $arrStatus = self::getAllStatus();
            return isset($arrStatus[$status]) ? $arrStatus[$status] : ' ';
        } else {
            return 'Chưa Kích hoạt';
        }
    } 
    public static function getAllGender() {
        return array(0 =>'Male',1 =>'Female');
    }
    public static function getGender($gender) {
        if ($gender) {
            $arr = self::getAllGender();
            return isset($arr[$gender]) ? $arr[$gender] : ' ';
        }else {
            return 'Undefine';
        }
    }
    public static function getAllGenderExt() {
        return array('M' =>'M','Mme' =>'Mme','Mlle' =>'Mlle');
    }
    public static function getGenderExt($genderext) {
        if ($genderext) {
            $arr = self::getAllGenderExt();
            return isset($arr[$genderext]) ? $arr[$genderext] : ' ';
        }else {
            return 'Undefine';
        }
    }
  	public function search($params){
        	$query =  Account::find();
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>20,
                 ),
            ));
            $dataProvider->setSort(array(
                'defaultOrder' =>array('id'=>SORT_DESC),
                'attributes' => array('id','username')
            ));
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
          return $dataProvider;
	} 
    public static function getImg($row,$width = 0, $height = 0) {    
        $retUrl = '../../media/user/avatar.png';
        if($row->img){
          $retUrl = '../../media/user/'.$row->img;
        }
        return $retUrl;
  }   
}
