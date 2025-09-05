<?php
header("Content-type: text/html; charset=utf-8");

$servername = "localhost";
$username = "root";
$password = "52jscn.com";
$dbname = "demo";
$sl=$_POST['sl'];
$sl1=$_GET['sl1'];
$bookname=$_POST['bookname'];//书名
$author=$_POST['author'];//作者
$des=$_POST['des'];//简介
$tstype=$_POST['tstype'];//漫画首页分类
$sstype=$_POST['sstype'];//所属分类
$zishu=$_POST['zishu'];//简介
$litpic=$_POST['litpic'];//封面图
$time=$_POST['time'];//发布时间
$sharetitle=$_POST['sharetitle'];//发布时间
$mhtitle=$_POST['title'];//漫画标题
$jino=$_POST['jino'];//漫画编号
$mhbody=$_POST['content'];//漫画内容
$jine=$_POST['jine'];//阅读金额
$sex=$_POST['sex'];//阅读金额
$send=$_POST['send'];//打赏金额

// 漫画阅读数（3万-700万之间）
$reads_mh=mt_rand(30000, 7000000);

// 漫画点赞数（1万-2万之间）
$dz_mh=mt_rand(10000, 20000);

// 章节点赞数（1万-2万之间）
$dzzj_mh=mt_rand(10000, 20000);

// 收藏数（5000-9000之间）
$sc_mh=mt_rand(5000, 9000);

// 打赏数（1000-5000之间）
$ds_mh=mt_rand(1000, 5000);

// 小说阅读数（1万-10万之间）
$reads_book=mt_rand(10000, 100000);

// 小说点赞数（3000-1万之间）
$dz_book=mt_rand(3000, 10000);

// 章节点赞数（3000-1万之间）
$dzzj_book=$dz_book;

// 收藏数（3000-5000之间）
$sc_book=mt_rand(3000, 5000);

// 打赏数（1000-3000之间）
$ds_book=mt_rand(1000, 3000);

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// 检测连接
if ($conn->connect_error) {
    die("fail: " . $conn->connect_error);
	return;
} 
if($sl1==3)
{
  for($i=114;$i<417;$i++)
  { $upsql="UPDATE vv_mh_list SET summary=share_desc where id=$i";
         $conn->query($upsql);
		   echo ' 更新成功';
  }
		   return;
}
//添加漫画
if($sl==1){
	if($bookname!=""){
		$stype="SELECT * FROM `vv_mh_list` where title='$bookname'";
    	$result=$conn->query($stype);
  	 	if($result->num_rows>0){
	  		while ($row = mysqli_fetch_assoc($result)){
	 			$mhid=$row['id'];
     			$cid=$row['cid'];
	 			$before=$jino-1;
	   			$next=$jino+1;
	 			$zjsql="INSERT INTO `vv_mh_episodes` (`mhid`, `title`, `ji_no`, `pics`, `likes`, `readnums`, `before`, `next`, `money`, `create_time`, `update_time`) VALUES
				($mhid, '$mhtitle', $jino, '$mhbody', 50, 0, $before, $next, $jine,$time, $time);";
       			$result=$conn->query($zjsql);
       			$lastid=mysqli_insert_id($conn);
	   			if($lastid>1){ 
        			$upsql="UPDATE vv_mh_list SET episodes=$jino WHERE id=$mhid;";
         			$conn->query($upsql);
		   			echo '添加小说成功';
		   			return;
	   			}else{
		 			echo 'fail:添加小说失败'; 
     				return;		 
	   			}
			}
			return;		
 		}else{
            $booksql="INSERT INTO `vv_mh_list` (`title`, `mhcate`, `send`, `cateids`, `author`, `summary`, `cover_pic`, `detail_pic`, `sort`, `status`, `free_type`, `episodes`, `pay_num`, `reader`, `likes`, `collect`, `is_new`, `is_recomm`, `create_time`, `update_time`, `readnum`, `chargenum`, `chargemoney`, `share_title`, `share_pic`, `share_desc`) VALUES
            ('$bookname', '$tstype', $send, '$sstype', '$author', '$des', '$litpic', '$litpic', 12, 1, 2, 1, 10, $reads_mh, $dz_mh, $sc_mh, 1, 1, $time, $time, 1, 0, 0, '', '$litpic', '$des')";
            $result=$conn->query($booksql);
            $lasmhid=mysqli_insert_id($conn);
            $before=$jino-1;
            $next=$jino+1;
            $zjsql="INSERT INTO `vv_mh_episodes` (`mhid`, `title`, `ji_no`, `pics`, `likes`, `readnums`, `before`, `next`, `money`, `create_time`, `update_time`) VALUES
			($lasmhid, '$mhtitle', $jino, '$mhbody', $dzzj_mh, 0, $before, $next, $jine,$time, $time);";
       		$result=$conn->query($zjsql);
       		$lastid=mysqli_insert_id($conn);
	   		if($lasmhid>1){
		   		echo '添加小说成功';
	   		}else{
		 		echo 'fail:添加小说失败';  
	   		}
   		}
	}
	else{
		echo 'fail:书籍名不能为空';
	}
}

//添加小说
if($sl==2){
	if($bookname!=""){
		$stype="SELECT * FROM `vv_book` where title='$bookname'";
    	$result=$conn->query($stype);
  	 	if($result->num_rows>0){
	 		while ($row = mysqli_fetch_assoc($result)){
	 			$mhid=$row['id'];
     			$cid=$row['cid'];
     			$jino=$row['episodes']+1;
	 			$before=$jino-1;
	   			$next=$jino+1;
				$zjsql="INSERT INTO `vv_book_episodes` (`bid`, `title`, `ji_no`, `info`, `readnums`, `likes`, `before`, `next`, `money`, `create_time`, `update_time`) VALUES
				($mhid, '$mhtitle', $jino, '$mhbody', 0, 50, $before, $next, $jine, $time, $time);";
     			$result=$conn->query($zjsql);
       			$lastid=mysqli_insert_id($conn);
	   			if($lastid>1){ 
	  				$upsql="UPDATE vv_book SET episodes=$jino WHERE id=$mhid;";
         			$conn->query($upsql);
		   			echo '添加小说成功';
		   			return;
	   			}else{
		 			echo 'fail:添加小说失败'; 
     				return;		 
	   				}
			}
			return;		
		 }else{
 			$booksql="INSERT INTO `vv_book` (`title`, `cateids`, `bookcate`, `send`, `author`, `summary`, `cover_pic`, `detail_pic`, `sort`, `status`, `free_type`, `episodes`, `pay_num`, `reader`, `likes`, `collect`, `is_new`, `is_recomm`, `create_time`, `update_time`, `readnum`, `chargenum`, `chargemoney`, `share_title`, `share_pic`, `share_desc`) VALUES
			('$bookname', '$sstype', '$tstype',$send, '$author', '$des', '$litpic', '$litpic', 1, 2, 2, 1,10, $reads_book, $dz_book, $sc_book, 1, 1, $time, $time, 0, 0, 0, '$bookname', '', '$litpic')";
       		$result=$conn->query($booksql);
       		$lasmhid=mysqli_insert_id($conn);
	  		$before=$jino-1;
	  	 	$next=$jino+1;
			$zjsql="INSERT INTO `vv_book_episodes` (`bid`, `title`, `ji_no`, `info`, `readnums`, `likes`, `before`, `next`, `money`, `create_time`, `update_time`) VALUES
			($lasmhid, '$mhtitle', 1, '$mhbody', 0, $dzzj_book, $before, $next, $jine, $time, $time);";
			echo $booksql;
       		$result=$conn->query($zjsql);
       		$lastid=mysqli_insert_id($conn);
	   		if($lasmhid>1){
		   		echo '添加小说成功';
	   		}else{
		 		echo 'fail:添加小说失败';  
	   		}
   		}
	}else{
		echo 'fail:书籍名不能为空';
	}
}


//添加听书
if($sl==3){
	if($bookname!=""){
		$stype="SELECT * FROM `vv_yook` where title='$bookname'";
    	$result=$conn->query($stype);
  	 	if($result->num_rows>0){
	 		while ($row = mysqli_fetch_assoc($result)){
	 			$mhid=$row['id'];
     			$cid=$row['cid'];
     			$jino=$row['episodes']+1;
	 			$before=$jino-1;
	   			$next=$jino+1;
				$zjsql="INSERT INTO `vv_yook_episodes` (`yid`, `title`, `ji_no`, `info`, `likes`, `before`, `next`, `money`, `create_time`, `update_time`) VALUES
				($mhid, '$mhtitle', $jino, '$mhbody', 50, $before, $next, $jine, $time, $time);";
     			$result=$conn->query($zjsql);
       			$lastid=mysqli_insert_id($conn);
	   			if($lastid>1){ 
	  				$upsql="UPDATE vv_yook SET episodes=$jino WHERE id=$mhid;";
         			$conn->query($upsql);
		   			echo '添加听书成功';
		   			return;
	   			}else{
		 			echo 'fail:添加听书失败'; 
     				return;		 
	   				}
			}
			return;		
		 }else{
 			$booksql="INSERT INTO `vv_yook` (`title`, `cateids`, `bookcate`, `send`, `author`, `summary`, `cover_pic`, `detail_pic`, `sort`, `status`, `free_type`, `episodes`, `pay_num`, `reader`, `likes`, `collect`, `is_new`, `is_recomm`, `create_time`, `update_time`, `readnum`, `chargenum`, `chargemoney`) VALUES
			('$bookname', '$tstype', '$sstype',$send, '$author', '$des', '$litpic', '$litpic', 1, 2, 2, 1,10, $reads_book, $dz_book, $sc_book, 1, 1, $time, $time, 0, 0, 0)";
       		$result=$conn->query($booksql);
       		$lasmhid=mysqli_insert_id($conn);
	  		$before=$jino-1;
	  	 	$next=$jino+1;
			$zjsql="INSERT INTO `vv_yook_episodes` (`yid`, `title`, `ji_no`, `info`, `likes`, `before`, `next`, `money`, `create_time`, `update_time`) VALUES
			($lasmhid, '$mhtitle', 1, '$mhbody', 0, $dzzj_book, $before, $next, $jine, $time, $time);";
			echo $booksql;
       		$result=$conn->query($zjsql);
       		$lastid=mysqli_insert_id($conn);
	   		if($lasmhid>1){
		   		echo '添加小说成功';
	   		}else{
		 		echo 'fail:添加小说失败';  
	   		}
   		}
	}else{
		echo 'fail:书籍名不能为空';
	}
}

//添加动漫
if($sl==4){
	if($bookname!=""){
		$stype="SELECT * FROM `vv_video` where title='$bookname'";
    	$result=$conn->query($stype);
  	 	if($result->num_rows>0){
	 		while ($row = mysqli_fetch_assoc($result)){
	 			$mhid=$row['id'];
     			$cid=$row['cid'];
     			$jino=$row['episodes']+1;
	 			$before=$jino-1;
	   			$next=$jino+1;
				$zjsql="INSERT INTO `vv_video_episodes` (`vid`, `title`, `ji_no`, `info`, `likes`, `before`, `next`, `money`, `create_time`, `update_time`) VALUES
				($mhid, '$mhtitle', $jino, '$mhbody', 50, $before, $next, $jine, $time, $time);";
     			$result=$conn->query($zjsql);
       			$lastid=mysqli_insert_id($conn);
	   			if($lastid>1){ 
	  				$upsql="UPDATE vv_video SET episodes=$jino WHERE id=$mhid;";
         			$conn->query($upsql);
		   			echo '添加动漫成功';
		   			return;
	   			}else{
		 			echo 'fail:添加动漫失败'; 
     				return;		 
	   				}
			}
			return;		
		 }else{
 			$booksql="INSERT INTO `vv_video` (`title`, `cateids`, `bookcate`, `send`, `author`, `summary`, `cover_pic`, `detail_pic`, `sort`, `status`, `free_type`, `episodes`, `pay_num`, `reader`, `likes`, `collect`, `is_new`, `is_recomm`, `create_time`, `update_time`, `readnum`, `chargenum`, `chargemoney`) VALUES
			('$bookname', '$tstype', '$sstype',$send, '$author', '$des', '$litpic', '$litpic', 1, 2, 2, 1,10, $reads_book, $dz_book, $sc_book, 1, 1, $time, $time, 0, 0, 0)";
       		$result=$conn->query($booksql);
       		$lasmhid=mysqli_insert_id($conn);
	  		$before=$jino-1;
	  	 	$next=$jino+1;
			$zjsql="INSERT INTO `vv_video_episodes` (`vid`, `title`, `ji_no`, `info`, `likes`, `before`, `next`, `money`, `create_time`, `update_time`) VALUES
			($lasmhid, '$mhtitle', 1, '$mhbody', 0, $dzzj_book, $before, $next, $jine, $time, $time);";
			echo $booksql;
       		$result=$conn->query($zjsql);
       		$lastid=mysqli_insert_id($conn);
	   		if($lasmhid>1){
		   		echo '添加小说成功';
	   		}else{
		 		echo 'fail:添加小说失败';  
	   		}
   		}
	}else{
		echo 'fail:书籍名不能为空';
	}
}
$conn->close();