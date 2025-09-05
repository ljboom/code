<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '金币拍卖 - ';

require_once 'inc_header.php';
?>


<!--MAN -->

<div class="gao1"></div>
<div class="page-header long-header">
  <h3>金币管理 <small> 金币充值</small></h3>
</div>
<div>
<ol class="breadcrumb">
  <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="/member/">主页</a></li>
  <li><a href="#">金币管理</a></li>
  <li class="active">金币充值</li>
</ol>
</div>


<div class="panel panel-default">
  <div class="panel-heading">拍卖金币列表</div>
   
<div class="panel-body">

<button type="submit" class="btn btn-success guadan_go">点击充值</button>

</div>




</div>
</div>
<!--MAN End-->
</div></div>

<?php
$sql = "select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}' LIMIT 1";
$rs = $db->get_one($sql);
?>

<div class="shouhuodizhi" id="shouhuodizhi" style="display:none;">
<div style="padding:20px 50px;">
<form class="form-horizontal">
   <div class="form-group">
    <label class="col-sm-3 control-label" for="x1">可挂金币:</label>
    <div class="col-sm-9"><input class="form-control" id="x1" placeholder="您的金币余额" value="<?php echo $rs['h_point2'];?>" disabled='disabled'></div> 
  </div>
    <div class="form-group">
    <label class="col-sm-3 control-label" for="x2">收款支付宝账号:</label>
    <div class="col-sm-9"><input class="form-control" id="x2" placeholder="请填写您的支付宝账号" value="<?php echo $rs['h_alipayUserName'];?>"></div> 
  </div>
    <div class="form-group">
    <label class="col-sm-3 control-label" for="x3">收款支付宝姓名:</label>
    <div class="col-sm-9"><input class="form-control" id="x3" placeholder="请填写您支付宝对应姓名" value="<?php echo $rs['h_alipayFullName'];?>"></div> 
  </div>
 <div class="form-group">
    <label class="col-sm-3 control-label" for="x5">微信号码:</label>
    <div class="col-sm-9"><input class="form-control" id="x5" placeholder="请输入您的微信号码,方便联系" value="<?php echo $rs['h_weixin'];?>"></div> 
  </div>
 <div class="form-group">
    <label class="col-sm-3 control-label" for="x6">手机号码:</label>
    <div class="col-sm-9"><input class="form-control" id="x6" placeholder="请输入您的手机号码,方便联系" value="<?php echo $rs['h_addrTel'];?>"></div> 
  </div>  
    <div class="form-group">
    <label class="col-sm-3 control-label" for="x4">挂单金额:</label>
    <div class="col-sm-9"><input class="form-control" id="x4" placeholder="您准备卖出多少金币"></div> 
  </div>   

  <div class="form-group"></div>
   <div class="form-group">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary btn-block" onClick="guajinbi(this);return false;">马上挂售</button>
    </div>
  </div> 
</form>
</div>
</div>

 <script>
	mgo(45);
	var indexdd;
	
	$(".guadan_go").click(function(e) {
		
<?php
if(strlen($rs['h_alipayUserName']) <= 0 || strlen($rs['h_alipayFullName']) <= 0){
    echo 'layer.alert("请先修改您的支付宝信息，如果有玩家购买，会把人民币打入您的支付宝账号",function(){window.location.href="/member/pi.php";});';
    echo 'return false;';
}
?>


if(browserWidth<800){
    indexdd=layer.open({type: 1,title:'金币挂单',skin: 'layui-layer-rim',content: $("#shouhuodizhi").html()});
}else{
	indexdd=layer.open({type: 1,title:'金币挂单',area: '750px',skin: 'layui-layer-rim',content: $("#shouhuodizhi").html()});
}

	
	
	
    });
	
function guajinbi(t){
	var top=$(t).parent().parent().parent();
	var x1=top.find("#x1").val();
	var x2=top.find("#x2").val();
	var x3=top.find("#x3").val();
	var x4=top.find("#x4").val();
	var x5=top.find("#x5").val();
	var x6=top.find("#x6").val();


	if (x2==''){
			tishi4('请填写您的收款支付宝',top.find("#x2"))
			return false;
		}

	if (x3==''){
			tishi4('请填写您的收款支付宝姓名',top.find("#x3"))
			return false;
		}
		
	if (x5==''){
			tishi4('请填写您的微信号码,方便互相联系',top.find("#x5"))
			return false;
		}
		
	if (x6!=''){
		if(!checkMobile(x6)){
				tishi4('请填写正确的手机号码',top.find("#x6"))
				return false;
			}
		}

	if (x4==''){
			tishi4('请填写要挂多少金币',top.find("#x4"))
			return false;
		}
	if (!checkNum(x4) || parseFloat(x4)<10){
			tishi4('至少挂10金币,而且是整数',top.find("#x4"))
			return false;
		}
	if (parseFloat(x4)>parseFloat(x1)){
			tishi4('您的余额不足',top.find("#x4"))
			return false;
		}
	
		
	tishi2();		
	$.get("/member/bin.php?act=point2_sell_post&num="+encodeURI(x4)+"&alipayUserName="+encodeURI(x2)+"&alipayFullName="+encodeURI(x3)+"&weixin="+encodeURI(x5)+"&mobile="+encodeURI(x6),function(e){
			tishi2close();
			if(e!=""){
				if(unescape(e)=='挂单成功'){
						layer.close(indexdd);
						layer.msg('挂单成功,3秒后跳转到卖出记录',function(){window.location.href="/member/point2_sell_log.php";});
					}else{
						layer.msg(unescape(e))
					}
				
				}
			},'html');		
		
		

	}
	function jinbi_qianggou(rid){
	layer.msg("确认要拍下这单吗?如果拍下后不付款,系统会对您相应的处罚",{time: 20000, btn: ['确定拍下', '我点错了'],btn1: function(){	
		tishi2();
		$.get("/member/bin.php?act=point2_buy&id="+encodeURI(rid),function(e){
			tishi2close();
			if(e!=""){
				if(unescape(e)=='抢购成功'){
					layer.close(indexdd);
					layer.msg('抢购成功,3秒后跳转到购买记录',function(){window.location.href="/member/point2_buy_log.php";});
					}else{
					layer.msg(unescape(e))
					}
				
				}
			},'html');
		}});	
		}
$(document).ready(function(e){
	getgdlist();
	setInterval('getgdlist()',10000);
});

function getgdlist(){
	//choujianglist
	$.get("/member/bin.php?act=point2_sell_list&t="+Math.random().toString(),function(e){
		$('#xinxi').html(e)
		},'html')
	}
   </script>
    
<?php
require_once 'inc_footer.php';
?>