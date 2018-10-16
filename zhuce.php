<?php
	header("Content-type:text/html;charset=utf-8");
	//1接收数据
	$username=$_POST['username'];
	$userpass=$_POST['userpass'];
	
	//处理（连接数据库，插入）
	//1)搭桥（建立连接）
	$conn=mysql_connect("localhost","root","root");
	if(!$conn){
		die("数据库连接失败");
	}else{  
		//2)选择目的地（徐泽数据库）
		mysql_select_db("dbcr7",$conn);
		//3)传输数据（执行SQL语句）
		//先查询数据库中有没有相同的用户名
		$sqlstr="select*from zhu where name='$username'";
		echo $sqlstr."<br/>";
		$table=mysql_query($sqlstr);
		$rows=mysql_num_rows($table);
		if($rows==0){
			 //如果没有相同的才插入
			$sqlstr="insert into zhu(name,pass) values('".$username."','".$userpass."')";
		    $result=mysql_query($sqlstr);
		}
		
		//4)拆桥（关闭数据库的连接）
		mysql_close($conn);
		if($result){
			//响应
			echo "注册成功，请登录";
		}else{
			echo "注册失败";
		}
	}
?>