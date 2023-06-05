<?php
namespace common\models;
use Yii;
use yii\db\ActiveRecord;
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
 
class User extends ActiveRecord  {    
    const STATUS_DELETED  = -1;
    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE   = 1;
    
    const ROLE_ADMIN      = 1;
    const ROLE_MANAGER    = 2;
    const ROLE_SALES      = 3;
    const ROLE_INPUT      = 4;//nhap du lieu
    const ROLE_ACC        = 6;//ke toa  
    
    const ROOT_MANAGER_ID = 5;//ID cua nguoi quan ly' cac' dieu hanh ,co the nhin thay tat ca danh sach cac booktour              
    public static function tableName(){
        return 'tbl_user';
    }
    public static function Getname($id) {    
         $model = User::findOne($id);  
         if(!empty($model)){
            return $model->fullname;
         }else{
            return "--N--";
         }
      
    } 
 }   