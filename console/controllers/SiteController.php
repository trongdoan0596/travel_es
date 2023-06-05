<?php 
namespace console\controllers; 
use yii\console\Controller; 
/**
 * Site controller
 */
class SiteController extends Controller {
 
    public function actionIndex() {
        echo "cron service runnning";
    } 
    public function actionMail($to) {
        echo "Sending mail to " . $to;
    } 
}