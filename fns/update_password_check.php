<?php
    header('Content-type: text/html; charset=utf-8');
    session_start();
    include('./conn_db.php');
    $con = db_connect();
    if(!isset($_SESSION['user'])){
        echo 403;
        return;
    }
    $requestArray = json_decode(file_get_contents("php://input"),true);
    $username = $_SESSION['user'];
    $password = $requestArray['password'];
    $newPassword = $requestArray['newPassword'];
    echo check_update_password($con,$username,$password,$newPassword);
    mysqli_close($con);

    function check_update_password($con,$username,$password,$newPassword){
        $sql = "select * from user where username='$username' and password='$password'";
        $result = mysqli_query($con,$sql);
        if(isset($result)){
            if(mysqli_num_rows($result) > 0){
                $updatePassword_sql = "update user set password='$newPassword' where username='$username'";
                $updateResult = mysqli_query($con,$updatePassword_sql);
                if($updateResult){
                    return 200;
                }else{
                    return '语句出错，修改失败';
                }
            }else{
                return '密码错误';
            }
        }else{
            return '服务器异常，请稍后再试';
        }
    }
    
?>
