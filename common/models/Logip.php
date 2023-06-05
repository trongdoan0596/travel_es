<?php
namespace common\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "tbl_logip"
 * The followings are the available columns in table 'tbl_logip':
 * @property integer $id
 * @property string  $ip
 * @property string  $remoteip
 * @property string  $user_agent
 * @property string  $created_at
 */ 
class Logip extends ActiveRecord { 
    public static function tableName(){
        return 'tbl_logip';
    }
    public function rules(){
        return[[['ip','remoteip','user_agent','created_at'],'safe'],['id,remoteip,ip,created_at','safe','on'=>'search']];        
    }  
    public function attributes(){
        return ['id','ip','remoteip','user_agent','created_at'];
    }
    public function search($params) {
    	$sql  =  self::find();
        $data = new ActiveDataProvider(['query'=>$sql,'pagination'=>['pageSize'=>50]]);   
        $data->setSort(['defaultOrder' =>['id'=>SORT_DESC],'attributes' =>['id','ip','created_at']]);
            if (!($this->load($params) && $this->validate())) {
                return $data;
            }           
            if($this->id>0){$sql->andWhere(['id'=>$this->id]);}        
            if($this->ip !=''){$sql->andWhere(['ip'=>$this->ip]);}
            if($this->created_at !=''){$sql->andWhere(['created_at'=>$this->created_at]);} 
         return $data;
    } 
}
?>