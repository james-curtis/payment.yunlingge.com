<?php
include("../oppay/common.php");
if($conf['web_is']==1)sysmsg($conf['web_offtext']);
if($conf['web_is']==2)sysmsg($conf['web_offtext']);
if($conf['is_reg']==0)sysmsg($conf['reg_offtext']);
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $conf['web_name']?> by AS">
  <meta name="author" content="AS">
  <title>商户找回 | <?php echo $conf['web_name']?></title>
  <meta name="keywords" content="云凌支付,云钱包,云支付,云结算,支付接口,支付营销,对账,微信支付,支付宝,QQ钱包,个人支付接口,免签支付接口">
  <link rel="shortcut icon" href="//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo $conf['web_qq']; ?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="/assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/fortawesome.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/aswl.min.css" type="text/css">
</head>
<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="/"><?php echo $conf['web_name']?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="/"><?php echo $conf['web_name']; ?></a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="agreement.php" class="nav-link">
              <span class="nav-link-inner--text">服务条款</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/doc.php" class="nav-link">
              <span class="nav-link-inner--text">开发文档</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link">
              <span class="nav-link-inner--text">商户登录</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="reg.php" class="nav-link">
              <span class="nav-link-inner--text">商户注册</span>
            </a>
          </li>
          <li class="nav-item">
            <a onclick="return confirm('请直奔主题,不要问在不在,节省彼此的时间,懂?')" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['web_qq']; ?>&site=qq&menu=yes" class="nav-link">
              <span class="nav-link-inner--text">联系客服</span>
            </a>
          </li>
        </ul>  
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">商户信息找回</h1>
              <p class="text-lead text-white">最好是安全，而不是抱歉</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card card-profile bg-secondary mt-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="/assets/images/team-1.jpg" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
              <div class="text-center mb-4">
                <h3>验证邮箱找回密钥</h3>
              </div>
              <form role="form">
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="请输入您绑定的邮箱地址" type="email" name="email" required="">
                  </div>
                </div>
                <div class="text-center">
                  <button class="btn btn-primary" type="button" id="submit" ng-click="login()" ng-disabled="form.$invalid">发送找回邮件</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; <?=date('Y')?> <a href="/" class="font-weight-bold ml-1" target="_blank"><?php echo $conf['web_name']; ?></a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="http://www.miibeian.gov.cn/" class="nav-link" target="_blank">备案号：<?php echo $conf['beian']; ?></a>
            </li> 
          </ul>
        </div>
      </div>
    </div>
  </footer>
<script src="/assets/js/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/js.cookie.js"></script>
<script src="/assets/js/jquery.scrollbar.min.js"></script>
<script src="/assets/js/jquery-scrollLock.min.js"></script>
<script src="/assets/js/jquery.lavalamp.min.js"></script>
<script src="/assets/js/aswl.min.js"></script>
<script src="/assets/js/demo.min.js"></script>
<script src="/assets/layer/layer.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script>
$(document).ready(function(){
    $("#submit").click(function(){
        if ($(this).attr("data-lock") === "true") return;
        var email=$("input[name='email']").val();
        if(email==''){layer.alert('邮箱不能为空！');return false;}
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax.php?act=find",
            data : {email:email},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 0){
                    layer.msg('发送成功，请注意查收！');
                }else{
                    layer.alert(data.msg);
                }
            }
        });
    })
});
</script>
</body>
</html>