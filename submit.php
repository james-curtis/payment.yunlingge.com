<?php
if($_SERVER['HTTP_USER_AGENT']=='Mozilla/4.0 (compatible; MSIE 9.0; Windows NT 6.1)')exit;
if(isset($_GET['pid'])){
	$queryArr=$_GET;
	$is_defend=true;
}elseif(isset($_POST['pid'])){
	$queryArr=$_POST;
}else{
	@header('Content-Type: text/html; charset=UTF-8');
	exit('你还未配置支付接口商户！');
}

require './oppay/common.php';

@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>正在为您跳转到支付页面，请稍候...</title>
    <style type="text/css">
        body {margin:0;padding:0;}
        p {position:absolute;
            left:50%;top:50%;
            width:330px;height:30px;
            margin:-35px 0 0 -160px;
            padding:20px;font:bold 14px/30px "宋体", Arial;
            background:#f9fafc url(../images/loading.gif) no-repeat 20px 26px;
            text-indent:22px;border:1px solid #c5d0dc;}
        #waiting {font-family:Arial;}
    </style>
<script>
function open_without_referrer(link){
document.body.appendChild(document.createElement('iframe')).src='javascript:"<script>top.location.replace(\''+link+'\')<\/script>"';
}
</script>
</head>
<body>
<?php

$prestr=createLinkstring(argSort(paraFilter($queryArr)));
$pid=intval($queryArr['pid']);
if(empty($pid))sysmsg('PID不存在');
$userrow=$DB->query("SELECT * FROM pay_user WHERE id='{$pid}' limit 1")->fetch();
if(!md5Verify($prestr, $queryArr['sign'], $userrow['key']))sysmsg('签名校验失败，请返回重试！');

if($userrow['active']==0)sysmsg('商户已封禁，无法支付！');

$type=daddslashes($queryArr['type']);
$out_trade_no=daddslashes($queryArr['out_trade_no']);
$notify_url=strip_tags(daddslashes($queryArr['notify_url']));
$return_url=strip_tags(daddslashes($queryArr['return_url']));
$name=strip_tags(daddslashes($queryArr['name']));
$money=daddslashes($queryArr['money']);
$sitename=urlencode(base64_encode(daddslashes($queryArr['sitename'])));


if(empty($out_trade_no))sysmsg('订单号(out_trade_no)不能为空');
if(empty($notify_url))sysmsg('通知地址(notify_url)不能为空');
if(empty($return_url))sysmsg('回调地址(return_url)不能为空');
if(empty($name))sysmsg('商品名称(name)不能为空');
if(empty($money))sysmsg('金额(money)不能为空');
if($money<=0 || !is_numeric($money))sysmsg('金额不合法');
if(!preg_match('/^[a-zA-Z0-9.\_\-|]+$/',$out_trade_no))sysmsg('订单号(out_trade_no)格式不正确');

$ljarr = explode("、", $conf['goods_lj']);
foreach ($ljarr as $k => $v) {
    if (strexists($name, $v)) {
        sysmsg($conf['goods_ljtis']);
        exit;
    }
}

//$row=$DB->query("SELECT * FROM pay_order WHERE pid='$pid' and out_trade_no='{$out_trade_no}' limit 1")->fetch();
$trade_no=date("YmdHis").rand(11111,99999);
$domain=getdomain($notify_url);
if(!$DB->query("insert into `pay_order` (`trade_no`,`out_trade_no`,`notify_url`,`return_url`,`type`,`pid`,`addtime`,`name`,`money`,`domain`,`ip`,`status`) values ('".$trade_no."','".$out_trade_no."','".$notify_url."','".$return_url."','".$type."','".$pid."','".$date."','".$name."','".$money."','".$domain."','".$clientip."','0')"))exit('创建订单失败，请返回重试！');

if($type=='alipay'){

if($conf['alipay_mode']==0){

echo "

支付宝接口关闭

";

}

if($conf['alipay_mode']==1){

	//echo "<script>window.location.href='./alipay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
	//exit;
	require_once(SYSTEM_ROOT."alipay/alipay.config.php");
	require_once(SYSTEM_ROOT."alipay/alipay_submit.class.php");
	//构造要请求的参数数组，无需改动
	if(checkmobile()==true){
		$alipay_service = "alipay.wap.create.direct.pay.by.user";
	}else{
		$alipay_service = "create_direct_pay_by_user";
	}
	$name = 'onlinepay-'.time();
	$parameter = array(
		"service" => $alipay_service,
		"partner" => trim($alipay_config['partner']), //合作身份者id
		"seller_id" => trim($alipay_config['partner']), //收款支付宝用户号
		"payment_type"	=> "1", //支付方式
		"notify_url"	=> 'http://'.$conf['local_domain'].'/submit/alipay/alipay_notify.php', //服务器异步通知页面路径
		"return_url"	=> 'http://'.$_SERVER['HTTP_HOST'].'/submit/alipay/alipay_return.php', //页面跳转同步通知页面路径
		"out_trade_no"	=> $trade_no, //商户订单号
		"subject"	=> $name, //订单名称
		"total_fee"	=> $money, //付款金额
		"_input_charset"	=> strtolower('utf-8')
	);
	if(checkmobile()==true){
		$parameter['app_pay'] = "Y";
	}

	//建立请求
	$alipaySubmit = new AlipaySubmit($alipay_config);
	$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "正在跳转");
	echo $html_text;

}

if($conf['alipay_mode']==2){

require_once(SYSTEM_ROOT."epay/yzf_alipay.php");
require_once(SYSTEM_ROOT."epay/epay_submit.class.php");
$parameter = array(
	"pid" => trim($alipay_config['partner']),
	"type" => $type,
	"notify_url"	=> 'http://'.$conf['local_domain'].'/submit/epay/opyzf_alipay_notify.php',
	"return_url"	=> 'http://'.$_SERVER['HTTP_HOST'].'/submit/epay/opyzf_alipay_return.php',
	"out_trade_no"	=> $trade_no,
	"name"	=> $name,
	"money"	=> $money
);
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;

}

if($conf['alipay_mode']==3){

	echo "<script>window.location.href='./submit/codepay/codepay.php?trade_no={$trade_no}&type=alipay&sitename={$sitename}';</script>";

}

}

if($type=='wxpay'){

if($conf['wxpay_mode']==0){

echo "

微信支付接口关闭

";

}

if($conf['wxpay_mode']==1){

	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')!==false){
		echo "<script>window.location.href='./submit/wxpay/wxjspay.php?trade_no={$trade_no}';</script>";
	}elseif(checkmobile()==true){
		echo "<script>window.location.href='./submit/wxpay/wxwappay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
	}else{
		echo "<script>window.location.href='./submit/wxpay/wxpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
	}

}

if($conf['wxpay_mode']==2){

require_once(SYSTEM_ROOT."epay/yzf_wxpay.php");
require_once(SYSTEM_ROOT."epay/epay_submit.class.php");
$parameter = array(
	"pid" => trim($alipay_config['partner']),
	"type" => $type,
	"notify_url"	=> 'http://'.$conf['local_domain'].'/submit/wxpay/opyzf_wxpay_notify.php',
	"return_url"	=> 'http://'.$_SERVER['HTTP_HOST'].'/submit/wxpay/opyzf_wxpay_return.php',
	"out_trade_no"	=> $trade_no,
	"name"	=> $name,
	"money"	=> $money
);
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;

}

if($conf['wxpay_mode']==3){

	echo "<script>window.location.href='./submit/codepay/codepay.php?trade_no={$trade_no}&type=wxpay&sitename={$sitename}';</script>";

}

}

if($type=='qqpay'){

if($conf['qqpay_mode']==0){

echo "

QQ钱包接口关闭

";

}

if($conf['qqpay_mode']==1){

	echo "<script>window.location.href='./submit/qqpay/qqpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";

}

if($conf['qqpay_mode']==2){

require_once(SYSTEM_ROOT."epay/yzf_qqpay.php");
require_once(SYSTEM_ROOT."epay/epay_submit.class.php");
$parameter = array(
	"pid" => trim($alipay_config['partner']),
	"type" => $type,
	"notify_url"	=> 'http://'.$conf['local_domain'].'/submit/qqpay/opyzf_qqpay_notify.php',
	"return_url"	=> 'http://'.$_SERVER['HTTP_HOST'].'/submit/qqpay/opyzf_qqpay_return.php',
	"out_trade_no"	=> $trade_no,
	"name"	=> $name,
	"money"	=> $money
);
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;

}

if($conf['qqpay_mode']==3){

	echo "<script>window.location.href='./submit/codepay/codepay.php?trade_no={$trade_no}&type=qqpay&sitename={$sitename}';</script>";

}

}

if($type=='tenpay'){

if($conf['tenpay_mode']==0){

echo "

财付通接口关闭

";

}

if($conf['tenpay_mode']==1){

	require_once(SYSTEM_ROOT."tenpay/tenpay.config.php");
	require_once(SYSTEM_ROOT."tenpay/RequestHandler.class.php");
	
	$name = 'onlinepay-'.time();
	/* 创建支付请求对象 */
	$reqHandler = new RequestHandler();
	$reqHandler->init();
	$reqHandler->setKey($tenpay_config['key']);
	$reqHandler->setGateUrl("https://gw.tenpay.com/gateway/pay.htm");

	//----------------------------------------
	//设置支付参数 
	//----------------------------------------
	$reqHandler->setParameter("partner", trim($tenpay_config['mch']));
	$reqHandler->setParameter("out_trade_no", $trade_no);
	$reqHandler->setParameter("total_fee", $money*100);  //总金额
	$reqHandler->setParameter("return_url", 'http://'.$_SERVER['HTTP_HOST'].'/submit/tenpay/tenpay_return.php');
	$reqHandler->setParameter("notify_url", 'http://'.$conf['local_domain'].'/submit/tenpay/tenpay_notify.php');
	$reqHandler->setParameter("body", $name);
	$reqHandler->setParameter("bank_type", "DEFAULT");  	  //银行类型，默认为财付通
	$reqHandler->setParameter("spbill_create_ip", $clientip);//客户端IP
	$reqHandler->setParameter("fee_type", "1");               //币种
	$reqHandler->setParameter("subject",$name);          //商品名称，（中介交易时必填）
	//系统可选参数
	$reqHandler->setParameter("sign_type", "MD5");  	 	  //签名方式，默认为MD5，可选RSA
	$reqHandler->setParameter("service_version", "1.0"); 	  //接口版本号
	$reqHandler->setParameter("input_charset", "utf-8");   	  //字符集
	$reqHandler->setParameter("sign_key_index", "1");    	  //密钥序号

	//请求的URL
	$reqUrl = $reqHandler->getRequestURL();

	echo '<script>open_without_referrer("'.$reqUrl.'");</script>';

}

if($conf['tenpay_mode']==2){

require_once(SYSTEM_ROOT."epay/yzf_tenpay.php");
require_once(SYSTEM_ROOT."epay/epay_submit.class.php");
$parameter = array(
	"pid" => trim($alipay_config['partner']),
	"type" => $type,
	"notify_url"	=> 'http://'.$conf['local_domain'].'/submit/epay/opyzf_tenpay_notify.php',
	"return_url"	=> 'http://'.$_SERVER['HTTP_HOST'].'/submit/epay/opyzf_tenpay_return.php',
	"out_trade_no"	=> $trade_no,
	"name"	=> $name,
	"money"	=> $money
);
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;

}

if($conf['tenpay_mode']==3){

	echo "<script>window.location.href='./submit/codepay/codepay.php?trade_no={$trade_no}&type=tenpay&sitename={$sitename}';</script>";

}

}

else{
	echo "<script>window.location.href='./submit/default.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
}

?>
<p>正在为您跳转到支付页面，请稍候...</p>
</body>
</html>
