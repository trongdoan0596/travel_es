<?php
use yii\helpers\Url;
$user     = Yii::$app->user->identity;//print_r($user);
$username = $user->username;
$user_id  = $user->id;//Yii::$app->user->getId();
//$username = Yii::$app->user->get
echo 'Hi,'.$username.'  ID'.$user_id.'<br />';
//$url = Html::a('Logout',array('/user/logout'),array('class' => 'btn btn-success','data-method'=>'post'));
//echo $url;

$cookies = Yii::$app->request->cookies;
$langbackend  = $cookies->getValue('langbackend');
echo 'langbackend:'.$langbackend.'<br />';
?>
<a href="<?php echo Url::to(array('site/logout'))?>" data-method="post">Logout</a>
administrator