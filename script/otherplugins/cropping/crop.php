<!DOCTYPE html>
<html lang="en">
<head>
  <title>Live Cropping Demo</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

		<script language="Javascript">

			$(function(){

				$('#cropbox').Jcrop({
					//aspectRatio: 1,
					onChange: showPreview,
					onSelect: showPreview,					
					onSelect: updateCoords
				});

				$('.preview').click(function(){
					
					$('.preview').parent().css('border','2px solid black');
					$(this).parent().css('border','2px solid red');
					$('#th').val($(this).parent().height());
					$('#tw').val($(this).parent().width());
				})

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

			function showPreview(coords)
			{
				if (parseInt(coords.w) > 0)
				{
					$('.preview').each(function(){
					
						$('#th').val($(this).parent().height());
						$('#tw').val($(this).parent().width());
						$(this).parent().width(coords.w*$(this).parent().attr('factor'));
						$(this).parent().height(coords.h*$(this).parent().attr('factor'));
						
						var rx = $(this).parent().width() / coords.w;
						var ry = $(this).parent().height() / coords.h;
						
						$(this).css({
							width: Math.round(rx * 500) + 'px',
							height: Math.round(ry * 370) + 'px',
							marginLeft: '-' + Math.round(rx * coords.x) + 'px',
							marginTop: '-' + Math.round(ry * coords.y) + 'px'
						});

					});


				}
			}			

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
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="hidden" id="tw" name="tw" />
			<input type="hidden" id="th" name="th" />
			<input type="hidden" id="f" name="file" value="<?php echo $url; ?>" />
			<input type="submit" value="Crop Image" onClick="return cropimage();" id="crop" class="btn btn-large btn-inverse" />
		
			
  <div id="notify"></div>
  <div style="display:none;" factor=1>
		<img src="<?php echo $save_path; ?>" class="preview" />
	</div>
	</body>

</html>
<script>
function cropimage()
{
var x = $('#x').attr('value');
var y = $('#y').attr('value');
var w = $('#w').attr('value');
var h = $('#h').attr('value');
var tw = $('#tw').attr('value');
var th = $('#th').attr('value');
var t = $('#t').attr('value');
var f = $('#f').attr('value');
var imgid = $('#imgid').attr('value');
$('#scroll').removeClass('myhide');
$('#scroll').addClass('mydiv');
$('#notify').load('cropfile.php?x='+x+'&y='+y+'&w='+w+'&h='+h+'&tw='+tw+'&th='+th+'&f='+f+'&imgid='+imgid+'&t='+t);
	return false;
}

</script>
<script>
window.onunload = function(){ 
  window.opener.location.reload(); 
};
</script>