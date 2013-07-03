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
						<a href="<?php echo BASE_URL; ?>">Home</a> | Review Data
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
			
            <div class="row-fluid sortable">
				<div class="box span8">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-eye-open"></i> Review English Content</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
<form action="<?php echo BASE_URL; ?>/addcontent/contentfailed/<?php echo $this->uri->segment(3); ?>" method="post">
    <section id="main" class="column">
	
        <article class="module">
			<header><h3>English Copy</h3></header>
             
				<div class="module_content">
                	
                  
						<fieldset>
							<label>Product Name</label>
                            
							<input type="text" name="pName" id="pName" required  value="<?php echo $content->prduct_name; ?>" style="width:92%;">
               <input type="hidden" name="pFplid" id="pFplid" required  value="<?php echo $content->fpl_id; ?>" style="width:92%;">
               <input type="hidden" name="pSpenishid" id="pSpenishid" required  value="<?php echo $content->spenish_id; ?>" style="width:92%;">
                            <br />

                            
                            
                            
                            
						</fieldset>
						

               

                       	
			<label>Description</label><br />

							<textarea class="cleditor" rows="12" name="pDesc" id="pDesc" required  style="width:490px;"><?php echo $content->product_description; ?>
                            </textarea>
                            </fieldset><br />
                            <fieldset>
                        
                        
							<label>Product Short Description</label>
							<textarea rows="12" name="finalpsdesc" id="finalpsdesc"  style="width:490px;" class="cleditor"><?php echo $content->short_description; ?></textarea> 
                            
						</fieldset>   <br />
                            
						</fieldset>
                        <fieldset>
							<label>Product Specification</label>
							<textarea rows="12" name="pSpecs" id="pSpecs"  style="width:490px;" class="cleditor"><?php echo $content->product_specs; ?></textarea></fieldset>
                        <fieldset>
							<label>Meta Information</label>
							<table width="100%" border="0">
                            <tr>
                            
    <td>Meta Keywords</td>
    <td>Meta Keywords</td>
                            </tr>
  <tr>
    <td><textarea rows="12" name="metaKeywords" id="metaKeywords"  style="width:400px;"><?php echo $content->product_metatags; ?></textarea></td>
    <td><textarea rows="12" name="metaDescription" id="metaDescription"  style="width:400px;"><?php echo $content->product_metadescription; ?></textarea></td>
  </tr>
</table>
                        </fieldset>
                        <fieldset>
							<label>Height</label>
							<input type="text" name="pHeight" id="pHeight" required  value="<?php echo $content->height; ?>" style="width:92%;"></fieldset>
                        <fieldset>
							<label>Width</label>
							<input type="text" name="pWidth" id="pWidth" required  value="<?php echo $content->width; ?>" style="width:92%;"></fieldset>
                        <fieldset>
							<label>Length</label>
							<input type="text" name="pLength" id="pLength" required  value="<?php echo $content->length; ?>" style="width:92%;"></fieldset>
                        <fieldset>
							<label>Weight</label>
							<input type="text" name="pWeight" id="pWeight" required  value="<?php echo $content->weight; ?>" style="width:92%;"></fieldset>
                        <fieldset>
							<label>Video Link</label>
							<textarea rows="5" name="pVideoLink" id="pVideoLink"  style="width:300px;"><?php echo $content->eng_video; ?></textarea></fieldset>
                        
                        <footer><br />
                        <div class="submit_link">
                        	<input type="submit" value="Save English Content" class="btn btn-small btn-primary" >
                            
                           
                        </div>
                    </footer>
                    
                   
                    
                </div>
		</article><!-- end of post new article -->
        
        
         
       
        
		<div class="spacer"></div>
	</section></form>
					</div>
				</div><!--/span--><!--/span-->
				
			</div><!--/row-->
			
            
                    <div style="text-align:center"></div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		