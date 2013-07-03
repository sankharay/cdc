<?php
include("dbw.php");
include("functions.php");
?>

    <!-- start checkboxTree configuration -->
<script type="text/javascript" src="<?php echo PLUGINS_WEB_URL."/categorytree/"; ?>/library/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo PLUGINS_WEB_URL."/categorytree/"; ?>/library/jquery-ui-1.8.12.custom/js/jquery-ui-1.8.12.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PLUGINS_WEB_URL."/categorytree/"; ?>library/jquery-ui-1.8.12.custom/css/smoothness/jquery-ui-1.8.12.custom.css"/>

<script type="text/javascript" src="<?php echo PLUGINS_WEB_URL."/categorytree/"; ?>jquery.checkboxtree.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PLUGINS_WEB_URL."/categorytree/"; ?>jquery.checkboxtree.css"/>
<!-- end checkboxTree configuration -->

<script type="text/javascript" src="<?php echo PLUGINS_WEB_URL."/categorytree/"; ?>/library/jquery.cookie.js"></script>
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
?>

    
</div>
