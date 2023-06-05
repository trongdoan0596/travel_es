<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use common\helper\StringHelper;
/**
 * This is the model class for table "fr_products".
 * @property integer $id 
 * @property string  $alias
 * @property string  $controller
 * @property string  $action
 * @property string  $ext_id
 * @property integer $type
 * @property string  $last_update
 * @property string  $create_date
 */ 
class Aliasurl extends ActiveRecord {
    const ALIASURL_BLOG      = 1;
    const ALIASURL_BLOG_CATE = 2;    
    const ALIASURL_TOUR      = 3;
    const ALIASURL_TOUR_CATE = 4;
    const ALIASURL_REVIEW    = 5;
     
    public static function tableName(){        
          return 'au_aliasurl';
    }   
	public function rules()	{		
         return [
             ['alias', 'filter', 'filter' => 'trim'],
             [['id','alias','controller','action','ext_id','type','last_update','create_date'],'safe'],
             [['id','alias','create_date'],'safe', 'on' => 'search'],
       ];
	}  
    public function attributes(){
        return ['id','alias','controller','action','ext_id','type','last_update','create_date'];
    }
	public function attributeLabels(){
		return ['id'=>'ID','alias'=>'Alias','controller'=>'Controller','action' =>'Action','ext_id'=>'Ext ID','type' =>'Type','create_date'=>'Create date','last_update'=>'Last update'];
	}
	public function search($params){
        	$sql =  self::find();
            $data = new ActiveDataProvider(['query'=>$sql,'pagination'=>['pageSize'=>30]]);
            $data->setSort(['defaultOrder' =>['id'=>SORT_DESC],'attributes' =>['id','alias','create_date']]);
            if (!($this->load($params) && $this->validate())) {
                return $data;
            }
            if($this->alias !=''){
                $sql->andWhere(['like','alias',$this->alias]);
            }
            if($this->controller !=''){
                $sql->andWhere(['like','controller',$this->controller]);
            }
            if($this->id>0){
                $sql->andWhere(['id'=>$this->id]);
            }
            if($this->create_date !=''){
                $sql->andWhere(['>=','create_date',$this->create_date]);
            }
          return $data;
	}
    public static function getAllType() {
        return [self::ALIASURL_BLOG=>"Blog",self::ALIASURL_BLOG_CATE=>"Category Blog"];
  }     
  public static function getDetail($id){ 
         $model = self::findOne($id);  
      return $model;     
   }
  public static function getDetailAlias($alias,$fields=''){
        $sql = self::find();
        if($fields!=''){$sql->select($fields);}
        $sql->where(['alias'=>$alias]);
        $model = $sql->one();
        return $model;
  }
  public static function getDelete($alias,$controller){
        $model = self::find()->where(['alias'=>$alias,'controller'=>$controller])->one();
        if(!empty($model)) $model->delete();
        return true;
  }
  public static function ChkAlias($alias,$controller){
        $sql = self::find();
        $sql->where(['alias'=>$alias,'controller'=>$controller]);
        $model = $sql->one();
        return $model;
  }
  public static function AddAliasUrl($alias,$controller='',$action='',$ext_id=0,$type='',$add='addnew'){
       $chkmodel =  self::ChkAlias($alias,$controller);
       if(!empty($chkmodel)){//da ton tai alias nay roi
           if($chkmodel->ext_id !=$ext_id || $chkmodel->controller!=$controller){
               $i = 1;
               while ($i <=10) {
                   $alias_new = $alias.rand(1,100);
                   $chkmodel  =  self::ChkAlias($alias_new,$controller);
                   if(empty($chkmodel)){
                       $alias = $alias_new;
                       break;
                   }
                   $i++;
               }
           }else{
               $chkmodel= '';
           }
       }
      if(empty($chkmodel)){//them dc roi
          if($add=='addnew'){
              $model = new Aliasurl();
              $model->alias     = $alias;
              $model->controller = $controller;
              $model->action    = $action;
              $model->ext_id    = $ext_id;
              $model->type      = $type;
              $model->create_date = date("Y-m-d H:i:s");
              $model->last_update = date("Y-m-d H:i:s");
              $model->save();
          }else{
              $model = self::find()->where(['controller'=>$controller,'ext_id'=>$ext_id])->one();
              if(!empty($model)){
                  $model->alias       = $alias;
                  $model->last_update = date("Y-m-d H:i:s");
                  $model->update();
              }else{
                  $model = new Aliasurl();
                  $model->alias     = $alias;
                  $model->controller = $controller;
                  $model->action    = $action;
                  $model->ext_id    = $ext_id;
                  $model->type      = $type;
                  $model->create_date = date("Y-m-d H:i:s");
                  $model->last_update = date("Y-m-d H:i:s");
                  $model->save();
              }
          }
          return $alias;
      }else{
          die('Error Alias!');
      }
    }
    /*****************/
/********End Class************/
}