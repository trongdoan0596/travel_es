<?php
use yii\widgets\Menu;
use yii\base\view;
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Image Manager', 'url' => array('itemimg/index')),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
?>
<h1 class="title-page">Update </h1>
<?php
echo $this->render('_form', array('model'=>$model));
?>