<el-card class="box-card">
    <div slot="header" class="clearfix">
        <div style="text-align:center;">论坛登录</div>
    </div>
    <el-form action="index.html" :model="sizeForm" label-width="80px" size="mini">
        <el-form-item label="用户名" size="large" style="padding-right:20px;">
            <el-input v-model="sizeForm.name"></el-input>
        </el-form-item>
        <el-form-item label="密码" size="large" style="padding-right:20px;">
            <el-input v-model="sizeForm.password" type="password"></el-input>
        </el-form-item>
        <el-form-item size="large" style="padding-left:65px;">
            <el-button :plain="true" type="primary" @click="onSubmit">登录</el-button>
            <el-button type="info" @click="location">注册</el-button>
        </el-form-item>
    </el-form>
</el-card>
