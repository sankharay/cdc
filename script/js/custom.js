// JavaScript Document

function showcontent(fname){
	$('#main').load(fname+'.html');
}

function editProduct(fname,id){
	$('#main').load(fname+'.php?pId='+id);
}

function selectcat(id){
	var val = $("#pId"+id).val();
	var level = parseInt(id)+1;
	
	$.ajax({
		  type: "POST",
		  url: "selectsubcat.php",
		  data: { cId: val, level:level}
		}).done(function( msg ) {
		  //alert( "Data Saved: " + msg );
		if(msg != '0'){	
			$("#catTree").append(msg);	 		
			$("#levels").val(level);
		}
		 
		});
	
	
	
	
}

function showProduct(fname){
	$('#main').load(fname+'.php');
}

function edituser(id){
	$('#main').load('edituser.php?uId='+id);
}

function  adduser(){
	var values = $('input:checkbox:checked').map(function () {
			return this.value;
	}).get(); // ["18", "55", "10"]
	
	var fname = $("#fName").val();
	var lname = $("#lName").val();
	var email = $("#email").val();	
	var username = $("#uName").val();	
	var pass = $("#pass").val();
	
	
	$('#notify').load('test1.php?value='+values+'&fname='+fname+'&lname='+lname+'&email='+email+'&username='+username+'&pass='+pass);
	
	return false;
}

function translateitem(url,id){
	// $('#s'+id).htmlarea('updateHtmlArea','');
	var content = $('#'+id).val();
	$.ajax({
		  type: "POST",
		  url: url+"/translatedata",
		  data: { tex: content }
		}).done(function( msg ) {
		  //alert( "Data Saved: " + msg );
		 if(msg != ''){
			$('#s'+id).val(msg);
			$('#s'+id).val('').blur();
			$('#s'+id).cleditor()[0].execCommand('inserthtml',msg);
			
		}else{
			alert("Not Translated")
		}
		
		 
		});
}

function translateitems(url,id){
	// $('#s'+id).htmlarea('updateHtmlArea','');
	var content = $('#'+id).val();
	$.ajax({
		  type: "POST",
		  url: url+"/translatedata",
		  data: { tex: content }
		}).done(function( msg ) {
		  //alert( "Data Saved: " + msg );
		 if(msg != ''){
			$('#s'+id).val(msg);
			
		}else{
			alert("Not Translated")
		}
		
		 
		});
}
	

function  addproduct(){
	
	var pName = $("#pName").val();
	var pDesc = $("#pDesc").val();
	var pSku = $("#pSku").val();	
	var pupc = $("#pupc").val();	
	var pCost = $("#pCost").val();
	var pRetail = $("#pRetail").val();
	var pmsrp = $("#pmsrp").val();	
	var pMAP = $("#pMAP").val();	
	var pQTY = $("#pQTY").val();
	var pIlevel = $("#pIlevel").val();
	var pBrand = $("#pBrand").val();	
	var pimg1 = $("#pimg1").val();	
	var pFeature = $("#pFeature").val();
	var pSource = $("#pSource").val();
	var pSpecs = $("#pSpecs").val();	
	
	
	
	$('#notify').load('newproduct.php?pname='+pName+'&pDesc='+pDesc+'&pSku='+pSku+'&pupc='+pupc+'&pCost='+pCost+'&pRetail='+pRetail+'&pmsrp='+pmsrp+'&pMAP='+pMAP+'&pQTY='+pQTY+'&pIlevel='+pIlevel+'&pBrand='+pBrand+'&pimg1='+pimg1+'&pFeature='+pFeature+'&pSource='+pSource+'&pSpecs='+pSpecs);

	
	return false;
}

		$('#step1').show();
		$('#step2').hide();
		$('#step3').hide();
		$('#step4').hide();
		$('#step5').hide();
		$('#step6').hide();

function nextStep(step){
	$(".steps").hide('slow');
	$("#"+step).show('slow');
}

function addtoMagento(id){
	
	$("#notify").html('<img src="images/loading.gif">');
	$("#notify").load('addtomagento.php?pId='+id);
	return false;
}

function addtomagentoque(){

	if($(':checkbox.productcheck:checked').length>0){
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
		alert(allVals)

		$("#notify").load('index.php/addtoque?vals='+allVals);
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
}

function chkuser(){
	$("#chkUser").html("<img src='img/loader.gif'>");
	
	$.ajax({
		  type: "POST",
		  url: "ajaxfiles/userchk.php",
		  data: { uname: $('#uName').val() }
		}).done(function( msg ) {
		  //alert( "Data Saved: " + msg );
		 if(msg == 0){
			$("#chkUser").html('<span class="label label-success">User Available</span>');
		}else{
			$("#chkUser").html('<span class="label label-important">Username Not Available</span>');
			$("#err").val('0');
		}
		
		 
		});
}

function chkform(){
	
	if($("#err").val()=='0'){
		
		return false;
	}
//	return false;
}
function additem(type){
	$("#productPage").load("otherplugins/addproduct/"+type+'.php');
	$("#productPage1").hide('slow');
	$("#productPage").show('slow');
}
function additemexcel(){
	$("#productPage").hide('slow');
	$("#productPage1").show('slow');
}

function processthefile(file){
	
	if($("input:radio[checked=checked]").val()!=1&& $("input:radio[checked=checked]").val()!=2&& $("input:radio[checked=checked]").val()!=3){
		$("#notify").html('<h4 class="alert_warning">Please select type of data upload</h4>')
		return false;
	}
	var value = $("input[@name=newupdate]:checked").val();
	$("#notify").html('<img src="images/search.gif">');
	if(value == 3){
		$("#notify").load('excel_reader/importengready.php?file='+file+'&type='+$("input:radio[checked=checked]").val());	
	}
	else if(value == 1){
		$("#notify").load('excel_reader/import.php?file='+file+'&type='+$("input:radio[checked=checked]").val());
	}else
	{
		$("#notify").load('excel_reader/update.php?file='+file+'&type='+$("input:radio[checked=checked]").val());
	}
}

function processthefinalfile(file){
	$("#notify").html('<img src="images/search.gif">');
	$("#notify").load('excel_reader/importfinal.php?file='+file);
}


function selecteverything(){
	if($('#mainselect').is(':checked')){
		$('.productcheck').attr('checked','checked');
		$('#uniform-undefined').addClass('focus');
		$('#uniform-undefined span').addClass('checked');
	}else{
		$('.productcheck').attr('checked',false);
		$('#uniform-undefined').removeClass('focus');
		$('#uniform-undefined span').removeClass('checked');
	}

}

function achieveAll(){
	$("#notify").html('<img src="images/search.gif">');
	//alert('this is archieve Section')
	if($(':checkbox.productcheck:checked').length>0){
	
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
		$("#notify").load('index.php/archieve?vals='+allVals);
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
}

function exportAll(){
	if($(':checkbox.productcheck:checked').length>0){
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
		//$("#notify").load('index.php/exportproducts?vals='+allVals);
		
		var url = 'index.php/exportproducts?vals='+allVals;
		
		$(location).attr('href',url);
		
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
}


function exportAllpro(){
	if($(':checkbox.productcheck:checked').length>0){
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
		//$("#notify").load('index.php/exportproducts?vals='+allVals);
		
		var url = 'index.php/exportprod?vals='+allVals;
		
		$(location).attr('href',url);
		
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
}


function exportAllpros(){
	
		var url = 'index.php/exportprods';
		
		$(location).attr('href',url);

}



function resetAll(){
	$("#notify").html('<img src="images/search.gif">');
	//alert('this is archieve Section')
	if($(':checkbox.productcheck:checked').length>0){
	
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
		$("#notify").load('index.php/reset?vals='+allVals);
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
}

function deleteAll(){
	$("#notify").html('<img src="images/search.gif">');
	var r=confirm("Are you sure you want to delete this product ?");
	if(r==true){
		if($(':checkbox.productcheck:checked').length>0){
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
		$("#notify").load('index.php/delete?vals='+allVals);
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	}
}

function setpriority(){
	if($(':checkbox.productcheck:checked').length>0){
		$("#ajaxcontentbg").show('slow')
		$("#prioritydiv").show('slow')
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
}

function processAll(){
	
	$("#ajaxcontentbg").hide('slow')
	$("#prioritydiv").hide('slow')
	$("#notify").html('<img src="img/loader.gif">');
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
		$("#notify").load('contentsearch/process?vals='+allVals+'&priority='+$("#priority").val()+'&userid='+userid);
		return false;
	}
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	return false;
} 

function processAlls(){
	
	$("#ajaxcontentbg").hide('slow')
	$("#prioritydiv").hide('slow')
	$("#notify").html('<img src="img/loader.gif">');
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
		$("#notify").load('processing?vals='+allVals+'&priority='+$("#priority").val()+'&userid='+userid);
	}
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	return false;
}

function filterdata(){
	$("#notify").html('<img src="images/search.gif">');
	var str = '';
	if($("#bname").val()!=''){
		//alert("brand name is blank");
		str += 'brandname='+$("#bname").val()+'&';
	}
	
	if($("#vname").val()!=''){
		//alert("brand name is blank");
		str += 'vendor='+$("#vname").val()+'&';
	}
	
	if($("#upc").val()!=''){
		//alert("brand name is blank");
		str += 'upc='+$("#upc").val()+'&';
	}
	if(str!=''){
		
		$('.tablesorter').dataTable( {
			"bProcessing": true,
			"sAjaxSource": 'index.php/filtereddata?'+str
		} );
		
		//$(".tab_container").load('index.php/filtereddata?'+str);
	}else{
		alert("Please provide one filter value")
		$("#notify").html('');
	}
	
	
	return false;
}

function placevalue(from,to){
//	alert($('#'+from).html())
	$('#'+to).val($('#'+from).val());
	
}
function placehtml(from,to){
	var data =  $('#'+from).html();
	$('#'+to).cleditor()[0].execCommand('inserthtml',data);
}

function chkforProcess(sku){
	
	$.ajax({
		  type: "POST",
		  url: "chkprocess.php",
		  data: { psku: sku }
		}).done(function( msg ) {
		 // alert( "Data Saved: " + msg );
		 if(msg == 1){
			alert('The product with SKU '+sku+' is already in process')
			location.reload();
			//$("#chkUser").html('<h4 class="alert_success" style="margin:40px 1% 0">User Name Available</h4>');
		}else{
			var url = "index.php/productwiz?sku="+sku;
			$(location).attr('href',url);
		}
		 
		});
		
		return false;
	
}

function setcomment(sku){
	$("#prsku").val(sku);
	$("#ajaxcontentbg").show('slow')
	$("#prioritydiv").show('slow')
	return false;
}

function revertproducts(){
	var r=confirm("Are you sure you want to revert this product ?");
	if(r==true){
		$.ajax({
			  type: "POST",
			  url: "index.php/revert",
			  data: { psku: $("#prsku").val(), comment:$("#comment").val() }
			}).done(function( msg ) {
			
			
			 if(msg == 0){
				alert('Product did not revert back')
				location.reload();
				
			}else{
				
				var url = "index.php/pending";
				$(location).attr('href',url);
			}
			 
			});
	}
		
		return false;
	
}


function revertproduct(sku){
	var r=confirm("Are you sure you want to revert this product ?");
	if(r==true){
		$.ajax({
			  type: "POST",
			  url: "index.php/revert",
			  data: { psku: sku }
			}).done(function( msg ) {
			
			 if(msg == 0){
				alert('Product did not revert back')
				location.reload();
				
			}else{
				
				var url = "index.php/pending";
				$(location).attr('href',url);
			}
			 
			});
	}
		
		return false;
	
}

function spanishready(url){
	$.ajax({
		  type: "POST",
		  url: url+"/savefinaldata/spanishfinalsave",
		  data: { sppr_id: $('#sppr_id').val(), fpt_id: $('#fpt_id').val(), pName: $('#spName').val(), pDesc: $('#spDesc').val(), pFeature: $('#spFeature').val(), pSpecs: $('#spSpecs').val(), pDisclaimer: $('#disclaimer').val(), psVideo: $('#psVideo').val()}
		}).done(function( msg ) {
		
		 if(msg == 0){
			alert('Product did not updated')
			//location.reload();
			
		}else{
			alert('Product has been updated successfully');
			var url = "http://localhost/app/script/contentsearch/finalproductinqueue/";
			window.location=url;
			// $(location).attr('href',url);
		}
		 
		});
		
		return false;
}


function savespanish(url){

	$.ajax({
		  type: "POST",
		  url: url+"/savefinaldata/spanishsave",
		  data: { sppr_id: $('#sppr_id').val(), fpt_id: $('#fpt_id').val(), pName: $('#spName').val(), spDesc: $('#spDesc').val(), spFeature: $('#spFeature').val(), pSpecs: $('#spSpecs').val(), pDisclaimer: $('#disclaimer').val(), psVideo: $('#psVideo').val()}
		}).done(function( msg ) {
		
		 if(msg == 0){
			alert('Product did not updated')
			//location.reload();
			
		}else{
			alert('Product has been updated successfully');
			
		}
		 
		});
		
		return false;
}


function saveeng(url){

	$.ajax({
		  type: "POST",
		  url: url+"/savefinaldata/engsave",
		  data: { sppr_id: $('#sppr_id').val(), fpt_id: $('#fpt_id').val(),pName: $('#pName').val(), pDesc: $('#pDesc').val(), pFeature: $('#pFeature').val(), pSpecs: $('#pSpecs').val(), pDisclaimer: $('#disclaimer').val(), pVideo: $('#pVideo').val()}
		}).done(function( msg ) {
		
		 if(msg == 0){
			alert('Product did not updated')
			//location.reload();
			
		}else{
			alert('Product has been updated successfully');
			
		}
		 
		});
		
		return false;
}



function saveenglish(){
	$.ajax({
		  type: "POST",
		  url: "saveenglish.php",
		  data: { pname:$("#pName").val(), pDesc: $('#pDesc').val(), psku:$("#pSku").val(), pupc:$("#pupc").val(),pmsrp:$("#pmsrp").val(),pmap:$("#pMAP").val(),pbrand:$("#pBrand").val(),pimg:$("#pImg1").val(), pFeature: $('#pFeature').val(), pSpecs: $('#pSpecs').val()}
		}).done(function( msg ) {
		 if(msg == 0){
			alert('Product did not updated')
		
		}else{

			alert('Product has been saved successfully');
			//var url = "index.php/approved";
			//$(location).attr('href',url);
		}
		 
		});
		
		return false;
}



function setunapprove(id,sku){
	$("#prsku").val(sku);
	$("#prid").val(id);
	$("#ajaxcontentbg").show('slow')
	$("#prioritydiv").show('slow')
	return false;
}
function alertmsg(msg){
	alert(msg);
}
function unapprove(){
	
	var r=confirm("Are you sure you want to unapprove this product ?");
	
	if(r==true){
	
			$.ajax({
				  type: "POST",
				  url: "unapprove",  
				  data: { fpt_id: $("#prid").val(), psku: $("#prsku").val(), comment : $("#comment").val()}
				}).done(function( msg ) {
		
				 if(msg == 0){
					alert('Product did not updated')
					
				}else{
					alert('Product has been updated successfully');
					var url = "index.php/spenish";
					$(location).attr('href',url);
				}
				 
				});
			
		}
		
		return false;
	}

function addimgvalue(value){
	$('#step5').append('<input type="hidden" name="imgnames[]" value="'+value+'">');
}

function addimg(){
	
  $("#pImg1").val($("#pImg1").html()+','+$("#pImg2").val());
  
//  $('#pImg1').htmlarea();
 // $('#pImg1').htmlarea('updateHtmlArea','');	
  
  $.get("getimgsize.php", { img: $("#pImg2").val()},
   function(data){
    // alert("Data Loaded: " + data);
	$("#imgtabletr").append(data)
   });

	
	
}

function delimg(url,id)
{
	
			$.ajax({
				  type: "POST",
				  url: url+"/imagesection/deleteimg/",  
				  data: { imgid: id }
				}).done(function( msg ) {
		
				 if(msg == 0){
					alert('Product has been updated successfully');
					window.location.reload(true);
					
				}else{
					alert('Product has been updated successfully');
					window.location.reload(true);
				}
				 
				});
}

function addnewpro(){
		$.ajax({
		  type: "POST",
		  url: "addproduct/manualaddproduct",
		  data: { pname:$("#pName").val(), pDesc: $('#pDesc').val(), psku:$("#pSku").val(), pupc:$("#pupc").val(),pmsrp:$("#pmsrp").val(),pmap:$("#pMAP").val(),pbrand:$("#pBrand").val(), pFeature: $('#pFeature').val(), pSpecs: $('#pSpecs').val(), pVendor: $('#pVendor').val(), pSource: $('#pSource').val(), pMetatags: $('#pMetatags').val()}
		}).done(function( msg ) {
		 if(msg == 0){
			alert('Product did not updated')
		
		}else{

			alert('Product has been saved successfully');
			//var url = "index.php/approved";
			//$(location).attr('href',url);
		}
		 
		});
		
		return false;
	}


function deluser(id)
{
$('#notify').load('deleteuserdata/'+id);
alert("User Deleted");
window.location.reload(true);
	return false;
}

function deleteatt(id)
{
$('#notify').load('attributemanagement/deletesubtreeelement/'+id);
	return false;
}


function  updateuser(id){
	var aLevel = $("#aLevel").val();
	var fname = $("#fName").val();
	var lname = $("#lName").val();
	var email = $("#email").val();	
	var username = $("#uName").val();	
	var pass = $("#pass").val();
	$('#notify').load('updateuserdata/?userid='+id+'&value='+aLevel+'&fname='+fname+'&lname='+lname+'&email='+email+'&username='+username+'&pass='+pass+'&uid='+id);
	alert("User Updated SuccessFully");
	window.location.reload(true);
	return false;
}

function getvendorscontent(url,fplid,product_sku,product_source)
{
$('#notify').load(url+'/imagesection/getvendordata/'+fplid+'/'+product_sku+'/'+product_source);
	alert("Images Import Done");
	// window.location=url+'/imagesection/index/'+fplid+'/'+product_sku+'/'+product_source;
	window.location.reload(true);
	return false;
}

function getattrianddata(id)
{
var i=0;
if($('#'+id).prop('checked'))
{
var values = $('input:checkbox:checked').map(function () {
			i=i+1;
			return this.value;
	}).get();
if($('.checking:checkbox:checked').length < 2)
{
$('#catattributes').load('http://localhost/app/script/attributemanagement/getattributes/'+id);
$('#metainformations').load('http://localhost/app/script/attributemanagement/getmetainformation/'+id);
}
else
{
$('.checking').removeAttr('checked');
alert("Select Only One Category");
}
return false;
}
else
{
$('#catattributes').empty();
$('#metainformations').empty();
}
}

function checkcategory()
{
	var e =$('.checking:checkbox:checked').length;
	if($('.checking:checkbox:checked').length == 0)
	{
	alert("Minimum One Category Selection Required");
	return false;
	}
	else
	{
	return true;
	}
}

function confirmfinalproduct(url,fplid)
{
$('#notify').load(url+'/imagesection/confirmproductready/'+fplid);
alert("Product send for Magento Queue");
window.location=url+"/finaproducts/";
return false;	
}

function disclaimerchange(id)
{
$('#sdisclaimer').val(id);
}



function msaveedit(url,fpl_id)
{
	$("#waiting").removeClass("waiting");
	$("#waiting").addClass("waitings");
	$.ajax({
		  type: "POST",
		  url: url+"/magentoediting/editrpdoducttosend",
		  data: { fpl_id: fpl_id, pName:$("#pName").val(), finalpsdesc:$("#finalpsdesc").val(), pDesc:$("#pDesc").val(), pSpecs:$("#pSpecs").val(), pcost:$("#pcost").val(), pmsrp:$("#pmsrp").val(), pretail:$("#pretail").val(), pMAP:$("#pMAP").val(), pSource:$("#pSource").val(), pisset:$("#pisset").val(), ponlineonly:$("#ponlineonly").val(), pHeight:$("#pHeight").val(), pWidth:$("#pWidth").val(), pLength:$("#pLength").val(), pWeight:$("#pWeight").val(), pkeywords:$("#pkeywords").val(), pkeyworddescription:$("#pkeyworddescription").val(), pBrand:$("#pBrand").val(), pDisclaimer:$("#pDisclaimer").val()}
		}).done(function( msg ) {
		  // alert( "Data Send: " + msg );
		 if(msg = 1){
			// alert("Data Updated")
			$("#updating").hide();
			$("#magentoupdatedone").show();
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
			
		}
		else if(msg = 2)
		{
			alert("Data Updated in Magento");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}else
		{
			alert("Data Not send Please try after some time");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}
		
		 
		});
}



function msavespanishedit(url,sppr_id)
{
	$("#waiting").removeClass("waiting");
	$("#waiting").addClass("waitings");
	$.ajax({
		  type: "POST",
		  url: url+"/magentoediting/editorspanishtosend",
		  data: { sppr_id: sppr_id, pName:$("#spName").val(), finalpsdesc:$("#sfinalpsdesc").val(), pDesc:$("#spDesc").val(), pSpecs:$("#spSpecs").val(), pkeywords:$("#skeywords").val(), pkeyworddescription:$("#skeyworddescription").val()}
		}).done(function( msg ) {
		  // alert( "Data Send: " + msg );
		 if(msg = 1){
			// alert("Data Updated")
			$("#updating").hide();
			$("#magentoupdatedone").show();
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
			
		}
		else if(msg = 2)
		{
			alert("Data Updated in Magento");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}else
		{
			alert("Data Not send Please try after some time");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}
		
		 
		});
}

function updateadddons(url,fpl_id)
{
var values = $('input:checkbox:checked').map(function () {
			return this.value;
	}).get();
	alert(values);
	$.ajax({
		  type: "POST",
		  url: url+"/magentoediting/updateaddons",
		  data: { fpl_id: fpl_id, values: values }
		}).done(function( msg ) {
		  // alert( "Data Send: " + msg );
		 if(msg = 1){
			// alert("Data Updated")
			$("#updating").hide();
			$("#magentoupdatedone").show();
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
			
		}
		else if(msg = 2)
		{
			alert("Data Updated in Magento");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}else
		{
			alert("Data Not send Please try after some time");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}
		
		 
		});
	
}

function myPopup2(url) {
window.open( url, "myWindow", "status = 1, height = 700, width = 800, resizable = 1" )
}

function updateattributes(url,fpl_id)
{
	alert("Not Working");
}

$("#magentoupdatedone").hide();

// magento section starts
function send_magento(url,fpl_id){
	// $('#s'+id).htmlarea('updateHtmlArea','');
	$("#waiting").removeClass("waiting");
	$("#waiting").addClass("waitings");
	$.ajax({
		  type: "GET",
		  url: url+"/magentomanagement/savedatatomagento.php",
		  data: { fpl_id: fpl_id }
		}).done(function( msg ) {
		  alert( "Data Send: " + msg );
		 if(msg = 1){
			alert("Data send to magento")
			$("#updating").hide();
			$("#magentoupdatedone").show();
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
			
		}
		else if(msg = 2)
		{
			alert("Data Updated in Magento");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}else
		{
			alert("Data Not send Please try after some time");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}
		
		 
		});
}

function unpublishproduct(url,fpl_id){
	// $('#s'+id).htmlarea('updateHtmlArea','');
	$("#waiting").removeClass("waiting");
	$("#waiting").addClass("waitings");
	$.ajax({
		  type: "GET",
		  url: url+"/magentomanagement/unpublish_savedatatomagento.php",
		  data: { fpl_id: fpl_id }
		}).done(function( msg ) {
		  alert( "Data Send: " + msg );
		 if(msg = 1){
			alert("Data send to magento")
			$("#updating").hide();
			$("#magentoupdatedone").show();
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
			
		}
		else if(msg = 2)
		{
			alert("Data Updated in Magento");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}else
		{
			alert("Data Not send Please try after some time");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}
		
		 
		});
}
// magento section ends



function processmAll(){
	var error = false;
	$("#ajaxcontentbg").hide('slow')
	$("#prioritydiv").hide('slow')
	$("#notify").html('<img src="img/loader.gif">');
	var userid = $("#user").val();
	var pName = escape($("#pName").val());
	var pSku = $("#pSku").val();
	var pUpc = $("#pUpc").val();
	var priority = $("#priority").val();
	var priority = $("#priority").val();
	if(userid == "")
	{
		alert("Select User");
		$("#notify").html('<h4 class="alert_warning">Please select user</h4>')
	}else if(pName == "")
	{
		alert("Enter Product Name");
		$("#notify").html('<h4 class="alert_warning">Product Name Required</h4>')
	}else if(priority == "")
	{
		alert("Priority Required");
		$("#notify").html('<h4 class="alert_warning">Priority Required</h4>')
	}else if(pSku == "")
	{
		alert("Enter SKU");
		$("#notify").html('<h4 class="alert_warning">Product Name Required</h4>')
	}else if(pUpc == "")
	{
		alert("Enter UPC");
		$("#notify").html('<h4 class="alert_warning">UPC Required</h4>')
	}
	else
	{
		/*$.ajax({
		  type: "GET",
		  url: "assigndatamanually/index/",
		  data: { userid: userid, pName: pName, priority: priority, pSku: pSku, pUpc: pUpc, pSource: $("#pSource").val()  }
		}).done(function( msg ) {
		  alert( "Data Send: " + msg );
		 if(msg = 1){
			alert("Data send for recheck");			
			window.location.reload(true);
			
		}
		}); */
		$("#notify").load('assigndatamanually/index/?userid='+userid+'&pName='+pName+'&pSku='+pSku+'&pUpc='+pUpc+'&pSource='+$("#pSource").val());
	}
}

function get_report(url)
{
	var userid = $("#user").val();
	var fromDate = $("#fromDate").val();
	var toDate = $("#toDate").val();
	if(userid == "")
	{
		alert("Select User");
		$("#notify").html('<h4 class="alert_warning">Please select user</h4>')
	}else if(fromDate == "")
	{
		alert("Select From Date");
		$("#notify").html('<h4 class="alert_warning">Select From Date</h4>')
	}else if(toDate == "")
	{
		alert("Priority Required");
		$("#notify").html('<h4 class="alert_warning">Select To Date</h4>')
	}
	else
	{
		$("#notify").load(url+'/reporting/get/?userid='+userid+'&fromDate='+$("#fromDate").val()+'&toDate='+$("#toDate").val());
		
		return false;
	}
	return false;
}

function confirmproductothers(url,fplid)
{
$('#notify').load(url+'/addcontent/confirmproductothers/'+fplid);
alert("Product ready and send to team for review");
window.location=url+"/addcontent/";
return false;	
}
function qafailedj(url,mptid)
{
	$.ajax({
		  type: "POST",
		  url: url+"/addcontent/reviewagain",
		  data: { mptid: mptid, content: $("#qafailedComments").val(),values: $("#producterror").val() }
		}).done(function( msg ) {
		  alert( "Data Send: " + msg );
		 if(msg = 1){
			alert("Data send for recheck");			
			window.location.reload(true);
			
		}
		});
}
function qafaileduserj(url,mptid)
{
	$.ajax({
		  type: "POST",
		  url: url+"/addcontent/reviewuseragain",
		  data: { mptid: mptid, content: $("#qafailedComments").val(),values: $("#producterror").val() }
		}).done(function( msg ) {
		  alert( "Data Send: " + msg );
		 if(msg = 1){
			alert("Data send for recheck");			
			window.location.reload(true);
			
		}
		});
}

function processAllcontent(url){
	
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
		$("#notify").load(url+'/addcontent/processassign?vals='+allVals+'&priority='+$("#priority").val()+'&userid='+userid);
		return false;
	}
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	return false;
}

			function processfinaldata(urll,file)
			{
            var vendorid=$('#vendorid').val();
            var fileid=file;
			var userid = $('#user').val();
			if(vendorid != "0" & userid != "")
			{
			$("#waiting").removeClass("waiting");
			$("#waiting").addClass("waitings");
            $.ajax({
                type: 'GET',
                url: urll+'/addfinalproductdata/useraccessingapi/?vendorid='+vendorid+'&fileid='+fileid+'&vendoruserid='+userid,
                success: function(data) {
                $('#resutingdata').html(data);
				$("#waiting").removeClass("waitings");
				$("#waiting").addClass("waiting");
          }
        });
			}
		  else
		  {
			alert("You need to select vendor and user");  
		  }
			}
			
			
function qaerrorediting(url,id)
{
	$.ajax({
		  type: "POST",
		  url: url+"/rejecteddata/editdata/",
		  data: { id: id,header: $('#header').val(),details: $('#details').val() }
		}).done(function( msg ) {
		  alert( "Data Send: " + msg );
		 if(msg = 1){
			alert("Data send for recheck");			
			window.location.reload(true);
			
		}
		});
}
			
			
function qaerrordelete(url,id)
{
	$.ajax({
		  type: "POST",
		  url: url+"/rejecteddata/deletedata/",
		  data: { id: id }
		}).done(function( msg ) {
		  alert( "Data Send: " + msg );
		 if(msg = 1){
			alert("Data send for recheck");			
			window.location.reload(true);
			
		}
		});
}