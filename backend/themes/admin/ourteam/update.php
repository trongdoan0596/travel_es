<?php
use yii\widgets\Menu;
use yii\base\view;
//echo $this->render('_search', array('model'=>$searchModel));
echo Menu::widget(array(
    'items'=>array(  
            array('label' => 'Ourteam Manager', 'url' => array('ourteam/index')),
            array('label' => 'Add new', 'url' => array('ourteam/create')),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
?>
<h1 class="title-page">Update </h1>
<?php
echo $this->render('_form', array('model'=>$model,'country' => $country));
?>