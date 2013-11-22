<?php
include("../../dbw.php");
file_get_contents("http://www.icuracao.com/cdc/script/apitext/apistockupdate/11");
mysql_query("INSERT INTO `cdc`.`common_inventry_update` (`id`, `vendor`, `dateandtime`, `numbersupdated`) VALUES (NULL, 'D&H', CURRENT_TIMESTAMP, '')") or die(mysql_error());
?>