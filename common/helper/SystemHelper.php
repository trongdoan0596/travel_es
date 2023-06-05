<?php
namespace common\components; 
use Yii;
use yii\base\Component;
class SystemHelper extends Component {

    public static $_helper;

    public static function helper($isNew = false) {
        if (!is_null(self::$_helper) && !$isNew)
            return self::$_helper;
        else {
            $className = __CLASS__;
            $helper = self::$_helper = new $className();
            return $helper;
        }
    }

    public function isEmail($email) {
        $validator = new CEmailValidator;
        if ($validator->validateValue($email)) {
            return true;
        }
        return false;
    }

    public function getThumb($model, $width = 0, $height = 0) {
        $retUrl = Yii::app()->getBaseUrl(true).'/'.ImageUpload::NO_IMAGE;
        if (is_object($model)) {
            $retUrl = $model->getThumb($width, $height);
        } elseif (is_array($model)) {
            $thumb = new ImageThumb();
            $thumb_folder = $thumb->getThumbFolder($width, $height);
            if ($model['path'] && $model['image']) {
                $retUrl = $model['path'] . '/' . $thumb_folder . '/' . $model['image'];
            }
        }
        return $retUrl;
    }
    public function emailSendOrderPlaceSuccess($order) {
        if ($this->isEmail($order->customer_email) && (!preg_match('/localhost/i', Yii::app()->request->getHostInfo()))) {
            $email = Yii::app()->email;
            $email->from = 'timabc.com <hotro@timabc.com>';
            $email->to = $order->customer_email;
            $email->subject = 'Thông báo đặt hàng thành công';
            $email->view = 'orderSuccess';
            $email->viewVars = array('order' => $order);
            $email->send();
        }
    }
    
    public function emailSendCustomerRegister($customer,$password) {
        if ($this->isEmail($customer->email) && (!preg_match('/localhost/i', Yii::app()->request->getHostInfo()))) {
            $email = Yii::app()->email;
           $email->from = 'timabc.com <hotro@timabc.com>';
            $email->to = $customer->email;
            $email->subject = 'Thông báo đăng ký thành viên thành công';
            $email->view = 'register';
            $email->viewVars = array('customer' => $customer, 'password' => $password);
            $email->send();
        }
    }

   
}