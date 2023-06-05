<?php 
namespace console\controllers; 
use yii\console\Controller; 
/**
 * Test controller
 */
class TestController extends Controller { 
    public function actionIndex() {
        echo "cron service runnning";
    } 
    public function actionMail($to) {
        echo "Sending mail to " . $to;
    }
 
}
//test 
//D:\xampp\htdocs\yii2>d:\xampp\php\php yii test
//cron service runnning
//D:\xampp\htdocs\yii2>
//error : could not open input file:yii thi phai chay int.bat