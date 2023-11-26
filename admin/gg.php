<?php
$mod='blank';
include("../oppay/common.php");
$title='用户公告配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into admin set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的公告信息已修改成功！');history.go(-1);</script>";
    exit();
}
?>
    <div class="header bg-primary pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">用户公告配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">系统配置</a></li><li class="breadcrumb-item active" aria-current="page">用户公告配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">用户公告配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./gg.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">用户中心公告①内容:</label><textarea name="gg1" rows="2" class="form-control"><?php echo $conf['gg1']; ?></textarea><small>显示调用数据库表"['gg1']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">用户中心公告②内容:</label><textarea name="gg2" rows="2" class="form-control"><?php echo $conf['gg2']; ?></textarea><small>显示调用数据库表"['gg2']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">用户中心公告③内容:</label><textarea name="gg3" rows="2" class="form-control"><?php echo $conf['gg3']; ?></textarea><small>显示调用数据库表"['gg3']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">用户中心公告④内容:</label><textarea name="gg4" rows="2" class="form-control"><?php echo $conf['gg4']; ?></textarea><small>显示调用数据库表"['gg4']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">用户中心公告⑤内容:</label><textarea name="gg5" rows="2" class="form-control"><?php echo $conf['gg5']; ?></textarea><small>显示调用数据库表"['gg5']"</small></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-primary form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>