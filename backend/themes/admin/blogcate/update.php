<?php
use yii\widgets\Menu;
use yii\base\view;
//echo $this->render('_search', array('model'=>$searchModel));
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Blog Catygory Manager', 'url' => array('blogcate/index')),
                array('label' => 'Add new', 'url' => array('blogcate/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
?>
<h1 class="title-page">Update </h1>
<?php
echo $this->render('_form', array('model'=>$model,'allcate' =>$allcate));
?>