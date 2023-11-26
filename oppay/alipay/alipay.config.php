<?php
//云凌支付系统文件
$alipay_config['partner']		= $conf['gfjk_alipay_id'];
$alipay_config['seller_email']	= $conf['gfjk_alipay_zh'];
$alipay_config['key']			= $conf['gfjk_alipay_key'];
$alipay_config['sign_type']    = strtoupper('MD5');
$alipay_config['input_charset']= strtolower('utf-8');
$alipay_config['cacert']    = getcwd().'\\cacert.pem';
$alipay_config['transport']    = 'http';
?>