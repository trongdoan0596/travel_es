<?php
use yii\widgets\Menu;
use yii\base\view;
//echo $this->render('_search', array('model'=>$searchModel));
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Region Manager', 'url' => array('region/index')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
?>
<h1 class="title-page">Update </h1>
<?php
echo $this->render('_form', array('model'=>$model,'country'=>$country));
?>