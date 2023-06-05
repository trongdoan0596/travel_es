<?php
if(!empty($row)){
   if($row->status==1){
    ?>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org","@type": "WebPage","aggregateRating":{"@type": "AggregateRating","ratingValue": "<?php echo $row->rating_value;?>","ratingCount": "<?php echo $row->rating_count;?>","bestRating": "<?php echo $row->bestrating;?>","worstRating": "<?php echo $row->worst_rating;?>"}
    }
    </script>   
    <?php
   }
}   
?>