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
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-eye-open"></i> Review English Content</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					<?php 
		$sql = "select * from finalproductlist where product_sku = '".$sku."'";
		$re = mysql_query($sql);
		$row = mysql_fetch_array($re);
		
		
		$sp = "select * from spenishdata where product_sku = '".$sku."'";
		$re1 = mysql_query($sp);
		$sprow = mysql_fetch_array($re1);
	?>

    <section id="main" class="column">
	
        <article class="module width_half">
			<header><h3>English Copy</h3></header>
             
				<div class="module_content">
                	
                  
						<fieldset>
							<label>Product Name</label>
                            
							<input type="text" name="pName" id="pName" required  value="<?php echo $row['prduct_name']?>">
               <button value="Translate" class="btn btn-mini btn-primary"  onclick="return translateitem('<?php echo BASE_URL; ?>','pName')">Translate</button>
                            <br />

                            
                            
                            <!-- <button onclick="return translateitem('pName')" class="btn btn btn-primary" style="margin-left:15px; margin-bottom:10px;">
                                        <i class="icon-trash icon-white"></i>
                                        <span>Translate</span>
                                    </button> -->
                            
						</fieldset>
						<fieldset>

<fieldset>
                        
                        
							<label>Product Short Description&nbsp;&nbsp;<button value="Translate"  class="btn btn-mini btn-primary"  onclick="return translateitem('<?php echo BASE_URL; ?>','pFeature')">Translate</button></label>
							<textarea rows="12" name="pFeature" id="pFeature"  style="width:490px;" class="cleditor"><?php echo htmlspecialchars_decode($row['short_description'])?></textarea>                   

                       	
			<label>Description <button value="Translate"  class="btn btn-mini btn-primary"  onclick="return translateitem('<?php echo BASE_URL; ?>','pDesc')">Translate</button></label><br />

							<textarea class="cleditor" rows="12" name="pDesc" id="pDesc" required  style="width:490px;">
                            	<?php echo $row['product_description']?>
                            </textarea>
                            
                            <!--<button onclick="return translateitem('pDesc')" class="btn btn btn-primary" style="margin-left:15px; margin-bottom:10px;">
                                        <i class="icon-trash icon-white"></i>
                                        <span>Translate</span>
                                    </button> -->
                            </fieldset><br />
                            
						</fieldset>
						<!--
                        <fieldset>
							<label>Product SKU</label>
							<input type="text" name="pSku" id="pSku" required readonly value="<?php echo $row['product_sku']?>">
						</fieldset>
                        <fieldset>
                        	
							<label>Product UPC</label>
							<input type="text" name="pupc" id="pupc" readonly value="<?php echo $row['product_upc']?>">
						</fieldset>
                        <fieldset>
                       		<label>Product Cost</label>
							<input type="text" name="pCost" id="pCost" value="<?php echo $row['product_cost']?>" readonly>
						</fieldset>
                        <fieldset>
                        
							<label>Product Retail</label>
							<input type="text" name="pRetail" id="pRetail" value="<?php echo $row['product_retail']?>" readonly>
						</fieldset>
                        <fieldset>
                        
							<label>Product MSRP</label>
							<input type="text" name="pmsrp" id="pmsrp" value="<?php echo $row['product_msrp']?>" readonly>
						</fieldset>
                        <fieldset>
                        
                        
							<label>Product MAP</label>
							<input type="text" name="pMAP" id="pMAP" value="<?php echo $row['product_map']?>" readonly>
						</fieldset>
                        <fieldset>
							<label>Product QTY</label>
							<input type="text" name="pQTY" id="pQTY" value="<?php echo $row['product_qty']?>" readonly>
						</fieldset>
                        <fieldset>
							<label>Product Inventory Level</label>
							<input type="text" name="pIlevel" id="pIlevel" value="<?php echo $row['product_inventory_level']?>" readonly>
						</fieldset>
                        <fieldset>
							<label>Product Brand</label>
							<input type="text" name="pBrand" id="pBrand" value="<?php echo $row['product_brand']?>" readonly>
						</fieldset>-->
                        
                        
                            
                            <!--<button onclick="return translateitem('pFeature')" class="btn btn btn-primary" style="margin-left:15px; margin-bottom:10px;">
                                        <i class="icon-trash icon-white"></i>
                                        <span>Translate</span>
                                    </button> -->
                            
                            
						</fieldset>
                        
                        <fieldset>
                        
                            
                            
							<label>Product Specification&nbsp;&nbsp;<button value="Translate"  class="btn btn-mini btn-primary"  onclick="return translateitem('<?php echo BASE_URL; ?>','pSpecs')">Translate</button></label>
							<textarea rows="12" name="pSpecs" id="pSpecs"  style="width:490px;" class="cleditor"><?php echo htmlspecialchars_decode($row['product_specs'])?></textarea>
                            
                            <!--<button onclick="return translateitem('pSpecs')" class="btn btn btn-primary" style="margin-left:15px; margin-bottom:10px;">
                                        <i class="icon-trash icon-white"></i>
                                        <span>Translate</span>
                                    </button> -->
                            
                            
						</fieldset>
                        
                        
                        <footer><br />
                        <div class="submit_link">
                        	<input type="button" value="Save English Content" class="btn btn-small btn-primary" onclick="return saveeng('<?php echo BASE_URL; ?>')">
                            
                           
                        </div>
                    </footer>
                    
                   
                    
                </div>
		</article><!-- end of post new article -->
        
        
         
       
        
		<div class="spacer"></div>
	</section>
					</div>
				</div><!--/span-->
				
				<div class="box span6">
					<div class="box-header well">
						<h2><i class="icon-eye-open"></i> Review Spanish Content</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<article class="module width_half">
			<header><h3>Spanish Copy</h3></header>
             
				<div class="module_content">
                	
                    <form action="index.php/englishready" method="post">
						<input type="hidden" name="sppr_id" id="sppr_id" value="<?php echo $sprow['sppr_id']?>" />
                        <input type="hidden" name="fpl_id" id="fpt_id" value="<?php echo $sprow['eng_id']?>" />
                        <fieldset>
							<label>Product Name</label>
                            
							<input type="text" name="pName" id="spName" required  value="<?php echo $sprow['prduct_name']?>">
						</fieldset>
                        
                        <fieldset>
                        
                        
							<label>Product Short Description</label>
							<textarea rows="12" name="pFeature" id="spFeature" style="width:490px;" class="cleditor"><?php echo $sprow['short_description']; ?></textarea>
						</fieldset>
                        
                        <fieldset>
                        
                        
						<fieldset>
                        	
							<label>Description</label><br />

							<textarea rows="12" name="pDesc" id="spDesc" required  style="width:490px;" class="cleditor">
                            	<?php echo $sprow['product_description']?>
                            </textarea>
						</fieldset>
						<!--
                        <fieldset>
							<label>Product SKU</label>
							<input type="text" name="pSku" id="pSku" required readonly value="<?php echo $sprow['product_sku']?>">
						</fieldset>
                        <fieldset>
                        	
							<label>Product UPC</label>
							<input type="text" name="pupc" id="pupc" value="<?php echo $sprow['product_upc']?>">
						</fieldset>
                        <fieldset>
                       		<label>Product Cost</label>
							<input type="text" name="pCost" id="pCost" value="<?php echo $sprow['product_cost']?>">
						</fieldset>
                        <fieldset>
                        
							<label>Product Retail</label>
							<input type="text" name="pRetail" id="pRetail" value="<?php echo $sprow['product_retail']?>" >
						</fieldset>
                        <fieldset>
                        
							<label>Product MSRP</label>
							<input type="text" name="pmsrp" id="pmsrp" value="<?php echo $sprow['product_msrp']?>">
						</fieldset>
                        <fieldset>
                        
                        
							<label>Product MAP</label>
							<input type="text" name="pMAP" id="pMAP" value="<?php echo $sprow['product_map']?>">
						</fieldset>
                        <fieldset>
							<label>Product QTY</label>
							<input type="text" name="pQTY" id="pQTY" value="<?php echo $sprow['product_qty']?>">
						</fieldset>
                        <fieldset>
							<label>Product Inventory Level</label>
							<input type="text" name="pIlevel" id="pIlevel" value="<?php echo $sprow['product_inventory_level']?>">
						</fieldset>
                        <fieldset>
							<label>Product Brand</label>
							<input type="text" name="pBrand" id="pBrand" value="<?php echo $sprow['product_brand']?>">
						</fieldset>
                        -->
                        
                        
                            
                            <br /><br />
							<label>Product Specification</label>
							<textarea rows="12" name="pSpecs" id="spSpecs"  style="width:490px;" class="cleditor"><?php echo htmlspecialchars_decode($sprow['product_specs'])?></textarea>
						</fieldset>
                        <footer><br />
                        <div class="submit_link">
                        
                        	<input type="button" value="Save Spanish Content" class="btn btn-small btn-primary" onclick="return savespanish('<?php echo BASE_URL; ?>')">
                        </div>
                    </footer>
                    </form>
                    
                    
                </div>
		</article><!-- end of post new article -->
					</div>
				</div><!--/span-->
				
			</div><!--/row-->
			
            
                    <div style="text-align:center"><input type="submit" value="Final Eng. & Spanish Submit" class="btn btn-large btn-primary" onclick="return spanishready('<?php echo BASE_URL; ?>')"></div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		