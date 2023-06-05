<?php
if(!empty($rows)){    
?>
<div class="box-module">	
	 <div class="module-content">
          <ul class="list-news">
        <?php
         for($i=0;$i<count($rows);$i++){
            $row    = $rows[$i];      
            $url    = $row->createUrl();
            $title  = $row->title;
            $brief  = $row->brief;
            $img    = Article::model()->getThumbArticle($row,644,358);   
            $date_  = StringHelper::ShowDate($row->time_modify);
            ?>            
			   <li><a href="<?php echo $url;?>">
					<h4 class="title"><?php echo $title;?></h4></a>
					<div class="uk-clearfix">
						<a href="<?php echo $url;?>">
                           <img alt="<?php echo $title;?>" src="<?php echo $img;?>" class="uk-align-medium-left" style="width: 262px;height:126px;" />						
                        </a>
                        <?php echo $brief;?>
					</div>
					<div class="date-time"><?php echo $date_;?></div>
				</li>
            <?php
         }
        ?>
           </ul>
		</div>
</div>
  <?php $this->widget('CLinkPager', array(
                        'pages' => $pages,
                        'firstPageLabel'=>'<i class="uk-icon-angle-double-left"></i>',
                        'prevPageLabel'=>false,
                        'lastPageLabel'=>false,
                        'nextPageLabel'=>'<i class="uk-icon-angle-double-right"></i>',
                        'selectedPageCssClass'=>'uk-active',
                        'header'=>'',
                        'htmlOptions'=>array('class'=>'uk-pagination uk-pagination-right')
                    )) ?> 
<?php 
}
?>