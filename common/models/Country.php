<?php
namespace common\models;//thu muc hien tai cua app : app\models;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
/**
 * This is the model class for table "cb_country".
 * @property integer $id
 * @property string $name
 * @property string $iso
 * @property string $iso3
 * @property string $numcode
 * @property string $phonecode
 * @property integer $is_tour
 * @property string $introtxt
 * @property string $fulltxt
 * @property string $ordering
 */
class Country extends \yii\db\ActiveRecord { 
    public static function tableName(){
        return 'en_country';
    }
	public function rules()	{		
         return array(
             //array('name', 'required'),
             array(
                  array('id','name','introtxt','is_tour','iso','iso3','numcode',
                        'phonecode','fulltxt','ordering'
                       ),
                  'safe'
             ),
          array(array('id','name','is_tour'),'safe', 'on' => 'search'),
        );     
	}
	public function attributeLabels(){
		return array(
			'id' => 'ID',
            'name'=> 'Name',
			'iso' => 'ISO',	
            'is_tour'=>'Show Tour'	,
            'introtxt'=>'Intro text',
            'fulltxt'=>'Full text',
            'ordering'=>'Ordering'
		);
	}
	public function search($params){
        	$query =  Country::find();
            $dataProvider = new ActiveDataProvider(array(
                'query' => $query,
                'pagination'=>array(
                   'pageSize'=>15,
                 ),
            ));
            $dataProvider->setSort(array(
                'attributes' => array('id','name','is_tour')
            ));
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
            if($this->name!=''){
                 $query->andWhere('name LIKE "%'.$this->name.'%"');
            }
           if($this->id>0){
              $query->andWhere('id = "'.$this->id.'"');
            }
           if($this->is_tour !=''){
              $query->andWhere('is_tour = "'.$this->is_tour.'"');
            }  
          return $dataProvider;
	}
   //Show tour
    public static function getAllShowtour() {
        return array(0 => 'No', 1 => 'Yes');
    }
    public static function getShowtour($is_tour) {
       if ($is_tour) {
            $arrIstour = self::getAllShowtour();
            return isset($arrIstour[$is_tour]) ? $arrIstour[$is_tour] : ' ';
        } else {
            return 'No';
        }       
    }
    public static function getAllStatus() {
        return array(0 => 'Hide', 1 => 'Show');
    }
    public static function getStatus($status) {
        if ($status) {
            $arrStatus = self::getAllStatus();
            return isset($arrStatus[$status]) ? $arrStatus[$status] : ' ';
        } else {
            return 'Hide';
        }
    }
    //tra ve danh sach country có is_tour=1
	public static function getCountry(){
        $result = Country::find()
                    ->where('is_tour =:is_tour',array(':is_tour' => 1))
                    ->orderBy('ordering asc')
                    ->all();
        return $result;
	}    
    public static function getName($id){
            $model = Country::findOne($id);  
            if(!empty($model)){
                return $model->name;
            }else{
                return "- No -";
            }
  }
//tra ve danh sach country 
 public static function getAllCountry(){
        $result = Country::find()
                    ->orderBy('ordering asc')
                    ->all();
        return $result;
	}
 public static function getCountryDetail($id){	 
      $model = Country::findOne($id);  
      return $model;     
   }    
}