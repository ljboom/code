<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>标详情</title>
    <link rel="stylesheet" href="/Public/mobile/css/base.css?k=<?php echo rand(1,99999);?>"/>
    <script type="text/javascript" src="/Public/mobile/js/adaptive.js"></script>
    <script type="text/javascript" src="/Public/mobile/js/config.js"></script>
    <script type="text/javascript" src="/Public/mobile/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/Public/mobile/js/public.js"></script>
    <script type="text/javascript">
        function msg(title,content,type,url){
            $("#msgTitle").html(title);
            $("#msgContent").html(content);
            if(type==1){
                var btn = '<input type="button" value="确定" onclick="$(\'#msgBox\').hide();" style="background-color: #4f79bc;color:#fff;border: none;padding:5px 10px;"/>';
            }
            else{
                var btn = '<input type="button" value="确定" onclick="window.location.href=\''+url+'\'" style="background-color: #4f79bc;color:#fff;border: none;padding:5px 10px;"/>';
            }
            $("#msgBtn").html(btn);
            $("#msgBox").show();
        }
    </script>
</head>
<body>
<div id="msgBox" style="width: 100%;background-color: rgba(0,0,0,0.25);height: 1000px;position: fixed;top: 0;left: 0;z-index: 9999;font-size:.28rem;display: none;">
    <div style="width: 80%;margin-top: 40%;margin-left: 10%;background-color: #fff;border-radius: 5px;overflow: hidden;">
        <div id="msgTitle" style="padding:10px 20px;background-color: #4f79bc;color:#fff;">
            提示
        </div>
        <div id="msgContent" style="padding:20px;line-height: 25px;">
            内容
        </div>
        <div id="msgBtn" style="padding: 10px 20px;text-align: right;border-top: 1px solid #eee;">
            <input type="button" value="确定" style="background-color: #4f79bc;color:#fff;border: none;padding:5px 10px;"/>
            <input type="button" value="取消" style="background-color: #4f79bc;color:#fff;border: none;padding:5px 10px;"/>
        </div>
    </div>
</div>
<div class="mobile">
    <div class="othertop">
        <a class="goback" href="javascript:history.back();"><img src="/Public/mobile/img/goback.png" /></a>
        <div class="othertop-font">投资详情</div>
    </div>
    <div class="header-nbsp"></div>
    <!-- 详情 -->
    <div class="details_top">
       <img src="/Public/uploads/item/<?php echo ($data["img"]); ?>">
        <h1><?php echo ($data["title"]); ?></h1>
        <ul>
            <li>
                <div class="inner">
                    <p>
                        <span class="span2">项目规模</span>
                        <span class="span1">￥<i><?php echo round($data['total'],2);?></i>万元</span>
                    </p>
                    <p>
                        <span class="span2">每份分红</span>
                        <span class="span1"><i><?php echo round($data['min']*$data['rate']/100,2);?></i>元起</span>
                    </p>
                    <p>
                        <span class="span2">投资周期</span>
                        <span class="span1"><i><?php echo ($data["day"]); ?></i>天</span>
                    </p>
                </div>
            </li>
            <li>分红方式：<?php echo getProjectType($data['type']);?></li>
            <li>起投金额：<?php echo round($data['min'],2);?>元</li>
            <li>担保机构：<?php echo ($data["guarantee"]); ?></li>
            <li>投资零风险：本金保障
                <div class="progressBox1">
                    <div class="progress1" style="width:<?php echo getProjectPercent($data['id']);?>%"></div>
                    <span class="progressNum1"><?php echo round(getProjectPercent($data['id']),2);?>%</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="details_foot">
        <div class="tabs">
            <span class="on">投资详情</span>
            <span>项目资料</span>
        </div>
        <div class="explain_outer">
            <table class="table">
                <tr>
                    <td><span>项目名称</span></td>
                    <td><?php echo ($data["title"]); ?></td>
                </tr>
                <tr>
                    <td>项目金额：</td>
                    <td><i><?php echo round($data['total'],2);?>万</i>元人民币；</td>
                </tr>
                <tr>
                    <td>每天分红：</td>
                    <td><i>按每日<?php echo round($data['rate'],2);?>%的收益（保本保息）</i></td>
                </tr>
                <tr>
                    <td>投资金额：</td>
                    <td><i>最低起投<?php echo ($data["min"]); ?>元</i>（限买<?php echo ($data["num"]); ?>份）</td>
                </tr>
                <tr>
                    <td>项目期限：</td>
                    <td><i><?php echo ($data["day"]); ?>个</i>自然日；</td>
                </tr>
                <tr>
                    <td>收益计算：</td>
                    <td><i><?php if($data['type'] != 4): ?>每天分红<?php echo round($data['min']*$data['rate']/100,2);?>元<?php else: ?>本金复利分红<?php endif; ?></i>*<i><?php echo ($data["day"]); ?>天</i>=总收益<i><?php if($data['type'] != 4): echo round($data['min']*$data['rate']/100*$data['day'],2); else: echo getFuliIncome($data['min'],$data['rate'],$data['day']); endif; ?></i>元；</td>
                </tr>
                <tr>
                    <td>还款方式：</td>
                    <td><?php echo getProjectType($data['type']);?> 节假日照常收益；</td>
                </tr>
                <tr>
                    <td>结算时间：</td>
                    <td>当天15点投资，第二天15点系统自动计息结算收益（例如在15:00成功投资，则在下个自然日15:00收到分红），到期系统将当日分红和产品本金一起返还到您的会员账号中；</td>
                </tr>
                <tr>
                    <td>可投金额：</td>
                    <td>投资期间只要产品未投满，投资者均可自由投资；</td>
                </tr>
                <!--<tr>
                    <td>资金用途：</td>
                    <td>新手版票体验项目</td>
                </tr>-->
                <tr>
                    <td>安全保障：</td>
                    <td><?php echo ($data["guarantee"]); ?>对平台上的每一笔投资提供<i>100%本金保障</i>，平台设立风险备用金，对本金承诺全额垫付；</td>
                </tr>
                <tr>
                    <td>项目概述：</td>
                    <td>本项目筹集资金<i><?php echo round($data[total],2);?>万</i>元人民币，投资本项目（<?php if($data['type'] != 4): ?>按每日分红<i><?php echo round($data['min']*$data['rate']/100,2);?>元/天</i><?php else: ?><i>本金复利分红/天</i><?php endif; ?>）项目周期为<i><?php echo ($data["day"]); ?></i>个自然日，所筹集资金用于该项目直投运作，作为投资者分红固定且无任何风险，所操作一切风险都由公司与担保公司一律承担，投资者不需要承担任何风险。</td>
                </tr>
				  <td>推荐奖励：</td>
                    <td>在会员中心最下面(邀请好友)转发到您朋友圈里,只要您朋友通过邀请二维码注册的为一级,充值并成功投资一次性还款项目,您就可以得到按投资金额<?php echo getReward('invest1');?>%的奖励,注册成功后，系统自动赠送 ！</td>
                </tr>
            </table>
            <div class="data">
                <?php echo ($data["content"]); ?>
            </div>
        </div>
    </div>
    <div class="header-nbsp"></div>
    <div class="invest_btn">
        <?php if(getProjectPercent($data['id']) == 100): ?><a href="javascript:;" style="background-color: #888;">项目已满</a>
            <?php else: ?>
            <a href="<?php echo U('form','id='.$data['id']);?>">马上投资</a><?php endif; ?>
    </div>
</div>
<script>
    $().ready(function(){
        var value = $(".progressNum1").text();
        var result = toPoint(value) - toPoint("<?php echo getProjectPercent($data['id']);?>%");
        $(".progressNum1").css("left",toPercent(result));
        $(".tabs span:eq(0)").click(function(){
            $(this).addClass("on");
            $(".tabs span:eq(1)").removeClass("on");
            $(".explain_outer .table").show();
            $(".explain_outer .data").hide();
        });
        $(".tabs span:eq(1)").click(function(){
            $(this).addClass("on");
            $(".tabs span:eq(0)").removeClass("on");
            $(".explain_outer .table").hide();
            $(".explain_outer .data").show();
        });
    });
</script>
</body>
</html>