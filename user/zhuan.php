<?php 
include("../oppay/common.php");

if ($islogin2 != 1) {
  
exit("<script language='javascript'>window.location.href='./login.php';</script>");

}

$title = '商户转账';

include './head.php';

if($conf['settle_zhuan']==0){
		
	exit("<script language='javascript'>alert('本站管理员暂未开启商户转账功能，如有疑问请联系客服！');history.go(-1);</script>");
	
		}

		$my=isset($_GET['my'])?$_GET['my']:null;

		if($my=='zhuan'){

		$user=$_POST['id'];
	
$money=$_POST['money'];
	
$pass=$_POST['pass'];

		$row=$DB->query("select * from pay_user where id='$user' limit 1")->fetch();
	 
if (!$row) {
exit("<script language='javascript'>alert('啊，转账ID不存在呢，擦亮眼睛好好检查一下吧！');history.go(-1);</script>");

	 }elseif($user==$userrow['id']) {
  
	 exit("<script language='javascript'>alert('哦不，臣妾实在做不到给自己转账呢，哈哈！');history.go(-1);</script>");

	 }elseif(md5($pass) != $userrow['zpass']){
  
	 exit("<script language='javascript'>alert('咦，支付密码错误哦，重试一遍吧！');history.go(-1);</script>");

	 }elseif($userrow['money'] < $money){
  
	 exit("<script language='javascript'>alert('呜呜呜，桑心的告诉您，当前商户余额不足需要转账的金额呢，继续努力吧！');history.go(-1);</script>");
	 
}else{
  
	 $zhuan=$DB->query("update pay_user set money=money+{$money} where id='{$user}'");
  
	 $zhuans=$DB->query("update pay_user set money=money-{$money} where id='{$pid}'");
 
	 if($zhuan and $zhuans){
   
	 $DB->query("insert into `pay_zhuan` (`uid`,`pid`,`money`,`time`) values ('".$user."','".$pid."','".$money."','".$date."')");
    
	 exit("<script language='javascript'>alert('恭喜您，转账成功！');history.go(-1);</script>");
  
	 }else{
    
	 exit("<script language='javascript'>alert('很抱歉，转账失败，有问题请咨询本站客服！');history.go(-1);</script>");
  
	 }

	 }

	 }elseif($my=='xgpass'){
  
	 $pass=$_POST['pass'];
  
	 $password=md5($pass);
  
	 if($password == $userrow['zpass']){
   
	 exit("<script language='javascript'>alert('新转账支付密码不能和原始转账支付密码相同哦！');history.go(-1);</script>");
  
	 }else{ 
  
	 $sql=$DB->exec("update `pay_user` set `zpass` ='$password' where `id`='$pid'");
    
	 if($sql){
    exit("<script language='javascript'>alert('恭喜您，转账支付密码修改成功！');history.go(-1);</script>");
    
	 }else{
    
	 exit("<script language='javascript'>alert('很抱歉，转账支付密码修改失败，有问题请咨询本站客服！');history.go(-1);</script>");
    
	 }
  
	 }

	 }

	 $numrows=$DB->query("SELECT * from pay_zhuan WHERE pid={$pid}")->rowCount();
$list=$DB->query("SELECT * FROM pay_zhuan WHERE pid={$pid} order by id desc limit 0,$numrows")->fetchAll();

	 ?>
	 <div class="header bg-primary pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">商户转账</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">商户转账</a></li></ol></nav></div></div></div></div>
	 </div>
	 <div class="container-fluid mt--6">
      
	 <div class="row">
        
	 <div class="col-xl-6">
         
	 <div class="card-wrapper">
           
	 <!-- Custom form validation -->
            
	 <div class="card">
              
	 <!-- Card header -->
              
	 <div class="card-header">
                
	 <h3 class="mb-0">商户信息</h3>
              
	 </div>
              
	 <!-- Card body -->
              
	 <div class="card-body">
                
	 <div class="form-row">
                  
	 <div class="col-md-12 mb-3">
                    
	 <label class="form-control-label">
                     
	  商户ID
                    
	  </label>
                    
	  <input type="text" class="form-control" value="<?php echo $pid?>" disabled>
                  
	  </div>
                  
	  <div class="col-md-12 mb-3">
                    
	  <label class="form-control-label">
                      
	  商户余额
                    
	  </label>
                    
	  <input type="text" class="form-control" value="￥<?php echo $userrow['money'] ?>" disabled>
                  
	  </div>
                  
	  <div class="col-md-12 mb-3">
                    
	  <label class="form-control-label">
                      
	  支付密码
                    
	  </label>
                    
	  <div class="input-group">
                      
	  <input class="form-control" id="disableinput" type="text" name="pass" value="******"disabled>
                      
	  <div class="input-group-append"><button type="button"class="btn btn-default"id="checkbind">修改支付密码</button>
                      
	  </div>
                    
	  </div>
                  
	  </div>
                
	  </div>
              
	  </div>
            
	  </div>
          
	  </div>
        
	  </div>
        
	  <div class="col-xl-6">
          
	  <div class="card-wrapper">
            
	  <!-- Custom form validation -->
            
	  <div class="card">
              
	  <!-- Card header -->
              
	  <div class="card-header">
                
	  <h3 class="mb-0">商户转账</h3>
              
	  </div>
              
	  <!-- Card body -->
              
	  <div class="card-body">
                
	  <form action="./zhuan.php?my=zhuan" method="POST">
                  
	  <div class="form-group">
                    
	  <label>ID</label>
                      
	  <input type="text" name="id" class="form-control" placeholder="转账ID" required>
                  
	  </div>
                  
	  <div class="form-group">
                    
	  <label>金额</label>
                      
	  <input type="text" name="money" class="form-control" placeholder="金额" required>
                  
	  </div>
                  
	  <div class="form-group">
                    
	  <label>支付密码</label>
                      
	  <input type="password" name="pass" class="form-control" placeholder="支付密码" required>
                  
	  </div>
                  
	  <button class="btn btn-primary form-control"type="submit"name="submit">确定修改</button>
                
	  </form>
              
	  </div>
            
	  </div>
          
	  </div>
        
	  </div>
      
	  </div>
      
	  <div class="row">
        
	  <div class="col">
          
	  <div class="card">
            
	  <div class="card-header">
              
	  <h3 class="mb-0">
                
	  商户转账记录
              
	  </h3>
              
	  <p class="text-sm mb-0">
                
	  共有 <b><?php echo $numrows?></b> 条记录
              
	  </p>
            
	  </div>
            
	  <div class="table-responsive py-4">
              
	  <table class="table table-flush" id="datatable-basic">
                
	  <thead class="thead-light"><tr><th>商户ID</th><th>转账ID</th><th>UID</th><th>金额</th><th>转账时间</th></tr></thead><tfoot><tr><th>商户ID</th><th>转账ID</th><th>UID</th><th>金额</th><th>转账时间</th></tr></tfoot>
                
	  <tbody>
                  
	  <?php
                    
	  foreach($list as $res){
                    
	  echo '<tr><td>'.$res['id'].'</td><td>'.$res['uid'].'</td><td>'.$res['pid'].'</td><td>'.$res['money'].'</td><td>'.$res['time'].'</td></tr>';
                  
	  }?>
                
	  </tbody>
              
	  </table>
            
	  </div>
          
	  </div>
        
	  </div>
      
	  </div>
      
	  <div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        
	  <div class="modal-dialog modal-dialog-centered" role="document">
          
	  <div class="modal-content">
            
	  <div class="modal-header bg-primary">
              
	  <h6 class="modal-title" id="largeModalLabel">验证密保信息</h6>
              
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span
                    
	  aria-hidden="true">&times;</span></button>
            
	  </div>
            
	  <div class="modal-body">
              
	  <?php if ($conf['verifytype'] == 1) { ?>
                
	  <div class="form-group"><div class="input-group input-group-merge input-group-alternative"><div class="input-group-prepend"><span class="input-group-text"><i class="ni ni-mobile-button"></i></span></div><p class="form-control"style="font-weight: bold;">当前密保手机：<?php echo $userrow['phone']?></p></div>
                
	  </div>
                
	  <div class="form-group"><div class="form-group"><div class="input-group"><input class="form-control"type="text"name="code"placeholder="输入短信验证码"required><div class="input-group-append"><button type="button"class="btn btn-default"id="sendcode">获取验证码</button></div></div></div>
                
	  </div>
              
	  <?php } else { ?>
                
	  <div class="form-group"><div class="input-group input-group-merge input-group-alternative"><div class="input-group-prepend"><span class="input-group-text"><i class="ni ni-email-83"></i></span></div><p class="form-control"style="font-weight: bold;">当前密保邮箱：<?php echo $userrow['email']?></p></div>
                
	  </div>
                
	  <div class="form-group"><div class="form-group"><div class="input-group"><input class="form-control"type="text"name="code"placeholder="输入邮箱验证码"required><div class="input-group-append"><button type="button"class="btn btn-default"id="sendcode">获取验证码</button></div></div></div>
                
	  </div>
              
	  <?php } ?>
              
	  <button type="button" id="verifycode" class="btn btn-primary form-control">确定</button>
              
	  <div id="embed-captcha"></div>
            
	  </div>
          
	  </div>
        
	  </div>
      
	  </div>
     
	  <div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
        
	  <div class="modal-dialog">
          
	  <div class="modal-content">
            
	  <div class="modal-header bg-primary">
              
	  <h6 class="modal-title">修改支付密码</h6>
              
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    
	  aria-hidden="true">&times;</span></button>
            
	  </div>
            
	  <div class="modal-body">
              
	  <form action="./zhuan.php?my=xgpass" method="POST">
                
	  <div class="form-group"><div class="input-group input-group-merge input-group-alternative"><div class="input-group-prepend"><span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span></div><input class="form-control"type="password"name="pass"placeholder="输入新的支付密码"required></div>
                
	  </div>
              
	  <button type="submit" class="btn btn-primary form-control">确定</button>
              
	  <div id="embed-captcha"></div>
              
	  </form>
            
	  </div>
          
	  </div>
        
	  </div>
      
	  </div>
<?php include 'foot.php';?>

	  <script src="//static.geetest.com/static/tools/gt.js"></script>
<script>
function invokeSettime(obj){
    var countdown=60;
    settime(obj);
    function settime(obj) {
        if (countdown == 0) {
            $(obj).attr("data-lock", "false");
            $(obj).text("获取验证码");
            countdown = 60;
            return;
        } else {
            $(obj).attr("data-lock", "true");
            $(obj).attr("disabled",true);
            $(obj).text("(" + countdown + ") s 重新发送");
            countdown--;
        }
        setTimeout(function() {
                    settime(obj) }
                ,1000)
    }
}
var handlerEmbed = function (captchaObj) {
    var target;
    captchaObj.onReady(function () {
        $("#wait").hide();
    }).onSuccess(function () {
        var result = captchaObj.getValidate();
        if (!result) {
            return alert('请完成验证');
        }
        var situation=$("#situation").val();
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax2.php?act=sendcode",
            data : {situation:situation,target:target,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 0){
                    new invokeSettime("#sendcode");
                    new invokeSettime("#sendcode2");
                    layer.msg('发送成功，请注意查收！');
                }else{
                    layer.alert(data.msg);
                    captchaObj.reset();
                }
            } 
        });
    });
    $('#sendcode').click(function () {
        if ($(this).attr("data-lock") === "true") return;
        captchaObj.verify();
    });
    $('#sendcode2').click(function () {
        if ($(this).attr("data-lock") === "true") return;
        if($("input[name='phone_n']").length>0){
            target=$("input[name='phone_n']").val();
            if(target==''){layer.alert('手机号码不能为空！');return false;}
            if(target.length!=11){layer.alert('手机号码不正确！');return false;}
        }else{
            target=$("input[name='email_n']").val();
            if(target==''){layer.alert('邮箱不能为空！');return false;}
            var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
            if(!reg.test(target)){layer.alert('邮箱格式不正确！');return false;}
        }
        captchaObj.verify();
    })
    // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
};
$(document).ready(function(){
    $("select[name='stype']").change(function(){
        if($(this).val() == 1){
            $("#typename").html("支付宝账号");
        }else if($(this).val() == 2){
            $("#typename").html("微信Openid");
        }else if($(this).val() == 3){
            $("#typename").html("QQ号");
        }else if($(this).val() == 4){
            $("#typename").html("银行卡号");
        }
    });
    $("#editSettle").click(function(){
        var stype=$("select[name='stype']").val();
        var account=$("input[name='account']").val();
        var username=$("input[name='username']").val();
        if(account=='' || username==''){layer.alert('请确保各项不能为空！');return false;}
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax2.php?act=edit_settle",
            data : {stype:stype,account:account,username:username},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 1){
                    layer.alert('修改成功！');
                }else if(data.code == 2){
                    $("#situation").val("settle");
                    $('#myModal').modal('show');
                }else{
                    layer.alert(data.msg);
                }
            }
        });
    });
    $("#editInfo").click(function(){
        var email=$("input[name='email']").val();
        var qq=$("input[name='qq']").val();
        var url=$("input[name='url']").val();
        if(email=='' || qq=='' || url==''){layer.alert('请确保各项不能为空！');return false;}
        if(email.length>0){
            var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
            if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
        }
        if (url.indexOf(" ")>=0){
            url = url.replace(/ /g,"");
        }
        if (url.toLowerCase().indexOf("http://")==0){
            url = url.slice(7);
        }
        if (url.toLowerCase().indexOf("https://")==0){
            url = url.slice(8);
        }
        if (url.slice(url.length-1)=="/"){
            url = url.slice(0,url.length-1);
        }
        $("input[name='url']").val(url);
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax2.php?act=edit_info",
            data : {email:email,qq:qq,url:url},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 1){
                    layer.alert('修改成功！');
                }else{
                    layer.alert(data.msg);
                }
            }
        });
    });
    $("#checkbind").click(function(){
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "GET",
            url : "ajax2.php?act=checkbind",
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 1){
                    $("#situation").val("bind");
                    $('#myModal2').modal('show');
                }else if(data.code == 2){
                    $("#situation").val("mibao");
                    $('#myModal').modal('show');
                }else{
                    layer.alert(data.msg);
                }
            }
        });
    });
    $("#editBind").click(function(){
        var phone=$("input[name='phone_n']").val();
        var email=$("input[name='email_n']").val();
        var code=$("input[name='code_n']").val();
        if(code==''){layer.alert('请输入验证码！');return false;}
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax2.php?act=edit_bind",
            data : {phone:phone,email:email,code:code},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 1){
                    layer.msg('修改绑定成功，正在跳转中...', {icon: 16,shade: 0.01,time: 15000});
                    setTimeout(window.location.reload(), 1000);
                }else{
                    layer.alert(data.msg);
                }
            }
        });
    });
    $("#verifycode").click(function(){
        var code=$("input[name='code']").val();
        var situation=$("#situation").val();
        if(code==''){layer.alert('请输入验证码！');return false;}
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax2.php?act=verifycode",
            data : {code:code},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 1){
                    layer.msg('验证成功！');
                    $('#myModal').modal('hide');
                    if(situation=='settle'){
                        $("#editSettle").click();
                    }else if(situation=='mibao'){
                        $("#situation").val("bind");
                        $('#myModal2').modal('show');
                    }else if(situation=='bind'){
                        $('#myModal2').modal('hide');
                        window.location.reload();
                    }
                }else{
                    layer.alert(data.msg);
                }
            }
        });
    });
    $.ajax({
        // 获取id，challenge，success（是否启用failback）
        url: "ajax.php?act=captcha&t=" + (new Date()).getTime(), // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            console.log(data);
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                width: '100%',
                gt: data.gt,
                challenge: data.challenge,
                new_captcha: data.new_captcha,
                product: "bind", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerEmbed);
        }
    });
    var items = $("select[default]");
    for (i = 0; i < items.length; i++) {
        $(items[i]).val($(items[i]).attr("default")||1);
    }
});
</script>