<?php
namespace common\models;
use Yii;
use yii\base\Model;
class RequestpriceForm extends Model {
    public $title;
    public $title_tour;
    public $tour_id;
    public $name;
    public $address;        
    public $nationality;    
    public $phone;
    public $email;
    public $skype;
    public $whatsapp;
    public $viber;   
    public $confirmemail;
    public $adult;
    public $children;
    public $age1;
    public $age2;
    public $age3;
    public $age4;
    public $age5;
    public $age6;
    public $hotel1;
    public $hotel2;
    public $hotel3;
    public $hotel4;
    public $hotel5;
    public $depart;//ngay khoi hanh    
    /*meals2*/
    public $meals1;
    public $meals2;
    public $meals3;
    public $traveldate_id;
    public $arrivaldate_other_m;
    public $arrivaldate_other_y;
    public $mess;  
    public $verifyCode;    
    public $contact1;//lien he qua email,phone or skype
    public $contact2;
    public $contact3;
    public $contact4;
    public $contact5;
    public $contacttxt;//thoi gian khach chon de lien lac    
    public $start_city;//bat dau vao tu TP ?
    public $end_city;//khi ve nuoc thi o TP?
    /*how did you dinf us*/
    public $how_did_id;
    public $howdidtxt;
    /**
     * @dongta
     */
    public function rules(){
        return array(
            // username and password are both required
            array('name', 'filter', 'filter' => 'trim'),
            array('name', 'string', 'min' =>3),
            array('name', 'required','message'=>Yii::t('app','Nombre completo no puede estar en blanco.')),
           // array('address', 'required'),
            array('phone', 'filter', 'filter' => 'trim'),
            array('phone', 'required','message'=>Yii::t('app','Teléfono completo no puede estar en blanco.')),
            array('email', 'filter', 'filter' => 'trim'),
            array('email', 'required','message'=>Yii::t('app','Email completo no puede estar en blanco.')),
            array('email', 'email', 'message'=>Yii::t('app','Email no está válido.')),   
            array('confirmemail', 'required','message'=>Yii::t('app','Confirmar email completo no puede estar en blanco.')),
            array('confirmemail', 'compare', 'compareAttribute'=>'email','message' =>Yii::t('app','Confirmar email deber ser similar a Email.')),         
            array( array('verifyCode'), 'captcha','message' =>Yii::t('app','Tienes que rellenar un captcha de autenticación.')),
            array('adult', 'filter', 'filter' => 'trim'),        
            array('adult', 'required','message'=>Yii::t('app','Número de participantes no puede estar en blanco.')),
            array(
                  array('title','tour_id','name','address','email','phone','nationality','mess','adult','children',
                        'age1','age2','age3','age4','age5','age6','hotel1','hotel2','hotel3','hotel4','hotel5','depart',
                        'traveldate_id','arrivaldate_other_m','arrivaldate_other_y','meals1','meals2','meals3',
                        'skype','whatsapp','viber','contact1','contact2','contact3','contact4','contact5','contacttxt','title_tour','verifyCode',
                        'start_city','end_city','how_did_id','howdidtxt'
                       ),
                  'safe'
             ),            
        );
    }
 public function attributeLabels() {
        return [
            'title' =>Yii::t('app','Sex'),  
            'title_tour' =>Yii::t('app','Title tour'),  
            'name' =>Yii::t('app','Nombre'), 
            'tour_id' =>Yii::t('app','Tour ID'),  
            'nationality' =>Yii::t('app','Nacionalidad'), 
            'phone' =>Yii::t('app','Teléfono'),         
            'email' =>Yii::t('app','Email'), 
            'address' =>Yii::t('app','Dirección'), 
            'mess' => Yii::t('app','Tu mensaje'),
            'age' => Yii::t('app','Edad'),
            'adult' => Yii::t('app','Número de participantes'),
            'children' => Yii::t('app','Niños'),
            'hotel' => Yii::t('app','Hotel'),
            'depart' => Yii::t('app','Llegada'),
            'confirmemail'=>Yii::t('app','Confirmar email'), 
            'verifyCode'=>Yii::t('app','Verificar código'),
            'skype'=>Yii::t('app','Cuenta de Skype'),
            'whatsapp' =>Yii::t('app','Tu Whatsapp'),
            'viber' =>Yii::t('app','Tu viber'),
            'contacttxt'=>Yii::t('app','El mejor momento para teléfono o skype'),   
            'start_city'=>Yii::t('app','Start city'),
            'end_city'=>Yii::t('app','End city'),        
        ];
    }
     public function getAllAge() {
        return [
            1=> Yii::t('app','20-30'),
            2=> Yii::t('app','31-40'),
            3=> Yii::t('app','41-50'),
            4=> Yii::t('app','51-60'),
            5=> Yii::t('app','61-70'),
            6=> Yii::t('app','70 ( o más )'),
         ];
    }
 public function getAge($id) {
        if ($id) {
            $arr = self::getAllAge();
            return isset($arr[$id]) ? $arr[$id] : '--No--';
        } else {
            return '--No--';
        }
    }   
   public function getAllHotelType() {
        return [
            1=> Yii::t('app','Casa de hospedaje'),
            2=> Yii::t('app','3***(45 - 65 USD/habitación/noche)'),
            3=> Yii::t('app','4****(65 - 100 USD/habitación/noche)'),
            4=> Yii::t('app','4****+ (100 - 180 USD/habitación/noche)'),   
            5=> Yii::t('app','5*****(>180 USD /habitación/noche)'),       
         ];
    }
 public function getHotelType($id) {
        if ($id) {
            $arr = self::getAllHotelType();
            return isset($arr[$id]) ? $arr[$id] : '--No--';
        } else {
            return '-No-';
        }
    }  
  public function getAllMeals() {
        return [
            1=> Yii::t('app','Desayuno'),
            2=> Yii::t('app','Media Pensión'),
            3=> Yii::t('app','Pensión completa')            
         ];
    }
 public function getMeals($id) {
        if ($id) {
            $arr = self::getAllMeals();
            return isset($arr[$id]) ? $arr[$id] : '--No--';
        } else {
            return '--No--';
        }
    }  
   public function getAllContact() {
        return [1=>Yii::t('app','Email'),2=>Yii::t('app','Phone'),3=>Yii::t('app','Skype'),4=>Yii::t('app','WhatsApp'),5=> Yii::t('app','Viber')];
    }  
 public function getContact($id) {
        if ($id) {
            $arr = self::getAllContact();
            return isset($arr[$id]) ? $arr[$id] : '--No--';
        } else {
            return '--No--';
        }
    }     
  public function getAllCityStart() {
        return [1=>'Hanoi',2=>'HCM Ville',3=>'Danang'];
    }
 public function getCityStart($id) {
        if ($id) {
            $arr = self::getAllCityStart();
            return isset($arr[$id]) ? $arr[$id] : '--No--';
        } else {
            return '--No--';
        }
    }
  public function getAllCityEnd() {
        return [1=>'Hanoi',2=>'HCM Ville'];
    }
 public function getCityEnd($id) {
        if ($id) {
            $arr = self::getAllCityEnd();
            return isset($arr[$id]) ? $arr[$id] : '--No--';
        } else {
            return '--No--';
        }
    }   
  public function getAllHowDidUs() {
        return [
            1=> Yii::t('app','Amigos / familia'),
            2=> Yii::t('app','Sistema de busqueda'),
            3=> Yii::t('app','Publicidad en Internet'),
            4=> Yii::t('app','Red social'),
            5=> Yii::t('app','Otro')                
         ];
    }
 public function getHowDidUs($id) {
        if ($id) {
            $arr = self::getAllHowDidUs();
            return isset($arr[$id]) ? $arr[$id] : '-No-';
        } else {
            return '-No-';
        }
    }       
   public function SendEmailAdmin($model,$modeltour){
        return Yii::$app->mailer
            ->compose(['html'=>'requestprice'],['model'=>$model,'admin'=>1,'modeltour'=>$modeltour])
            ->setFrom([Yii::$app->params['supportEmail']=>'Authentik Travel'])
            ->setTo(Yii::$app->params['contactEmail'])
            ->setSubject(Yii::t('app','Solicitud de precio'))
            ->send();            
        return true;
    }  
//send mail for account
public function SendEmailConfirm($model,$modeltour){
        return Yii::$app->mailer
            ->compose(['html' => 'requestprice'],['model' => $model,'admin' =>0,'modeltour' =>$modeltour])
            ->setFrom([Yii::$app->params['supportEmail'] => 'Authentik Travel'])
            ->setTo($model->email)
            ->setSubject('Authentik Travel/Solicitud de precio')
            ->send();
        return true;
    }
}
