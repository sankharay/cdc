<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			<div id="content" class="span10">
			<!-- content starts -->
				

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> 
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Product Wizard</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
<form action="<?php echo BASE_URL; ?>/addcontent/addenglishready/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>" method="POST">
                        <input type="hidden" name="pSku" value="<?php echo $content['psku'][0]?>">
                        <input type="hidden" name="brand" value="<?php echo $content['brand'][0]?>" />
                        <input type="hidden" name="pSource" value="<?php echo $content['psource'][0]?>" />
                        <input type="hidden" value="<?php echo $content['pupc'][0]?>" name="pupc" id="upc" />
    

                        
<div class="alert-green alert-info-green">Product Title</div>
                        <div id="step1" class="steps">
                        
                        <?php $num = sizeof($content['pname']);
					//		echo $num;

//							print_r($content);
							
						?>
                       	<div class="tab_container">
                            <table cellspacing="0" width="100%"> 
                                    <thead> 
                                        <tr> 
                                            <th>Sources:</th> 
                                            <?php for($i=0;$i<$num;$i++){?>
                                            <th><?php echo $content['psource'][$i]?></th>
                                            <?php }?>
                                            <th align="left">Final Copy</th>
                                            
                                            
                                            </tr>
                                            </thead>
                                       <tbody> 
                                      

                        
										<tr>
                                        <td>Product Name</td>
										<td valign="top">
										<?php for($i=0;$i<$num;$i++){?>
                                        <span class="checked">
                                         <label class="radio"><input type="radio" required name="pname" id="pnm<?php echo $i?>" onclick="return placevalue('pnm<?php echo $i?>','pname')" value="<?php echo $content['pname'][$i]?>"></label></span><?php echo $content['pname'][$i]?><br />         <?php }?>                              	
            </td>                            <td valign="top"><input type="text" name="pName" id="pname" value="" /> </td>                                       	                                         
                                         </tr>
                                         
                                    
                                         
                                       </tbody>
                                       
                                       </table>
                   
                   		<div id="backforth">
                        
                        	<div id="back">
                            	
                            </div>
                            <div id="forward" style="float:right;">
                                <img src="<?php echo BASE_URL; ?>/img/next.jpg" onClick="return nextStep('step2')"/>                            
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                    </div>
                    </div>
                    
                    <div class="alert-green alert-info-green">Product Description</div>
                    <div id="step2" class="steps">
                     			 	<div class="tab_container">
                            <table width="100%" class="tablesorter" cellspacing="0"> 
                                    <thead> 
                                        <tr> 
                                            <th width="10%">Sources:</th> 
<?php for($i=0;$i<$num;$i++){?>
<th width="25%"><?php echo $content['psource'][$i]?></th>
<?php }?>
                                            <th width="30%" align="left">Final Copy</th>
                                           
                                        </tr>
                                   </thead>
                                   <tbody> 
                                       		 
                                         <tr>
                                        <td valign="top">Product Description</td><td valign="top">
										<?php for($i=0;$i<$num;$i++){?>
										<label class="radio"><input type="radio" required name="pdesc"  onclick="return placehtml('dsc<?php echo $i?>','pdesc')"></label>
<div id="dsc<?php echo $i?>"><?php echo $content['pdesc'][$i]; ?></div><br /><?php }?></td>                  	
<td valign="top"><textarea name="pDesc" id="pdesc" class="cleditor"></textarea></td>
                                         
                                         </tr>
                                          
                                      </tbody>
                           </table>
                           
                           <div id="backforth">
                        	<div id="back">
                            	<img src="<?php echo BASE_URL; ?>/img/previous.jpg" onClick="return nextStep('step1')" />
                            </div>
                            <div id="forward">
                                <img src="<?php echo BASE_URL; ?>/img/next.jpg" onClick="return nextStep('step3')"/>                            
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                           
                    </div>
                    
                    </div>
<!-- short descrition -->
<div class="alert-green alert-info-green">Short Description</div>
                    <div id="step3" class="steps">
                     			 	<div class="tab_container">
                            <table width="100%" class="tablesorter" cellspacing="0"> 
                                    <thead> 
                                        <tr> 
                                            <th width="10%">Sources:</th> 
<?php for($i=0;$i<$num;$i++){?>
<th width="25%"><?php echo $content['psdesc'][$i]?></th>
<?php }?>
                                            <th width="30%" align="left">Final Copy</th>
                                           
                                        </tr>
                                   </thead>
                                   <tbody> 
                                       		 
                                         <tr>
                                        <td valign="top">Short Description</td><td valign="top">
										<?php for($i=0;$i<$num;$i++){?>
										<label class="radio"><input type="radio" required name="pdesc"  onclick="return placehtml('psdsc<?php echo $i?>','psdesc')"></label>
<div id="psdsc<?php echo $i?>"><?php echo substr($content['pdesc'][$i],0,100); ?></div><br /><?php }?></td>       	
<td valign="top"><textarea name="finalpsdesc" id="psdesc" class="cleditor"></textarea></td>
                                         
                                         </tr>
                                          
                                      </tbody>
                           </table>
                           
                           <div id="backforth">
                        	<div id="back">
                            	<img src="<?php echo BASE_URL; ?>/img/previous.jpg" onClick="return nextStep('step2')" />
                            </div>
                            <div id="forward">
                                <img src="<?php echo BASE_URL; ?>/img/next.jpg" onClick="return nextStep('step4')"/>                            
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                           
                    </div>
                    
                    </div>
<!-- short description starts -->
                    <div class="alert-green alert-info-green">Product Specifications</div>
                           <div id="step4" class="steps">
                           <div>
                           		<a href="index.php/maketable" id="various3" target="_blank"></a>
                           </div>
                     			 	<div class="tab_container">
                            <table width="100%"  class="tablesorter" cellspacing="0"> 
                                    <thead> 
                                        <tr> 
                                            <th>Sources:</th> 
                                           <?php for($i=0;$i<$num;$i++){?>
                                            <th><?php echo $content['psource'][$i]?></th>
                                            <?php }?>
                                            <th align="left">Final Copy</th>
                                            </tr>
                                            </thead>
                                       <tbody> 
                                       		 
                                         <tr>
                                        <td valign="top">Product Specifications</td>
										 <?php for($i=0;$i<$num;$i++){?>
										<td valign="top"><label class="radio"><input type="radio" required name="pspecs" onclick="return placehtml('spc<?php echo $i?>','specs')" value="<?php echo $content['pspecs'][0]?>"></label><div id="spc<?php echo $i?>">  <?php echo htmlspecialchars_decode($content['pspecs'][$i])?></div></td>   
                                        <?php }?>                                    	
<td valign="top">
<textarea name="pSpecs" id="specs" class="cleditor"></textarea></td>
                                         
                                         </tr>
                                           
                                      </tbody>
                           </table>
                           
                           <div id="backforth">

                        	<div id="back">
                            	<img src="<?php echo BASE_URL; ?>/img/previous.jpg" onClick="return nextStep('step3')" />
                            </div>
                            <div id="forward">
                                <img src="<?php echo BASE_URL; ?>/img/next.jpg" onClick="return nextStep('step5')"/>                            
                            </div>
                            </div>
                            <div id="forward">
                                
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                           
                           
                    </div>


<!-- short description ends -->
<!-- meta keywords and description starts -->
                    <div class="alert-green alert-info-green">Product Meta Information</div>
                           <div id="step5" class="steps">
                           <div>
                           		
                           </div>
                     			 	<div class="tab_container">
                            <table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td>Meta Keywords</td>
    <td>&nbsp;</td>
    <td>Meta Description</td>
  </tr>
  <tr>
    <td><textarea style="width:100%;height:150px;" name="mKeywords" id="mKeywords" required="required"></textarea></td>
    <td>&nbsp;</td>
    <td><textarea style="width:100%;height:150px;" name="mDescription" id="mDescription" required="required"></textarea></td>
  </tr>
</table>

                           
                           <div id="backforth">

                        	<div id="back">
                           	  <img src="<?php echo BASE_URL; ?>/img/previous.jpg" onClick="return nextStep('step4')" />
                            </div>
                            <div id="forward">
                              <img src="<?php echo BASE_URL; ?>/img/next.jpg" onClick="return nextStep('step6')"/>                            
                            </div>
                            </div>
                            <div id="forward">
                                
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                           
                           
                    </div>


<!-- meta keywords and description ends -->
                    <div class="alert-green alert-info-green">Product Particulars</div>
                           <div id="step6" class="steps">
                           <div>
                           		<a href="index.php/maketable" id="various3" target="_blank"></a>
                           </div>
                     			 	<div class="tab_container">
                            <table width="100%" border="0">
                            <tr><td width="48%">&nbsp;</td>
                            <td width="52%">Add Video Link</td></tr>
  <tr>
    <td><table width="100%" border="0">
  <tr>
    <td>Height</td>
    <td><input type="text" name="pHeight" id="pHeight" value="<?php echo $content['height'][0]; ?>" required="required" /></td>
  </tr>
  <tr>
    <td>Width</td>
    <td><input type="text" name="pWidth" id="pWidth" value="<?php echo $content['width'][0]; ?>" required="required" /></td>
  </tr>
  <tr>
    <td>Length</td>
    <td><input type="text" name="pLength" id="pLength" value="<?php echo $content['weight'][0]; ?>"  required="required"/></td>
  </tr>
  <tr>
    <td>Weight</td>
    <td><input type="text" name="pWeight" id="pWeight" value="<?php echo $content['length'][0]; ?>" required="required" /></td>
  </tr>
</table></td>
    <td><textarea style="width:95%;height:100px; margin-right:5px;" name="pVideoLink" id="pVideoLink"></textarea></td>
  </tr>
</table>


                           
                           <div id="backforth">
                        	<div id="back">
                            	<img src="<?php echo BASE_URL; ?>/img/previous.jpg" onClick="return nextStep('step5')" />
                            </div>
                            <div id="forward">
                                
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                           
                           
                    </div>
                    </div>
<!-- product meta and description -->
                           
<!-- product meta and description -->
                   <div id="stepwer" class="stepsd">
                    
                    
                    	
                        
                    	<div id="backforth" align="center">
              <input class="btn btn-primary" type="submit" value=" Submit Product ">
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    
                    
		       </form>
					</div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>