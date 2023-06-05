<?php
namespace common\models;
use Yii;
use yii\base\Model;
class ContactForm extends Model {    
    public $slcgender;
    public $title;
    public $nationality;
    public $email;
    public $confirmemail;
    public $mess;  
    public $phone;
    public $subject;  
    public $verifyCode;
    public $skype;
    public $contact1;//lien he qua email,phone or skype
    public $contact2;
    public $contact3;
    public $contact4;
    public $contact5;
    public $contacttxt;//thoi gian khach chon de lien lac
    public $whatsapp;
    public $viber;
    /**
     * @dongta
     */
    public function rules(){
        return array(
            // username and password are both required
            array('title', 'filter', 'filter' => 'trim'),
            array('title', 'string', 'min' => 6,'tooShort'=>'Nombre debería contener al menos 6 letras.'),
            array('title', 'required','message'=>'Nombre completo no puede estar en blanco.'),
            array('email', 'filter', 'filter' => 'trim'),
            array('email', 'required','message'=>'E-mail no puede estar en blanco.'), 
            array('email', 'email','message'=>'Email no está válido.'),
            array('confirmemail', 'required','message'=>'Confirmar email no puede estar en blanco.'),
            array('confirmemail', 'compare', 'compareAttribute'=>'email','message'=>'Confirmar email deber ser similar a Email.'),
            array('phone', 'filter', 'filter' => 'trim'),
            array('phone', 'required','message'=>'Tu número de teléfono no puede estar en blanco.'),
            array( array('verifyCode'), 'captcha','message' =>Yii::t('app','Tienes que rellenar un captcha de autenticación.')),
            array('mess', 'filter', 'filter' => 'trim'),
            array('mess', 'string', 'min' =>6,'tooShort'=>'Tu mensaje debería contener al menos 6 letras.'),
            array('mess', 'required','message'=>'Tu mensaje no puede estar en blanco.'),
            array('nationality', 'required','message'=>'Tu nacionalidad no puede estar en blanco.'),            
            array(
                  array('slcgender','title','email','confirmemail','mess','phone','subject','postalcode','nationality',
                        'contact1','contact2','contact3','contact4','contact5','contacttxt','skype','whatsapp','viber'),
                  'safe'
             ),            
        );
    }
 public function attributeLabels() {
        return array(
            'title' =>Yii::t('app','Nombre completo').'*',          
            'email' =>Yii::t('app','Email').'*',
            'mess' => Yii::t('app','Tu mensaje').'*',
            'phone' =>Yii::t('app','Tu número de teléfono').'*',
            'subject' =>Yii::t('app','Sujeto'),
            'skype' =>Yii::t('app','Cuenta de Skype'),
            'whatsapp' =>Yii::t('app','Tu Whatsapp'),
            'viber' =>Yii::t('app','Tu viber'),
            'confirmemail'=>Yii::t('app','Confirmar email').'*',
            'nationality' =>Yii::t('app','Tu nacionalidad').'*',
            'contacttxt'=>Yii::t('app','Tu disponibilidad para conversar con nosostros via Skype/teléfono'),
            'verifyCode'=>Yii::t('app','Verificar código').'*'
        );
    }
 public function getAllContact() {
        return array(
            1=> Yii::t('app','Email'),
            2=> Yii::t('app','Phone'),
            3=> Yii::t('app','Skype'),
            4=> Yii::t('app','WhatsApp') ,
            5=> Yii::t('app','Viber')           
         );
    }
 public function getContact($id) {
        if ($id) {
            $arr = self::getAllContact();
            return isset($arr[$id]) ? $arr[$id] : '-No-';
        } else {
            return '-No-';
        }
    }     
   public function SendEmail($model,$admin){
        return Yii::$app->mailer
            ->compose(
                array('html' => 'contact'),
                array('model' => $model,'admin'=>$admin)
            )
            ->setFrom(array(Yii::$app->params['supportEmail'] => 'Authentik Travel'))
            ->setTo(Yii::$app->params['contactEmail'])
            ->setSubject('Solicitud de información')
            ->send(); 
    }  
//send mail for account
public function SendEmailConfirm($model,$admin){
        return Yii::$app->mailer
            ->compose(
                array('html' =>'contact'),
                array('model' => $model,'admin'=>$admin)
            )
            ->setFrom(array(Yii::$app->params['supportEmail'] => 'Authentik Travel'))
            ->setTo($model->email)
            ->setSubject('Authentik Travel/ Solicitud de información')
            ->send();
    }
}
