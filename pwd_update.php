<!DOCTYPE html>
<html lang='en'>
<?php include('./include/export_script_css.php')?>
<head>
    <meta charset='UTF-8'>
    <title>修改密码页面</title>
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
            <div style="padding-top:100px;width:600px;padding-left:500px;">
                <?php include('./include/update_password_form.php')?>
            </div>
        </el-container>
        <br><br>
        <div style="padding-left:750px;">
            <el-button :plain="true" type="primary" @click="return_index" >返回主页</el-button>
        </div>
    </div>
</body>
</html>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            var validateNewPassword = (rule, value, callback) => {
                if(value === ''){
                    callback(new Error('请输入密码'));
                } else {
                    callback();
                }
            };
            //vue.js检测密码
            var validatePassword = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                } else {
                    if (this.sizeForm.checkPassword !== '') {
                        app.$refs.sizeForm.validateField('checkPassword');
                    }
                    callback();
                }
            };
            //再次检查密码
            var validateAgainPassword = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入密码'));
                } else if (value !== this.sizeForm.password) {
                    callback(new Error('两次输入密码不一致!'));
                }
                callback();
            };
            return {
                sizeForm: {
                    newPassword:'',
                    password:'',
                    checkPassword:''
                },
                rules: {
                    newPassword: [
                        { validator: validateNewPassword, trigger: 'blur' },
                        { min:8 , max:16,message: '密码长度有误' , trigger: 'blur'}
                    ],
                    password: [
                        { validator: validatePassword, trigger: 'blur' },
                    ],
                    checkPassword: [
                        { validator: validateAgainPassword, trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            onSubmit(formName) {
                app.$refs[formName].validate((valid) => {
                    if (valid) {
                        // 前台验证通过
                        axios.post('./fns/update_password_check.php',{
                            password:this.sizeForm.password,
                            newPassword:this.sizeForm.newPassword
                        })
                        .then(function(res){
                            console.log(res.data);
                            var status = res.data;
                            if(status != 200){
                                app.$message({
                                    message: status,
                                    type: 'error'
                                });
                            }else{
                                app.$message({
                                    message: '修改成功,2秒后跳往首页',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = './index.php'
                                }, 2000);
                            }
                        })
                        .catch(function(err){
                            console.log(err);
                        });
                    } else {
                        console.log('前台验证不通过');
                        return false;
                    }
                });
            },
            return_index() {
                window.location.href = './index.php';
            }
        }
    });
    window.onload = function () {
        document.getElementsByTagName('header')[0].removeAttribute('style');
        axios.post('./fns/update_password_check.php',{
        })
        .then(function(res){
            var resStatus = res.data;
            if(resStatus == 403){
                alert('你还未登录');
                window.location.href = './login.php';
            }
        })
        .catch(function(err){
            console.log(err);
            alert('服务器故障，请稍后再试');
            window.location.href = './login.php';
        });
    };
</script>