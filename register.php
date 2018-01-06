<!DOCTYPE html>
<html lang='en'>
<?php include('./include/export_script_css.php') ?>
<head>
    <meta charset='UTF-8'>
    <title>论坛注册页</title>
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
            <div id="register-form">
				<?php include('./include/register_form.php') ?>
            </div>
        </el-container>
    </div>
</body>
</html>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            var validateUsername = (rule, value, callback) => {
                if(value === ''){
                    callback(new Error('请输入用户名'));
                } else {
                    //验证数据库是否存在重复用户名
                    axios.post('./fns/register_check.php',{
                        selectMethodStatus:1, //用数字状态来判别选用该路由的哪个方法
                        username:value
                    })
                    .then(function(res){
                        var status = res.data;
                        console.log(status);
                        if(status != 200){
                            callback(new Error(status));
                        }
                        callback();
                    })
                    .catch(function(err){
                        console.log(err);
                    });
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
                    name:'',
                    password:'',
                    checkPassword:'',
                    age:'',
                    birthday:'',
                    text:''
                },
                rules: {
                    name: [
                        { validator: validateUsername, trigger: 'blur' },
                        { min:2 , max:20,message: '用户名长度有误' , trigger: 'blur'}
                    ],
                    password: [
                        { validator: validatePassword, trigger: 'blur' },
                        { min:8 , max:16,message: '密码长度有误' , trigger: 'blur'}
                    ],
                    checkPassword: [
                        { validator: validateAgainPassword, trigger: 'blur' }
                    ],
                    age: [
                        { required: false, message: '请输入年龄', trigger: 'change' }
                    ],
                    birthday: [
                        { type: 'date', required: false, message: '请选择时间', trigger: 'change' }
                    ],
                    text: [
                        { required: false, message: '填写自我介绍', trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            onSubmit(formName) {
                app.$refs[formName].validate((valid) => {
                    if (valid) {
                        // 前台验证通过
                        axios.post('./fns/register_check.php',{
                            selectMethodStatus:2,
                            username:this.sizeForm.name,
                            password:this.sizeForm.password,
                            age:this.sizeForm.age,
                            birthday:this.sizeForm.birthday,
                            text:this.sizeForm.text
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
                                    message: '注册成功,2秒后跳往首页',
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
                        console.log('信息填写有误');
                        return false;
                    }
                });
            }
        }
    });
    window.onload = function () {
        document.getElementsByTagName('header')[0].removeAttribute('style')
    };
</script>