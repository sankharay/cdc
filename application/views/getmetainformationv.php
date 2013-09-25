<?php
if($main_metainfo)
{
	?>
<table width="100%" border="0">
  <tr>
    <td><label>Product Keywords</label>
							<textarea rows="12" name="keywords" class="span12 typeahead" id="pSpecs" required="required"><?php echo $main_metainfo->metakeywords; ?></textarea>
						</fieldset></td>
    <!--<td><label>Spanish Product Keywords</label>
							<textarea rows="12" name="spanishkeywords" class="span12 typeahead" id="pSpecs" required="required"><?php echo $main_metainfo->spanish_metakeywords; ?></textarea>
						</fieldset></td> -->
  </tr>
  <tr>
    <td><label>Product Descriptions</label>
							<textarea rows="12" name="keyworddescription" class="span12 typeahead" id="pSpecs" required="required"><?php echo $main_metainfo->metadescrption; ?></textarea>
						</fieldset></td>
   <!-- <td><label>Spanish Product Descriptions</label>
							<textarea rows="12" name="spanishkeyworddescription" class="span12 typeahead" id="pSpecs" required="required"><?php echo $main_metainfo->metadescrption; ?></textarea>
						</fieldset></td> -->
  </tr>
</table>
 <?php
}
else
{
?>
<table width="100%" border="0">
  <tr>
    <td><label>Product Keywords</label>
							<textarea rows="12" name="keywords" class="span12 typeahead" id="pSpecs" required="required"></textarea>
						</fieldset></td>
    <!--<td><label>Spanish Product Keywords</label>
							<textarea rows="12" name="spanishkeywords" class="span12 typeahead" id="pSpecs" required="required"></textarea>
						</fieldset></td> -->
  </tr>
  <tr>
    <td><label>Product Descriptions</label>
							<textarea rows="12" name="keyworddescription" class="span12 typeahead" id="pSpecs" required="required"></textarea>
						</fieldset></td>
    <!-- <td><label>Spanish Product Descriptions</label>
							<textarea rows="12" name="spanishkeyworddescription" class="span12 typeahead" id="pSpecs" required="required"></textarea>
						</fieldset></td> -->
  </tr>
</table>
<?php	
}
?>