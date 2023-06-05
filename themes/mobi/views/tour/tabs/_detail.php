<div class="boxitem yourdetail">
    <h1><?php echo Yii::t('app', 'Your Details');?></h1>
     <ul class="uk-list">
        <li>
        <label><?php echo Yii::t('app', 'Title');?></label>
            <select name="slcgender">
                 <option value="M">M</option>
                 <option value="Mme">Mme</option>
                  <option value="Mlle">Mlle</option>
            </select> 
        </li>      
       <li>     
         <?php echo $form->field($model,'name')->textInput(array('class' =>'uk-form-width-medium'));?>
        </li>
        <li>
           <?php echo $form->field($model,'address')->textInput(array('class' =>'uk-form-width-large'));?>
        </li>
        <li>
           <?php echo $form->field($model,'postalcode')->textInput(array('class' =>'uk-form-width-medium'));?>         
        </li>
        <li>
          <?php echo $form->field($model,'city')->textInput(array('class' =>'uk-form-width-medium'));?>         
        </li>
        <li>
          <?php echo $form->field($model,'phone')->textInput(array('class' =>'uk-form-width-medium'));?>          
        </li>
        <li>
           <?php echo $form->field($model,'nationality')->textInput(array('class' =>'uk-form-width-medium'));?>           
        </li>
        <li>
           <?php echo $form->field($model,'email')->textInput(array('class' =>'uk-form-width-medium'));?>          
        </li>
         <li>
          <?php echo $form->field($model,'confirmemail')->textInput(array('class' =>'uk-form-width-medium'));?>          
        </li>
    </ul>   
</div>