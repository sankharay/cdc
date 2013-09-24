
<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			<form action="" method="post">
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
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-eye-open"></i> Review English Content</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">

    <section id="main" class="column">
	
        <article class="module width_half">
			<header><h3>Spanish Copy</h3></header>
             
				<div class="module_content">
						<fieldset>
							<label>Product Name&nbsp;&nbsp;</label>
                            <input type="text" name="pName" id="pName" required  value="<?php echo $spanish_content->prduct_name; ?>" style="width:92%;"></fieldset>
						<fieldset>
							<label>Product Sku&nbsp;&nbsp;</label>
                            <input type="text" name="pSku" id="pSku" required  value="<?php echo $spanish_content->product_sku; ?>" style="width:92%;"></fieldset>
						<fieldset>
							<label>Product UPC&nbsp;&nbsp;</label>
                            <input type="text" name="pUpc" id="pUpc" required  value="<?php echo $spanish_content->product_upc; ?>" style="width:92%;"></fieldset>
						

<fieldset>
                        
                        
							<label>Product Short Description&nbsp;&nbsp;</label>
							<textarea rows="12" name="pShortDesc" id="pShortDesc"  style="width:100%;" class="cleditor">
<?php echo substr($spanish_content->product_description,0,200); ?>
</textarea>                   

                       	
			<label>Description </label><br />

							<textarea rows="12" name="pDesc" id="pDesc" style="width:90%;" class="cleditor">
  <?php echo $spanish_content->product_description; ?>                          	
                            </textarea>
                            </fieldset><br />
                            
						</fieldset>
                        
                        <fieldset>
                        
                            
                            
							<label>Product Specification&nbsp;&nbsp;</label>
							<textarea rows="12" name="pSpecs" id="pSpecs"  style="width:490px;" class="cleditor">
  <?php echo str_replace("\n", '<br/>', $spanish_content->product_specs); ?>
                            </textarea>
                            
                            
						</fieldset>
                        <fieldset>
                        
                            
                            
							<table width="100%" border="0">
  <tr>
    <td><label>Product Metakeywords&nbsp;&nbsp;</label>
							<textarea rows="12" name="pMetatags" id="pMetatags" class="span12"  >
  <?php echo $spanish_content->product_metatags; ?>
                            </textarea></td>
    <td><label>Product MetaDescription&nbsp;&nbsp;</label>
							<textarea rows="12" name="pMetadescription" id="pMetadescription" class="span12"  >
  <?php echo $spanish_content->product_metadescription; ?>
                            </textarea></td>
  </tr>
</table>

                            
                            
						</fieldset>
                        <footer><br />
                        
                    </footer>
                    
                   
                    
                </div>
		</article><!-- end of post new article -->
        
        
         
       
        
		<div class="spacer"></div>
	</section>
					</div>
				</div><!--/span--><!--/span-->
				
			</div><!--/row-->
			
            
                    <div style="text-align:center"><input type="submit" value=" Final Product Submit" class="btn btn-large btn-primary"></div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		
                    </form>