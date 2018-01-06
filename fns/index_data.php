<?php
    header('Content-type: text/html; charset=utf-8');
    session_start();
    include('./conn_db.php');
    $con = db_connect();
    if(!isset($_SESSION['user'])){
        echo 403;
    }else{
        echo index($con);
    }
    
    function index($con){
        $sql = "select * from user";
        $result = mysqli_query($con,$sql);
        if(isset($result)){
            $jarr = array();
            while ($rows=mysqli_fetch_array($result,MYSQL_ASSOC)){
                $count=count($rows);//不能在循环语句中，由于每次删除 row数组长度都减小  
                for($i=0;$i<$count;$i++){  
                    unset($rows[$i]);//删除冗余数据
                }
                array_push($jarr,$rows);
            }
            $jobj=new stdclass();
            foreach($jarr as $key=>$value){
                $jobj->$key=$value;
            }
            return json_encode($jobj,JSON_UNESCAPED_UNICODE);
        }else{
            return 500;
        }
    }
    mysqli_close($con);
?>
