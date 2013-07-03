<?php
include("dbw.php");
include("functions.php");
?>

    <!-- start checkboxTree configuration -->
<script type="text/javascript" src="library/jquery-1.4.4.js"></script>
<script type="text/javascript" src="library/jquery-ui-1.8.12.custom/js/jquery-ui-1.8.12.custom.min.js"></script>
<link rel="stylesheet" type="text/css"
	  href="library/jquery-ui-1.8.12.custom/css/smoothness/jquery-ui-1.8.12.custom.css"/>

<script type="text/javascript" src="jquery.checkboxtree.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.checkboxtree.css"/>
<!-- end checkboxTree configuration -->

<script type="text/javascript" src="library/jquery.cookie.js"></script>
    <script type="text/javascript">
        //<!--
        $(document).ready(function() {
            $('#tabs').tabs({
                cookie: { expires: 30 }
            });
            $('.jquery').each(function() {
                eval($(this).html());
            });
            $('.button').button();
        });
        //-->
    </script>
    <style type="text/css">
        body {
            font-family: verdana, arial;
            font-size: 0.8em;
        }

        code {
            white-space: pre;
        }
    </style>
</head>
<body>
<script class="jquery" lang="text/javascript">
        $('#tree1').checkboxTree();
    </script>

<div id="tabs-1">
    
    

<?php
$abc = new RightMenu_internal();
echo $abc->getMenu();
?>
</div>
<div id="notify"></div>
<script>
function getproducts(catid)
{
$('#notify').load('getproducts.php?catid='+catid);
	return false;
}
function addproductsaddon()
{
	var fplid = <?php echo $_GET['fpl_id']; ?>;
	if($(':checkbox.addsons:checked').length>0){
		 var allVals = [];
				 $(':checkbox.addsons:checked').each(function() {
				   allVals.push($(this).val());
				 });
		$("#notify").load('addadonsinproduct.php?vals='+allVals+'&fplid='+fplid);
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	return false;
}
</script>
