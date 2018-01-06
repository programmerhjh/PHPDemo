<?php session_start();?>
<!DOCTYPE html>
<html lang='en'>
<?php include('./include/export_script_css.php')?>
<head>
    <meta charset='UTF-8'>
    <title>论坛首页</title>
</head>
<body>
    <div id='app'>
        <el-container>
            <el-header>
                <span>
                    <div>16210121202论坛</div>
                    <div>作者：洪家豪</div>
                </span>
                <div style="color:#909399;padding-left:50px;">用户：<?php echo @$_SESSION['user']; ?>，欢迎你</div>
            </el-header>
            <div style="padding-top:130px;">
                <el-table
                        :data="tableData"
                        border
                        style="width: 100%;">
                    <el-table-column
                        prop="uid"
                        label="uid"
                        width="180">
                    </el-table-column>
                    <el-table-column
                        prop="username"
                        label="姓名"
                        width="180">
                    </el-table-column>
                    <el-table-column
                        prop="password"
                        label="密码">
                    </el-table-column>
                    <el-table-column
                        prop="age"
                        label="年龄">
                    </el-table-column>
                    <el-table-column
                        prop="birthday"
                        label="生日">
                    </el-table-column>
                    <el-table-column
                        prop="description"
                        label="描述">
                    </el-table-column>
                </el-table>
            </div>
        </el-container>
        <br><br>
        <div style="padding-left:650px;">
            <el-button :plain="true" type="primary" @click="logout">注销</el-button>
            <el-button :plain="true" type="primary" @click="update_password">修改密码</el-button>
        </div>
    </div>
</body>
</html>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                tableData: [
                ]
            }
        },
        methods: {
            logout() {
                axios.post('./fns/logout.php',{
                })
                .then(function(res){
                    app.$message({
                        message: '注销成功，2秒后跳转登录页面',
                        type: 'success'
                    });
                    setTimeout(() => {
                        window.location.href = './login.php';
                    }, 2000);
                })
                .catch(function(err){
                    console.log(err);
                });
            },
            update_password() {
                window.location.href = './pwd_update.php';
            }
        }
    });
    window.onload = function(){
        axios.post('./fns/index_data.php',{
        })
        .then(function(res){
            var resStatus = res.data;
            if(resStatus == 403){
                alert('你还未登录');
                window.location.href = './login.php';
            }else if(resStatus == 500){
                alert('服务器故障，请稍后再试');
                window.location.href = './login.php';
            }else{
                var json = eval(resStatus);
                for(var key in json){
                    app.tableData.push(json[key]);
                }
            }
        })
        .catch(function(err){
            console.log(err);
        });
    };
</script>