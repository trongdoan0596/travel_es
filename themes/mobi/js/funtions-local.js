function Addmapdes(txtdes,pos){
    //add them destination     
     if(txtdes!=''){        
        switch (pos) {
              case "vietnam":
                    var vietnammap = $('#customizeform-vietnammap').val();
                    if(vietnammap!=''){
                         var arr = vietnammap.split('[-|-]');
                         var tmp = arr.indexOf(txtdes); 
                         if(tmp==-1){                            
                            //chua co trong mang
                             var vietnamid = parseInt($('#vietnamid').val())+1; 
                             $('#vietnamid').val(vietnamid); 
                             $('#vietnammap').append('<li id="vietnam_'+vietnamid+'" class="uk-float-left">'+txtdes+'<i class="uk-icon-times" onclick="RemoveDesChoose('+vietnamid+',\'vietnam\');" ></i></li>');
                             $('#customizeform-vietnammap').val(vietnammap+'[-|-]'+txtdes);
                         }else{
                              alert('Sorry, you have selected this place!');//Sorry,This element already exists!
                         }                        
                    }else{
                         var vietnamid = parseInt($('#vietnamid').val())+1; 
                         $('#vietnamid').val(vietnamid); 
                         $('#vietnammap').append('<li id="vietnam_'+vietnamid+'" class="uk-float-left">'+txtdes+'<i class="uk-icon-times" onclick="RemoveDesChoose('+vietnamid+',\'vietnam\');" ></i></li>');
                         $('#customizeform-vietnammap').val(txtdes);
                    }
                break;
              case "laos":
                    var laosmap = $('#customizeform-laosmap').val();
                    if(laosmap!=''){
                         var arr = laosmap.split('[-|-]');
                         var tmp = arr.indexOf(txtdes); 
                         if(tmp==-1){                            
                            //chua co trong mang
                             var laosid = parseInt($('#laosid').val())+1; 
                             $('#laosid').val(laosid); 
                             $('#laosmap').append('<li id="laos_'+laosid+'" class="uk-float-left">'+txtdes+'<i class="uk-icon-times" onclick="RemoveDesChoose('+laosid+',\'laos\');" ></i></li>');
                             $('#customizeform-laosmap').val(laosmap+'[-|-]'+txtdes);
                         }else{
                             alert('Sorry, you have selected this place!');
                         }
                    }else{
                        $('#customizeform-laosmap').val(txtdes);
                        var laosid = parseInt($('#laosid').val())+1; 
                        $('#laosid').val(laosid); 
                        $('#laosmap').append('<li id="laos_'+laosid+'" class="uk-float-left">'+txtdes+'<i class="uk-icon-times" onclick="RemoveDesChoose('+laosid+',\'laos\');" ></i></li>');
                    }                    
                break;
              case "cambodia":
                    var cambodiamap = $('#customizeform-cambodiamap').val();
                    if(cambodiamap!=''){
                         var arr = cambodiamap.split('[-|-]');
                         var tmp = arr.indexOf(txtdes); 
                         if(tmp==-1){                            
                            //chua co trong mang
                             var cambodiaid = parseInt($('#cambodiaid').val())+1;                    
                             $('#cambodiaid').val(cambodiaid); 
                             $('#cambodiamap').append('<li id="cambodia_'+cambodiaid+'" class="uk-float-left">'+txtdes+'<i class="uk-icon-times" onclick="RemoveDesChoose('+cambodiaid+',\'cambodia\');" ></i></li>');
                             $('#customizeform-cambodiamap').val(cambodiamap+'[-|-]'+txtdes);
                        }else{
                             alert('Sorry, you have selected this place!');
                         }                        
                    }else{
                        $('#customizeform-cambodiamap').val(txtdes);
                        var cambodiaid = parseInt($('#cambodiaid').val())+1;                    
                        $('#cambodiaid').val(cambodiaid); 
                        $('#cambodiamap').append('<li id="cambodia_'+cambodiaid+'" class="uk-float-left">'+txtdes+'<i class="uk-icon-times" onclick="RemoveDesChoose('+cambodiaid+',\'cambodia\');" ></i></li>');
                    }
                
                break;
              case "other":
                        var mapothertxt = $('#customizeform-mapother').val();
                        if(mapothertxt!=''){
                             var arr = mapothertxt.split('[-|-]');
                             var tmp = arr.indexOf(txtdes); 
                             if(tmp==-1){                            
                                //chua co trong mang
                                var otherid = parseInt($('#otherid').val())+1; 
                                $('#otherid').val(otherid); 
                                $('#otherdes').append('<li id="other_'+otherid+'" class="uk-float-left">'+txtdes+'<i class="uk-icon-times" onclick="RemoveDesChoose('+otherid+',\'other\');" ></i></li>');
                                $('#addtxtdes').val(''); 
                                $('#customizeform-mapother').val(mapothertxt+'[-|-]'+txtdes);
                            }else{
                                alert('Sorry, you have selected this place!');
                             }                             
                        }else{
                            var otherid = parseInt($('#otherid').val())+1; 
                            $('#otherid').val(otherid); 
                            $('#otherdes').append('<li id="other_'+otherid+'" class="uk-float-left">'+txtdes+'<i class="uk-icon-times" onclick="RemoveDesChoose('+otherid+',\'other\');" ></i></li>');
                            $('#addtxtdes').val(''); 
                            $('#customizeform-mapother').val(txtdes);
                        }
                break;
        }

    
     }             
}
function RemoveDesChoose(id,pos){    
      switch (pos) {
              case "vietnam":
                      var vietnamtxt = $("#customizeform-vietnammap").val(); 
                      if(vietnamtxt!=''){
                         var arr = vietnamtxt.split('[-|-]');
                        // arr.splice(id,1);  
                         delete arr[id];
                         var txtnew =  arr.join('[-|-]');
                         $('#customizeform-vietnammap').val(txtnew);
                         $("#vietnam_"+id).remove();  
                      }
                 break;
              case "laos":
                      var laostxt = $("#customizeform-laosmap").val();                 
                      if(laostxt!=''){
                         var arr = laostxt.split('[-|-]');                       
                         delete arr[id];
                         var txtnew =  arr.join('[-|-]');
                         $('#customizeform-laosmap').val(txtnew);
                         $("#laos_"+id).remove();  
                      }
                break;
              case "cambodia":
                      var cambodiatxt = $("#customizeform-cambodiamap").val();
                      if(cambodiatxt!=''){
                         var arr = cambodiatxt.split('[-|-]');                       
                         delete arr[id];
                         var txtnew =  arr.join('[-|-]');
                         $('#customizeform-cambodiamap').val(txtnew);
                         $("#cambodia_"+id).remove();  
                      }
                break;
              case "other":
                      var txtmapother = $("#customizeform-mapother").val(); 
                      if(txtmapother!=''){
                         var arr = txtmapother.split('[-|-]');
                        // arr.splice(id,1);  
                         delete arr[id];
                         var txtnew =  arr.join('[-|-]');
                         $('#customizeform-mapother').val(txtnew);
                         $("#other_"+id).remove();  
                      }
                break;
        }
      
}
function ShowFullTxt(id){    
     $("#readmore_"+id).fadeOut(600);
     $("#fulltxtreview_"+id).fadeIn(400);
}
function HideFullTxt(id){    
     $("#readmore_"+id).fadeIn(400);
     $("#fulltxtreview_"+id).fadeOut(600);     
}
/*hien thi them thong tin*/
function ShowFull(id){    
     $("#readmore_"+id).fadeOut();
     $("#fulltxthide_"+id).fadeIn(600);
}
function FilterCate(){
     var urlcate = $('#slccate').val(); 
     var slcstartfrom = $('#slcstartfrom').val(); 
     $('#frmcate').removeAttr('action');
     var host = document.location.hostname;  
     var url_submit = '#';
     if(host=='localhost'){
        url_submit = 'http://'+host+urlcate+'?startfrom='+slcstartfrom;
     }else{
        url_submit = 'http://'+host+urlcate+'?startfrom='+slcstartfrom;
     }
     $(location).attr('href',url_submit);  
}
function HideAccordion(id){   
     var accordion = UIkit.accordion(UIkit.$('#accordion_'+id),{collapse: false,showfirst:false});
     $('#accordion_'+id).find('[aria-expanded]').attr('aria-expanded','false');      
     $('#accordion_'+id).find('[data-wrapper]').attr('data-wrapper','false').css({height:'0px', position:'relative',overflow:'hidden'}); 
     $('#accordion_'+id+' .uk-accordion-content').removeClass('uk-active'); 
     $('#accordion_'+id+' .uk-accordion-title').removeClass('uk-active');
}