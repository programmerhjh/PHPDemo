<?php
    header('Content-type: text/html; charset=utf-8');
    include('./conn_db.php');
    $requestArray = json_decode(file_get_contents("php://input"),true);
    $con = db_connect();
    $username = $requestArray['username'];
    $password = $requestArray['password'];
    echo login_main($username,$password,$con);

    function login_main($username,$password,$con){
		if(isset($username) && isset($password)){
            $sql = "select * from user where username='$username' and password='$password'";
			$result = mysqli_query($con,$sql);
			if(isset($result)){
                if(mysqli_num_rows($result) > 0){
                    session_start();  //开启session
                    $_SESSION['user'] = $username;  // 把username存在$_SESSION['user'] 里面
                    return '200'; 
                }else{
                    return '403';
                }
			}else{
				return '500';
			}
		}
        mysql_close($con);
    }
?>
