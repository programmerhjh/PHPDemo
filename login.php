<!DOCTYPE html>
<html lang='en'>
<?php include('./include/export_script_css.php')?>
<head>
    <meta charset='UTF-8'>
    <title>论坛登录页</title>
</head>
<body>
    <div id='app'>
        <el-container>
            <el-header>
                <span>
                    <div>16210121202论坛</div>
                    <div>作者：洪家豪</div>
                </span>
            </el-header>
            <div id="login-form">
                <?php include('./include/login_form.php') ?>
            </div>
        </el-container>
    </div>
</body>
</html>
<script>
    const app = new Vue({
        el: '#app',
        data: function () {
            return {
                sizeForm: {
                   name:'',
                   password:''
                },
            }
        },
        methods: {
            onSubmit() {
                axios.post('./fns/login_check.php',{
                    username:this.sizeForm.name,
                    password:this.sizeForm.password
                })
                .then(function(res){
                    console.log(res.data);
                    var resStatus = res.data;
                    if(resStatus == 200){
                        app.$message({
                            message: '登陆成功，3秒后跳转主页',
                            type: 'success'
                        });
                        setTimeout(() => {
                            window.location.href = './index.php';
                        }, 3000);
                    }else if(resStatus == 403){
                        app.$message({
                            message: '用户名或密码错误',
                            type: 'error'
                        });
                    }else{
                        app.$message({
                            message: '服务器故障，请稍后再试',
                            type: 'warning'
                        });
                    }
                })
                .catch(function(err){
                    console.log(err);
                });
            },
            location() {
                window.location.href = './register.php';
            }
        }
    });
    window.onload = function () {
        document.getElementsByTagName('header')[0].removeAttribute('style');
    };
</script>