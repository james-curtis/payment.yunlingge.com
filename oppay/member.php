<?php
$clientip=real_ip();

if(isset($_COOKIE["adminas_token"]))
{
	$token=authcode(daddslashes($_COOKIE['adminas_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session=md5($conf['admin_user'].$conf['admin_pwd'].$password_hash);
	if($session==$sid) {
		$islogin=1;
	}
}
if(isset($_COOKIE["useras_token"]))
{
	$token=authcode(daddslashes($_COOKIE['useras_token']), 'DECODE', SYS_KEY);
	list($pid, $sid, $expiretime) = explode("\t", $token);
	$userrow=$DB->query("SELECT * FROM pay_user WHERE id='{$pid}' limit 1")->fetch();
	$session=md5($userrow['id'].$userrow['key'].$password_hash);
	if($session==$sid && $expiretime>time()) {
		$islogin2=1;
	}
}
?>