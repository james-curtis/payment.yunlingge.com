<?php
include("../oppay/common.php");
$title='转账明细';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$rs=$DB->query("SELECT * FROM pay_zhuan WHERE 1 order by trade_no desc limit 0,$numrows");
$url=creat_callback($res);
?>

		<div class="header bg-primary pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">转账明细</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">资金管理</a></li><li class="breadcrumb-item active" aria-current="page">转账明细</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                转账明细查询
              </h3>
              <p class="text-sm mb-0">
                共有 <b><?php echo $numrows ?></b> 条记录
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>转账ID</th><th>收款ID</th><th>转账金额</th><th>创建时间/完成时间</th></tr></thead><tfoot><tr><th>转账ID</th><th>收款ID</th><th>转账金额</th><th>创建时间/完成时间</th></tr></tfoot>
                <tbody>
                  <?php
                    foreach($rs as $res){
                    echo '<tr></td><td>' . $res['pid'] . '</td><td>' . $res['uid'] . '</td><td>' . $res['money'] . '</td><td>' . $res['time'] . '</tr>';
                  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>