<?php
namespace common\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
/**
 * This is the model class for table "fr_newsletters".
 * @property integer $id 
 * @property string  $e_mail
 * @property string  $status
 * @property string  $ip
 * @property string  $create_date
 */ 
class Newsletters extends ActiveRecord {     
    public static function tableName(){        
          return 'au_newsletters';   
    }   
	public function rules()	{	
         return [            
            [['id','e_mail','status','ip','create_date'],'safe'],
            [['id','e_mail','status'],'safe', 'on' => 'search'],
        ];     
	}
    public function attributes(){
        return ['id','e_mail','status','ip','create_date'];
    }	
	public function search($params){
        	$sql =  self::find();
            $data = new ActiveDataProvider(['query'=>$sql,'pagination'=>['pageSize'=>30]]);
            $data->setSort(['defaultOrder' =>['id'=>SORT_DESC],'attributes' =>['id','e_mail','create_date','status']]);
            if (!($this->load($params) && $this->validate())) {
                return $data;
            }
            if($this->e_mail !=''){
                $sql->andWhere(['like','e_mail',$this->e_mail]);
            }     
            if($this->id>0){
                $sql->andWhere(['id'=>$this->id]);
            }
            if($this->create_date !=''){
                $sql->andWhere(['>=','create_date',$this->create_date]);
            }            
            if($this->status !=''){
                $sql->andWhere(['status' =>$this->status]);
            }           
          return $data;
	}
  public static function getAllStatus() {
        return [0=>'Ẩn',1=>'Hiện'];
    }
  public static function getStatus($n) {
        $arr = self::getAllStatus();
        return isset($arr[$n]) ? $arr[$n] : '-No-';
    }
  public static function chkEmail($e_mail){
        $result = self::find()->where(['e_mail'=>$e_mail])->one();      
        return $result;
    }
    /*****************/
/********End Class************/
}