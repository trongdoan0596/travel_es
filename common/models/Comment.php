<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use yii\helpers\Url;
use common\helper\StringHelper;
/**
 * This is the model class for table "fr_cotravel".
 * @property integer $id
 * @property string  $title
 * @property integer $user_id
 * @property string  $message
 * @property integer $type
 * @property integer $ext_id
 * @property integer $comment_id //sub comment cua comment
 * @property integer $status
 * @property integer $ordering
 * @property integer $ip
 * @property integer $send_mail
 * @property string  $last_update
 * @property string  $create_date
 */ 
 
class Comment extends ActiveRecord { 
    public static function tableName(){     
          return 'au_comment';   
    }
public function rules()	{		
         return [
            [['id','title','user_id','message','type','ext_id','comment_id','status','ordering','ip','send_mail','last_update','create_date'],'safe'],
             [['id','type','status'],'safe','on'=>'search']
        ];
	}
    public function getAccount(){
        return $this->hasOne(Account::className(),['id' =>'user_id']);
    }    
	public function attributeLabels(){
		return [
            'id' => 'ID',
            'title' => 'Title',
            'user_id' => 'User ID',
            'message' => 'Message',
            'type' => 'Type',
            'ext_id'=>'Extention ID',
            'comment_id'=>'Comment ID',
            'status' => 'Status',
            'ordering' => 'Ordering',
            'ip' => 'IP',
            'send_mail'=>'Send mail Notify',
            'create_date' => 'Create date',
            'last_update' => 'Last update'
        ];
	}
	public function search($params){
        	$query =  self::find();
            $dataProvider = new ActiveDataProvider(['query'=>$query,'pagination'=>['pageSize'=>30]]);
            $dataProvider->setSort(['defaultOrder'=>['id'=>SORT_DESC],'attributes'=>['id','user_id','ext_id','status']]);
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
            if($this->id>0){$query->andWhere(['id'=>$this->id]);}
            if($this->status !=''){$query->andWhere(['status'=>$this->status]);}
          return $dataProvider;
	}
    public static function getAllStatus() {
        return [0=>'Ẩn',1=>'Hiện'];
    }
    public static function getStatus($n) {
        if ($n) {
            $arr = self::getAllStatus();
            return isset($arr[$n]) ? $arr[$n] : '-No-';
        } else {
            return '-No-';
        }
    }
   public static function GetComment($type = '',$ext_id = 0,$limit=0,$orderby='ordering asc',$fields=''){    
        $result = array();
        $sql = self::find();
        $sql->joinWith(['account']);
        if($fields!=''){$sql->select($fields);} 
        if($ext_id>0 && $type!=''){
             $sql->where([Comment::tableName().'.status'=>1,Comment::tableName().'.ext_id'=>$ext_id,Comment::tableName().'.type'=>$type]);
             if($limit>0) $sql->limit($limit);
             $result = $sql->orderBy($orderby)->all();
        }
        return $result;        
	} 
    public static function GetSubComment($type = '',$comment_id = 0,$limit=0,$orderby='ordering asc',$fields=''){    
        $result = array();
        $sql = self::find();
        $sql->joinWith(['account']);
        if($fields!=''){$sql->select($fields);} 
        if($comment_id>0 && $type!=''){
             $sql->where([Comment::tableName().'.status'=>1,Comment::tableName().'.comment_id'=>$comment_id,Comment::tableName().'.type'=>$type]);
             if($limit>0) $sql->limit($limit);
             $result = $sql->orderBy($orderby)->all();
        }
        return $result;        
	}  
   public static function GetLastComment($type = '',$limit=0,$orderby='ordering asc',$fields=''){  
            $sql = self::find();
            if($fields!=''){$sql->select($fields);} 
            $sql->where(['status'=>1,'comment_id'=>0]);      
            if($type!=''){$sql->andWhere(['type'=>$type]);}      
            if($limit>0) $sql->limit($limit);
            $result = $sql->orderBy($orderby)->all();
        return $result;        
	}   
   public static function GetTotalComment($type = '',$comment_id = 0){    
        $result = 0;       
        if($comment_id>0 && $type!=''){
           $sql = self::find();
           $sql->andWhere(['status'=>1,'comment_id'=>$comment_id]);
           $count  = clone $sql;                     
           $result = $count->count();   
        }
        return $result;        
	}   
   public static function getDetailComment($id){
      return self::findOne($id);
   }    
//send mail for account 
public function SendEmailNotify($model,$account,$url){     
        $mailto = $account->email;//$account->email;
        return Yii::$app->mailer
            ->compose(['html'=>'commentnotify'],['model'=>$model,'url'=>$url])
            ->setFrom([Yii::$app->params['supportEmail']=>'Authentikvietnam'])
            ->setTo($mailto)
            ->setSubject('Notifications sur Authentik Vietnam')
            ->send();
    }   
/********End Class************/
}