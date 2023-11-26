<?php
include("./oppay/common.php");
if($conf['web_is']==1)sysmsg($conf['web_offtext']);
if($conf['web_is']==2)sysmsg($conf['web_offtext']);
$template = $conf['template'];
include("./oppay/template/{$template}/index.html");
?>