<?php
if(!empty($rows)){   
  
?>
   <div class="box-module">
	<h4 class="module-heading"><?php echo Yii::t('app','Last Updates');?></h4>
		<div class="module-content">
        <?php
         for($i=0;$i<count($rows);$i++){
            $row    = $rows[$i];      
            $url    = $row->createUrl();
            $title  = $row->title;
            $brief  = $row->brief;
            $imgtop = Article::model()->getThumbArticle($row,644,358);   
            $date_  = StringHelper::ShowTime($row->time_modify);
            ?>            
				<div class="news-box">
						<div class="inner heading">
                        <?php
                         if($row->team_ids!=''){
                            $team_id_tmp = explode(",",$row->team_ids);
                            $team_id = $team_id_tmp[0];
                            $info_home = Team::model()->getTeamDetail($team_id,true);
                            $logo_home = Team::model()->getImageThumb($info_home,120,120);   
                                     
                            ?>
                            <div class="uk-clearfix">
								<img width="40px" alt="" src="<?php echo $logo_home; ?>" class="uk-float-left uk-margin-small-right" />
								<div class="uk-overflow-hidden">
									<strong class="team-name"><?php echo $info_home->name;?></strong>
									<div class="time"><i class="uk-icon-clock-o"></i> <i><?php echo $date_;?></i></div>
								</div>
							 </div>
                            <?php
                        } 
                        ?>
							<a class="title" href="<?php echo $url;?>"><?php echo $title;?></a>
						</div>
						<a href="<?php echo $url;?>" class="image">
							<img alt="samples" src="<?php echo $imgtop; ?>" />
						</a>
						<div class="inner news-summary">
							<div class="desc"><?php echo $brief;?></div>
							<div class="uk-text-right">
								<a href="<?php echo $url;?>" class="read-more"><?php echo Yii::t('app','View more');?> <i class="uk-icon-angle-double-right"></i></a>
							</div>
						</div>
					</div>
            <?php
         }
        ?>                

								

			<!--	<div class="news-box">
					<div class="inner heading hightlight">
						<div class="uk-clearfix">
							<img width="40px" alt="sample" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/samples/club/chelsea-120px.png" class="uk-float-left uk-margin-small-right">
							<div class="uk-overflow-hidden">
								<strong class="team-name">Chelsea</strong>
								<div class="time"><i class="uk-icon-clock-o"></i> <i>30 phút trước</i></div>
							</div>
						</div>
						<a class="title uk-link-reset" href="#">Chelsea vô địch sớm 3 vòng đấu</a>
					</div>
                    
					<div class="match">
						<div class="remainning-time uk-text-center">Còn 50 phút </div>
						<div class="uk-grid uk-flex-space-between uk-grid-collapse clubs-info">
							<div class="uk-width-4-10 uk-text-right">
								<img width="21px" height="21px" alt="sample" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/samples/club/chelsea-41px.png" class="uk-float-right uk-margin-small-left">
								<span class="name">Chelsea FC </span>
							</div>
							<div class="result content-align-middle">
								<strong class="align-center-center">VS</strong>
							</div>
							<div class="uk-width-4-10">
								<img width="21px" height="21px" alt="sample" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/samples/club/manchester-city-41px.png" class=" uk-margin-small-right uk-float-left">
								<span class="name">Chelsea FC </span>
							</div>
						</div>
						<div class="uk-text-center uk-margin-top">
							<a href="#modal-view-ratio" data-uk-modal="" class="uk-button"><i class="uk-icon-bar-chart"></i> Xem tỉ lệ</a>
						</div>
					</div>
				</div>-->
                
                
                
		</div>
  </div>
<?php 
}
?>