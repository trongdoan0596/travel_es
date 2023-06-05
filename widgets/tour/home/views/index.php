<?php
use common\models\Tour;
if(!empty($rows)){
      $i = 0;
      ?>
      <div class="section white-bg">
           <div class="container">
                <div class="text-center description block">
                    <h1>Most Popular Tour Packages</h1>
                    <p>Nunc cursus libero purus ac congue ar lorem cursus ut sed pulvinar massa idend porta nequetiam</p>
                </div>
                <div class="tour-packages row add-clearfix image-box">
                     <?php
          foreach($rows as $row){
              if($row->title!=''){
                $img = Tour::getImage($row);
              }else{
                $img = '';
              }
             $title = $row->title;
             $url = Tour::createUrl($row);
             $num_day = $row->num_day;
             
            // echo '<div class="uk-width-1-2">'.$title.'</div>';
             ?>
             <div class="col-sm-6 col-md-4">
                    <article class="box animated" data-animation-type="fadeInDown">
                        <figure>
                            <a href="<?php echo $url;?>"><img src="<?php echo $img;?>" alt="" /></a>
                            <figcaption>
                                <span class="price"><?php echo $num_day;?> Days</span>
                                <h2 class="caption-title"><?php echo $title;?></h2>
                            </figcaption>
                        </figure>
                    </article>
              </div>
             
            <?php
             $i++;
          }
          ?>
          
                       
                      
                    </div>
                </div>
     </div>
      <?php
}
?>

