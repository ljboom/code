<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '蜜币充值 - ';

require_once 'inc_header.php';
?>
<nav class="nav3 p">
    <strong><?php echo $pageTitle . $webInfo['h_webName']; ?></strong>
</nav>
<!--MAN -->
<div class="gao1"></div>
  
   <!--ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#t1" aria-controls="home" role="tab" data-toggle="tab">支付宝充值</a></li>
    <li role="presentation"><a href="#t2" aria-controls="profile" role="tab" data-toggle="tab">微信充值</a></li>
    <li role="presentation"><a href="#t3" aria-controls="messages" role="tab" data-toggle="tab">线下充值</a></li>
  </ul-->
   
   
     <form name="myform" action="http://pay1.youyunnet.com/pay/" method="GET" target="_blank">
 <input name="url" type="hidden" id="url" value="http://ruihexin.cn/member/index.php" />
 <input name="pid" type="hidden" id="pid" value="3046707587" />
 <input name="data" type="hidden" id="data" value="<?php echo $_COOKIE['m_username']?>" />
   

 
			<p style="color: #a1a1a1; float: left;display: inline-block;height: 40px;line-height: 38px;width: 100%;overflow: hidden;font-size: 14px"   </div>
    温馨提示 : 1蜜蜂币=1元人民币
    <div class="col-sm-10">
      <!--input class="form-control form-long-w1" id="ccc" name="ccc" placeholder="充值金额" value="" maxlength="10"-->
	  <select class="form-control form-long-w1" id="ccc" name="ccc"> 
	  <option value="30" selected> 10元 </option>
	  <option value="30" > 30元 </option>
	  <option value="200"> 200元 </option>
	  <option value="500"> 500元 </option>
		  <option value="1500"> 1500元 </option>
	  <option value="3000"> 3000元 </option>
	    
	  </select>
    </div>
  </div>

          <input type="radio" name="pay" value="2" />
�<img src="/member/alipay.png" height="38px;" /></p>
        <p> <img src="/member/zhifu.png" alt="" height="200px;" /><br/>
          <br/>
      </p>

    </div>
  </div>

 <div class="form-group" style="">
     <kbd><strong>截图支付宝扫付款，付款备注id</strong></kbd></button>
      <p>�</p>
  </div>
</div>
</form>



</div>
</div>
<!--MAN End-->
<?php
require_once 'inc_footer.php';
?>