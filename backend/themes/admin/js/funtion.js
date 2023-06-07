$(document).ready(function(){
     $(document).on('click','.href_class', function(){
          $(this).parent().toggleClass('active');
     });
});