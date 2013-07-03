<?php
include("../dbw.php");
?>
<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Choose Type of Data Upload</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <div>
				<div class="module_content">
                    
						<fieldset>
							<label>Product Name</label>
							<input type="text" name="pName" id="pName" required>
						</fieldset>
                        <fieldset>
							<label>Product SKU</label>
							<input type="text" name="pSku" id="pSku" required>
						</fieldset>
                        <fieldset>
							<label>Product UPC</label>
							<input type="text" name="pUpc" id="pUpc">
						</fieldset>
                        <fieldset>
							<label>User Assgin</label>
							<?php echo list_users(); ?>
						</fieldset>
                        <fieldset>
							<label>Select Source</label>
							<?php echo list_source(); ?>
						</fieldset>
                        <fieldset>
							<label>Data Priority</label>
							<select name="priority" style="width:100px;" id="priority">
                                        <option value="1">Low</option>
                                        <option value="2">Medium</option>
                                        <option value="3">Normal</option>
                                        <option value="4">High</option>
                                        <option value="5">Critical</option>
            						  </select>
						</fieldset>
                        <footer>
                        <div class="submit_link">
                           
                            <input type="submit" value="Submit" id="newprosubmit" class="btn btn-primary" onclick="return processmAll();">
                            <input type="submit" value="Reset" class="btn btn-primary">
                        </div>
                        <br />
<br />
             <div id="notify"></div>
                    </footer>
                    
                    
				</div>
			</div>
                        
					</div>
				</div>
                <div id="productPage"></div>
                
			</div>
