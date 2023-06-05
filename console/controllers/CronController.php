<?php 
namespace console\controllers; 
use yii\console\Controller; 
use yii\helpers\Url;
use common\models\Blog; 
use common\models\Blogcate; 
use common\models\Article; 
use common\models\Tourcate;  
use common\models\Tour;   
use common\models\Ourteam;     
use common\models\Review; 
use common\helper\StringHelper;  
    
class CronController extends Controller { 
    public function actionIndex() {
                 $lang = 'es';
                 $domain_root = 'https://authentiktravel.es';
                 $xmldata = '<?xml version="1.0" encoding="utf-8"?>'; 
            	 $xmldata .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
            	 $xmldata .= ' xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" ';
            	 $xmldata .= ' >';
                 $lastmod = date("Y-m-d");   
                 $i=0;	
                 $xmldata .= '<url>';    
                 $xmldata .= ' <loc xml:lang="'.$lang.'">'.$domain_root.'</loc>';   
                 $xmldata .= ' <changefreq>Daily</changefreq>';
                 $xmldata .= ' <priority>1.0</priority>';				  
                 $xmldata .= ' </url>';   
                
                 /*********Article*************/
                 /*********Tourcate*************/
                 $rows = Tourcate::find()->where('status=1 AND id>1')->orderBy('id desc')->all(); 
                 if(!empty($rows)){
                     foreach ($rows as $row) {	
                        	    $id        =  $row->id;
            					if($row->last_update=='0000-00-00 00:00:00'){
                                    $lastmod  = date("Y-m-d",strtotime($row->create_date));
                                }else{
                                    $lastmod  = date("Y-m-d",strtotime($row->last_update));
                                }
                                $titlelink = '#'; 
                                if(trim($row->alias)!=''){
                                        $titlelink  = StringHelper::formatUrlKey($row->alias); 
                                   }else{
                                        $titlelink  = StringHelper::formatUrlKey($row->title);
                                   }      
                                $link      = 'https://authentiktravel.es/'.$titlelink; 
             			    	$xmldata .= '<url>';
            					$xmldata .= ' <loc xml:lang="'.$lang.'">'.$link.'</loc>';
            					//$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
            					$xmldata .= ' <changefreq>Daily</changefreq>';
            					$xmldata .= ' <priority>0.8</priority>';				  
            					$xmldata .= ' </url>';
            					$i++;
                      }        
                 } 
                 /*********Tour*************/
                 $rows = Tour::find()->where('status=1')->orderBy('id desc')->all(); 
                 if(!empty($rows)){
                     foreach ($rows as $row) {	
                        	    $id        =  $row->id;
            					if($row->last_update=='0000-00-00 00:00:00'){
                                    $lastmod  = date("Y-m-d",strtotime($row->create_date));
                                }else{
                                    $lastmod  = date("Y-m-d",strtotime($row->last_update));
                                }
                                $titlelink = '#'; 
                                if(trim($row->alias)!=''){
                                        $titlelink  = StringHelper::formatUrlKey($row->alias); 
                                   }else{
                                        $titlelink  = StringHelper::formatUrlKey($row->title);
                                   }                          
                                $link      = 'https://authentiktravel.es/paquetes-de-viaje/'.$titlelink;                         
             			    	$xmldata .= '<url>';
            					$xmldata .= ' <loc xml:lang="'.$lang.'">'.$link.'</loc>';
            					//$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
            					$xmldata .= ' <changefreq>Daily</changefreq>';
            					$xmldata .= ' <priority>0.8</priority>';				  
            					$xmldata .= ' </url>';
            					$i++;
                      }        
                 } 
                 /*********Blogcate*************/
                 $rows = Blogcate::find()->where('status=1 AND id>1')->orderBy('id desc')->all(); 
                 if(!empty($rows)){
                     foreach ($rows as $row) {	
                        	    $id        =  $row->id;
            					if($row->last_update=='0000-00-00 00:00:00'){
                                    $lastmod  = date("Y-m-d",strtotime($row->create_date));
                                }else{
                                    $lastmod  = date("Y-m-d",strtotime($row->last_update));
                                }
                                $titlelink = '#'; 
                                if(trim($row->alias)!=''){
                                        $titlelink  = StringHelper::formatUrlKey($row->alias); 
                                   }else{
                                        $titlelink  = StringHelper::formatUrlKey($row->title);
                                   }      
                                $link      = 'https://authentiktravel.es/blog-de-viajes-vietnam/'.$titlelink;                      
             			    	$xmldata .= '<url>';
            					$xmldata .= ' <loc xml:lang="'.$lang.'">'.$link.'</loc>';
            					//$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
            					$xmldata .= ' <changefreq>Daily</changefreq>';
            					$xmldata .= ' <priority>0.8</priority>';				  
            					$xmldata .= ' </url>';
            					$i++;
                      }        
                 } 
                 /*********Blog*************/
                 $rows = Blog::find()->where('status=1')->orderBy('id desc')->all(); 
                 if(!empty($rows)){
                     foreach ($rows as $row) {	
                        	    $id        =  $row->id;
            					if($row->last_update=='0000-00-00 00:00:00'){
                                    $lastmod  = date("Y-m-d",strtotime($row->create_date));
                                }else{
                                    $lastmod  = date("Y-m-d",strtotime($row->last_update));
                                }
                                $titlelink = '#'; 
                                if(trim($row->alias)!=''){
                                        $titlelink  = StringHelper::formatUrlKey($row->alias); 
                                   }else{
                                        $titlelink  = StringHelper::formatUrlKey($row->title);
                                   }      
                                $link      = 'https://authentiktravel.es/'.$titlelink; 
                                //$link      = 'http://authentikvietnam.com/'.Blog::createUrl($row);
             			    	$xmldata .= '<url>';
            					$xmldata .= ' <loc xml:lang="'.$lang.'">'.$link.'</loc>';
            					//$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
            					$xmldata .= ' <changefreq>Daily</changefreq>';
            					$xmldata .= ' <priority>0.8</priority>';				  
            					$xmldata .= ' </url>';
            					$i++;
                      }        
                 }    
               //Review  
                    $rows = Review::find()->where('status=1')->orderBy('id desc')->all(); 
                    if(!empty($rows)){
                             foreach ($rows as $row) {	
                                	    $id  =  $row->id;
                    					if($row->last_update=='0000-00-00 00:00:00'){
                                            $lastmod  = date("Y-m-d",strtotime($row->create_date));
                                        }else{
                                            $lastmod  = date("Y-m-d",strtotime($row->last_update));
                                        }
                                        $titlelink = '#'; 
                                        if(trim($row->alias)!=''){
                                                $titlelink  = StringHelper::formatUrlKey($row->alias); 
                                           }else{
                                                $titlelink  = StringHelper::formatUrlKey($row->title);
                                        }                            
                                        $link      = 'https://authentiktravel.es/comentarios-de-clientes/'.$titlelink;                           
                     			    	$xmldata .= '<url>';
                    					$xmldata .= ' <loc xml:lang="'.$lang.'">'.$link.'</loc>';
                    					//$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
                    					$xmldata .= ' <changefreq>Daily</changefreq>';
                    					$xmldata .= ' <priority>0.8</priority>';				  
                    					$xmldata .= ' </url>';
                    					$i++;
                              }        
                         }
                /*********ourteam*************/
                $rows = Ourteam::find()->where('status=1')->orderBy('id desc')->all(); 
                 if(!empty($rows)){
                     foreach ($rows as $row) {	
                        	    $id        =  $row->id;
            					if($row->last_update=='0000-00-00 00:00:00'){
                                    $lastmod  = date("Y-m-d",strtotime($row->create_date));
                                }else{
                                    $lastmod  = date("Y-m-d",strtotime($row->last_update));
                                }
                                $titlelink  = StringHelper::formatUrlKey($row->title);                       
                                $link      = 'https://authentiktravel.es/equipo-de-authentik-travel/'.$id.'/'.$titlelink;                   
             			    	$xmldata .= '<url>';
            					$xmldata .= '<loc xml:lang="'.$lang.'">'.$link.'</loc>';
            					//$xmldata .= '<lastmod>'.$lastmod.'</lastmod>';
            					$xmldata .= '<changefreq>Daily</changefreq>';
            					$xmldata .= '<priority>0.8</priority>';				  
            					$xmldata .= '</url>';
            					$i++;
                      }        
                 }
             
             
         
             $xmldata .= '<url>';
             $xmldata .= ' <loc xml:lang="'.$lang.'">'.$domain_root.'/paquetes-de-viaje</loc>';
             //$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
             $xmldata .= ' <changefreq>Daily</changefreq>';
             $xmldata .= ' <priority>0.8</priority>';				  
             $xmldata .= ' </url>'; 
             $xmldata .= '<url>';
             $xmldata .= ' <loc xml:lang="'.$lang.'">'.$domain_root.'/comentarios-de-clientes</loc>';
             //$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
             $xmldata .= ' <changefreq>Daily</changefreq>';
             $xmldata .= ' <priority>0.8</priority>';				  
             $xmldata .= ' </url>'; 
             $xmldata .= '<url>';
             $xmldata .= ' <loc xml:lang="'.$lang.'">'.$domain_root.'/equipo-de-authentik-travel</loc>';
             //$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
             $xmldata .= ' <changefreq>Daily</changefreq>';
             $xmldata .= ' <priority>0.8</priority>';				  
             $xmldata .= ' </url>';    
             $xmldata .= '<url>';
             $xmldata .= ' <loc xml:lang="'.$lang.'">'.$domain_root.'/antes-del-viaje</loc>';
             //$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
             $xmldata .= ' <changefreq>Daily</changefreq>';
             $xmldata .= ' <priority>0.8</priority>';				  
             $xmldata .= ' </url>';
             $xmldata .= '<url>';          
             $xmldata .= ' <loc xml:lang="'.$lang.'">'.$domain_root.'/blog-de-viaje-vietnam-myanmar</loc>';
             //$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
             $xmldata .= ' <changefreq>Daily</changefreq>';
             $xmldata .= ' <priority>0.8</priority>';				  
             $xmldata .= ' </url>'; 
             $xmldata .= '<url>';    
             $xmldata .= ' <loc xml:lang="'.$lang.'">'.$domain_root.'/contacta-con-nosotros</loc>';
             //$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
             $xmldata .= ' <changefreq>Daily</changefreq>';
             $xmldata .= ' <priority>0.8</priority>';				  
             $xmldata .= ' </url>'; 
             $xmldata .= '<url>';    
             $xmldata .= ' <loc xml:lang="'.$lang.'">'.$domain_root.'/sobre-nuestros-servicios</loc>';
             //$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
             $xmldata .= ' <changefreq>Daily</changefreq>';
             $xmldata .= ' <priority>0.8</priority>';				  
             $xmldata .= ' </url>';  
             $xmldata .= '<url>';     
             $xmldata .= ' <loc xml:lang="'.$lang.'">'.$domain_root.'/antes-del-viaje</loc>';
             //$xmldata .= ' <lastmod>'.$lastmod.'</lastmod>';
             $xmldata .= ' <changefreq>Daily</changefreq>';
             $xmldata .= ' <priority>0.8</priority>';				  
             $xmldata .= ' </url>';       
             $xmldata .= '</urlset>';
             if(file_put_contents('/home/ngoctudinh/authentiktravel.es/sitemap.xml',$xmldata)){	
                    ini_set('memory_limit','8M');   
                    echo "DONE :".($i);            
             }   
        
        
    } 
    public function actionMail($to) {
        echo "Sending mail to " . $to;
    } 
}
/*
/usr/local/bin/php -q /public_html/<YOUR_PROJECT_FOLDER_NAME> yii <CONTROLLER_NAME>/<ACTION_NAME>
/usr/local/bin/php -q /home/ngoctudinh/authentiktravel.es/yii cron/index
*/