<div class="related-news-box">
	<h3><?php echo  Yii::t('app','Related News');?></h3>
	<ul class="list-news-related">
    <?php
     if(!empty($rows)){ 
         foreach ($rows as $row) {
            $title = $row['title'];
            $linkArt = Yii::app()->createUrl('article/view',array('id'=>$row['id'],'title'=>StringHelper::helper()->formatUrlKey($title)));
              
            ?>
           	<li><a href="<?php echo $linkArt;?>"><?php echo $title;?></a></li>
         <?php            
         }   
       }
  ?>
	</ul>
</div>