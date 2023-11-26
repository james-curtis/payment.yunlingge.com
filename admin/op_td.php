<?php
$mod='blank';
include("../oppay/common.php");
$title='支付通道配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into admin set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的接口信息已修改成功！');history.go(-1);</script>";
    exit();
}
?>

    <div class="header bg-primary pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">支付通道配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">接口设置</a></li><li class="breadcrumb-item active" aria-current="page">支付通道配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">支付通道配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_td.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">支付宝:</label><select class="form-control text-danger" name="alipay_mode" default="<?php echo $conf['alipay_mode']?>"><option value="0">关闭</option><option value="1">官方</option><option value="2">易支付</option><option value="3">码支付</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">微信支付:</label><select class="form-control text-info" name="wxpay_mode" default="<?php echo $conf['wxpay_mode']?>"><option value="0">关闭</option><option value="1">官方</option><option value="2">易支付</option><option value="3">码支付</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">QQ钱包:</label><select class="form-control text-success" name="qqpay_mode" default="<?php echo $conf['qqpay_mode']?>"><option value="0">关闭</option><option value="1">官方</option><option value="2">易支付</option><option value="3">码支付</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">财付通:</label><select class="form-control text-warning" name="tenpay_mode" default="<?php echo $conf['tenpay_mode']?>"><option value="0">关闭</option><option value="1">官方</option><option value="2">易支付</option><option value="3">码支付</option></select></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-primary form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>