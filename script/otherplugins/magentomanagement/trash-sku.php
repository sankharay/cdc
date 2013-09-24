<?php

?>
<script>
function trashAllcontent(url){
	
	$("#ajaxcontentbg").hide('slow')
	$("#prioritydiv").hide('slow')
	$("#notify").html('<img src='+url+'/img/loader.gif>');
	if($(':checkbox.productcheck:checked').length>0){
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
	var userid = $("#user").val();
	if(userid == "")
	{
		alert("Select User");
		$("#notify").html('<h4 class="alert_warning">Please select user</h4>')
	}
	else
	{
		$("#notify").load(url+'/trashcontent/index/?vals='+allVals+'&userid='+userid);
		return false;
	}
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	return false;
}
</script>