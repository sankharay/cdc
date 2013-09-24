<?php
if($main_metainfo)
{
	?>
<label>Product Keywords</label>
							<textarea rows="12" name="keywords" class="span6 typeahead" id="pSpecs" required="required"><?php echo $main_metainfo->metakeywords; ?></textarea>
						</fieldset>
                        <label>Product Descriptions</label>
							<textarea rows="12" name="keyworddescription" class="span6 typeahead" id="pSpecs" required="required"><?php echo $main_metainfo->metadescription; ?></textarea>
						</fieldset>
                        <?php
}
else
{
echo "<strong>No Meta information set to this category</strong><br>";	
}
?>