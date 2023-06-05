<?php
use common\models\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<style>
#menu-country_ids  {
    display: inline-block;
    height: 30px;
}
#menu-country_ids label {
    display: inline-block;
    float: left;
    width: 70px;
    
}
</style>
<div class="uk-grid">
    <div class="uk-width-1-3">
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'alias')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
             <div class="control-group" id="cityid">
            		  <div class="controls">
                      <?php
                       echo $form->field($model,'parent_id')->dropDownList($allmenu,array('prompt'=>'-Choose a Parent-'));
                      ?>
            		  </div>
                </div>
            <div class="control-group">
                <div class="controls" >
                    <?php 
                    echo $form->field($model,'type')->dropDownList(array(Menu::MENU_TYPE_ACTICLE =>'Article',Menu::MENU_TYPE_ACTICLE_CATE => 'Article Category',Menu::MENU_TYPE_TOUR => 'Tour',Menu::MENU_TYPE_TOUR_CATE => 'Tour Category',Menu::MENU_TYPE_BLOG_CATE => 'Blog Category'),array('onchange'=>'ChangeType(this.value)','prompt'=>'-Select Type-'));
                    ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls" >
                    <?php  echo $form->field($model,'cate_id')->dropDownList(array(1=>'Menu Top',2=>'Menu Left',3=>'Menu Right',4=>'Menu Footer',5=>'Menu Blog'),array('prompt'=>'-Select Category Menu-'));?>
                </div>
            </div>
             <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'url')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
           <!--<div class="control-group">
                <div class="controls">
                    <?php
                      //$model->country_ids = explode(",", $model->country_ids);
                      //echo $form->field($model,'country_ids')->checkboxList(ArrayHelper::map($country, 'id','name'));
                    ?>
                </div>
             </div> -->
    </div>
     <div class="uk-width-1-3">
               <div class="control-group">
                            <div class="controls" >
                                <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
                            </div>
                        </div>
                       <div class="control-group">
                            <div class="controls" >
                                <?php 
                                echo $form->field($model,'ext_id')->dropDownList($ext_id_arr,array('prompt'=>'-Select Extend ID-'));
                                ?>
                            </div>
                        </div>            
                        <div class="control-group">
                            <div class="controls" >
                                <?php echo $form->field($model,'device')->dropDownList(array(0 => 'Web',1 => 'Mobile'));?>
                            </div>
                        </div>            
                        <div class="control-group">
                            <div class="controls">
                                <?php echo $form->field($model,'ordering')->textInput(array('class' =>'form-control'));?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <?php echo $form->field($model,'tmp')->textInput(array('class' =>'form-control'));?>
                            </div>
              </div>
    </div>
     <div class="uk-width-1-3">
          <div class="control-group">
                <?php //$form->field($model,'img')->label('img'); ?>    
                <div class="controls">
                     <?php echo $form->field($model,'img')->fileInput(); ?>
                      <?php if ($model->img) { ?>
                        <img height="120" width="120" src="<?php echo $model->getImg($model); ?>"  />
                    <?php } ?>
                </div>
            </div>
    </div>
</div>
<script>
function ChangeType(type_id){   
     var Url = "<?php echo Url::to(array('menu/changetype'));?>";
      $.ajax({
			type: "POST",
			url: Url,
			data: ({"type_id":type_id}),
			dataType: "json"			
			}).done(function( data ) {	
			 
                if(data['data']!=''){
                    $("#menu-ext_id").html(data['data']);
                }
			});
    
}
</script>