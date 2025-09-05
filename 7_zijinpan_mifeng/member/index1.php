<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '';

require_once 'inc_header.php';
?>
<!--ul class="ab_list">
                        <li>
                            <div class="ab_l"><i class="icon pj"></i></div>
                            <div class="ab_r">
                                <h3>推广连接</h3>
                                <p class="gray3 f12">每一单安心购有质量保证！</p>
								  <p class="gray3 f12">二维码图片生成！</p>
                            </div>
              




	
    链接推广: 
<input onclick="oCopy(this)" value="<?php echo $url; ?>">
<script language="javascript">
function oCopy(obj){
obj.select();
js=obj.createTextRange();
js.execCommand("Copy")
alert("复制成功!");
}
</script>	
	<p>二维码图片推广(手机长按保存)：</p>
	<img src="ewm.php?url=<?php echo urlencode($url);?>" />
	</td-->
	
    </tr>
    <tr>
</td>
    </tr>
</table>


</div>



  </table>
<!--MAN End-->
</div></div>
<div class="panel-body"><h3 style="text-align:center;">分享须知</h3><p>所有会员请先扫描下方二维码&darr;添加客服微信，然后客服会拉您进群，欢迎加入我们的微信群大家庭，一手福利信息都会在群里公布，请不要错过！<br />
<img alt="" src="/images/ewm_bg.png" style="width: 300px; height: 1000px;" /></p><br /></div>

<?php
require_once 'inc_footer.php';
?>