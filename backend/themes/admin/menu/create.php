<?php
use yii\widgets\Menu;
use yii\base\view;
//echo $this->render('_search', array('model'=>$searchModel));
echo Menu::widget(array(
    'items'=>array(  
         array('label' => 'Menu Manager', 'url' => array('menu/index')),
         array('label' => 'Add new', 'url' => array('menu/create')),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
?>
<h1 class="title-page">Add new </h1>
<?php
echo $this->render('_form', array('model'=>$model,'allmenu' =>$allmenu,'ext_id_arr'=>$ext_id_arr));
?>