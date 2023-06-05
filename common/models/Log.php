<?php
namespace common\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\Url;
/**
 * This is the model class for table "tbl_log".
 *
 * The followings are the available columns in table 'tbl_log':
 * @property integer $id
 * @property integer $user_id
 * @property string  $username
 * @property string  $type
 * @property integer $id_ext
 * @property integer $item_id
 * @property string  $img
 * @property string  $action
 * @property string  $controller
 * @property string  $data
 * @property string  $ip
 * @property string  $remoteip
 * @property string  $user_agent
 * @property string  $created_at
 */ 
class Log extends ActiveRecord { 
    public static function tableName(){
        return 'tbl_log';
    }
    public function rules(){
        return array(            
             array(array('user_id','username','type','id_ext','item_id','img','action','controller','data','ip','remoteip','user_agent','created_at'
                         ), 'safe'),
             array('id,username,remoteip','safe', 'on' => 'search'),
        );        
    }
    public function attributes(){
        return ['id','user_id','username','type','id_ext','item_id','img','action','controller','data','ip','remoteip','user_agent','created_at'];
    }   
    public function attributeLabels(){
        return array(
            'ID' =>'ID',
            'user_id' =>'User ID',
            'username' => 'Username',
            'type' =>'Type',
            'id_ext' =>'ID mở rộng',
            'img' =>'Hình ảnh',
            'ip' =>'IP',
            'created_at' =>'Ngày tạo'
        );
    }

public function search($params) {
    	$query =  Log::find();
        $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>50,
                 ),
            ));
            
            $dataProvider->setSort(array(
                    'defaultOrder' =>array('id'=>SORT_DESC),
                    'attributes' => array('id','username','type','id_ext','item_id','action','controller','ip','created_at')
            ));
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
            if($this->username !=''){
               $query->andWhere('username LIKE "%'.$this->username.'%"');
            }     
            if($this->id>0){
               $query->andWhere('id = "'.$this->id.'"');
            }
            if($this->type>0){
               $query->andWhere('type = "'.$this->type.'"');
            }
            if($this->id_ext>0){
               $query->andWhere('id_ext = "'.$this->id_ext.'"');
            }
            if($this->action!=''){
               $query->andWhere('action = "'.$this->action.'"');
            }
            if($this->controller!=''){
               $query->andWhere('controller = "'.$this->controller.'"');
            }
            if($this->ip !=''){
               $query->andWhere('ip = "'.$this->ip.'"');
            }
            if($this->created_at !=''){
               $query->andWhere('created_at = "'.$this->created_at.'"');
            } 
          return $dataProvider;
  }
 //add vao log
 public static function AddLog($type,$id_ext,$item_id=0,$img='',$action='',$controller='',$data='') {
        $ip = '';
        if (getenv('HTTP_CLIENT_IP')){
                $ip = 'CLIENT_IP-'.getenv('HTTP_CLIENT_IP');
            }else if(getenv('HTTP_X_FORWARDED_FOR')){
                $ip = 'PROXY-'.getenv('HTTP_X_FORWARDED_FOR');
            }else if(getenv('HTTP_X_FORWARDED')){
                $ip = getenv('HTTP_X_FORWARDED');
            }else if(getenv('HTTP_FORWARDED_FOR')){
                $ip = getenv('HTTP_FORWARDED_FOR');
            }else if(getenv('HTTP_FORWARDED')){
               $ip = getenv('HTTP_FORWARDED');
            }else if(getenv('REMOTE_ADDR')){
                $ip = 'REMOTE_ADDR-'.getenv('REMOTE_ADDR');
            }else{
                $ip = 'UNKNOWN';  
         }
         
         $user  = Yii::$app->user->identity;
         $model = new Log();
         $model->user_id    = $user->id;
         $model->username   = $user->username;
         $model->type       = $type;
         $model->id_ext     = $id_ext;
         $model->item_id    = $item_id;
         $model->img        = $img;
         $model->action     = $action;
         $model->controller = $controller;
         $model->data       = $data;
         $model->type       = $type;
         $model->created_at = date("Y-m-d H:i:s");
         $model->ip = Yii::$app->getRequest()->getUserIP();         
         $model->remoteip   = $ip;//Yii::$app->getRequest()->getRemoteIP();
         $model->user_agent = Yii::$app->request->userAgent;         
         $model->save(false);
         return true;
    }   
}
?>