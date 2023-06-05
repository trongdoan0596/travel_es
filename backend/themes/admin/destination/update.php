<?php
use yii\widgets\Menu;
use yii\base\view;
//echo $this->render('_search', array('model'=>$searchModel));
echo Menu::widget(array(
    'items'=>array(  
            array('label' => 'Destination Manager', 'url' => array('destination/index')),
            array('label' => 'Add new', 'url' => array('destination/create')),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
?>
<h1 class="title-page">Update </h1>
<?php
echo $this->render('_form', array('model'=>$model,'allcountry' => $allcountry));
?>