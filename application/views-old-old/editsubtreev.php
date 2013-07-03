<table width="500px" class="table table-striped table-bordered bootstrap-datatable datatable">
                        
                          
						  <thead>
							  <tr>
								  <th width="47">Sub Attributes Name</th>
							    <th width="51">Action</th>
							  </tr>
						  </thead>   
						  <tbody>
							  <?php
							  foreach($attributes as $values)
							  {
							  ?>
							<tr>
							  <td><?php echo $values->name; ?></td>
								<td class="center">
                                 <a onClick="return deleteatt(<?php echo $values->id; ?>);"><span class="icon icon-color icon-trash" title=".icon  .icon-color  .icon-trash "></span></a>
								</td>
							</tr>
                            <?php
							  }
							  ?>
						  </tbody>
					  </table>
                      <div id="notify"></div>