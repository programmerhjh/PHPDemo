


<?php
    // 数字状态码
    // 1 查询用户名
    // 2 插入新用户


    header('Content-type: text/html; charset=utf-8');
    include('./conn_db.php');
    $requestArray = json_decode(file_get_contents("php://input"),true);
    $con = db_connect();
    $selectMethodStatus = $requestArray['selectMethodStatus']; //用数字状态来判别选用该路由的哪个方法
    if(!isset($selectMethodStatus)){
        echo '请求异常';
    }else if($selectMethodStatus == 1){
        $username = $requestArray['username'];
        echo check_username_isExist($username,$con); //当数字状态为1时，标识为使用 检查用户名是否存在 方法,下面依次类推
    }else if($selectMethodStatus == 2){
        $username = $requestArray['username'];
        $password = $requestArray['password'];
        $age = $requestArray['age'];
        $birthday = strstr($requestArray['birthday'], 'T', TRUE);
        $text = $requestArray['text'];
        echo insert_user($con,$username,$password,$age,$birthday,$text);
    }
    mysqli_close($con);

    function check_username_isExist($username,$con){
		$sql = "select * from user where username='$username'";
        $result = mysqli_query($con,$sql);
        
		if(isset($result)){
            if(mysqli_num_rows($result)>0){
                return '用户名已存在';
            }else{
                return 200;
            }
        }else{
			return mysqli_error($con);
        }
	}

	function insert_user($con,$username,$password,$age,$birthday,$text){
        $insert_sql = "insert into user(username,password,age,birthday,description) values('$username','$password','$age','$birthday','$text')";
        $select_sql = "select * from user where username='$username'";
        $insert_result = mysqli_query($con,$insert_sql);
        if($insert_result){
            $select_result = mysqli_query($con,$select_sql);
            if(isset($select_result)){
                session_start();
                $_SESSION['user'] = $username;
                return 200;
            }else{
                return '插入成功，查询失败';
            }
        }else{
            return '插入出错'.$birthday.':'.mysqli_error($con);
        }
	}
?>