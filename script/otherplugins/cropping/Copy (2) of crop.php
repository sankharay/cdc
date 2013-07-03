<!DOCTYPE html>
<html lang="en">
<head>
  <title>Live Cropping Demo</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

<script type="text/javascript">

  $(function(){

    $('#cropbox').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };

</script>

</head>
<body>
<?php
$url=$_GET['img'];
//$contents=file_get_contents($url);
//$imagename = rand(0,100000000000000000).".jpg";
if($_GET['type'] == 1)
$save_path="images/".$url;
else
$save_path="autoresizeimages/".$url;
// file_put_contents($save_path,$contents);
?>
		<!-- This is the image we're attaching Jcrop to -->
		<img src="<?php echo $save_path; ?>" id="cropbox"  />

		<!-- This is the form that our event handler fills -->
			<input type="hidden" id="imgid" name="imgid" value="<?php echo $_GET['imgid']; ?>"/>		<input type="hidden" id="t" name="t" value="<?php echo $_GET['type']; ?>"/>
			<input type="hidden" id="x" name="x"/>
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="hidden" id="f" name="file" value="<?php echo $url; ?>" />
			<input type="submit" value="Crop Image" onClick="return cropimage();" id="crop" class="btn btn-large btn-inverse" />
		
  <div id="notify"></div>
	</body>

</html>
<script>
function cropimage()
{
var x = $('#x').attr('value');
var y = $('#y').attr('value');
var w = $('#w').attr('value');
var h = $('#h').attr('value');
var f = $('#f').attr('value');
var t = $('#t').attr('value');
var imgid = $('#imgid').attr('value');
$('#scroll').removeClass('myhide');
$('#scroll').addClass('mydiv');
$('#notify').load('cropfile.php?x='+x+'&y='+y+'&w='+w+'&h='+h+'&f='+f+'&imgid='+imgid+'&t='+t);
	return false;
}

</script>
<script>
window.onunload = function(){ 
  window.opener.location.reload(); 
};
</script>