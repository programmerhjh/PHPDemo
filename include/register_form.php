<el-card class="box-card">
    <div slot="header" class="clearfix">
        <div style="text-align:center;">论坛注册</div>
    </div>
    <el-form status-icon :rules="rules" ref="sizeForm" :model="sizeForm" label-width="150px" size="large">
        <el-form-item label="用户名" size="large" style="padding-right:100px;" prop="name">
            <el-input v-model="sizeForm.name"></el-input>
        </el-form-item>
        <el-form-item label="密码" size="large" style="padding-right:100px;" prop="password">
            <el-input v-model="sizeForm.password" type="password"></el-input>
        </el-form-item>
        <el-form-item label="再次确认密码" size="large" style="padding-right:100px;" prop="checkPassword">
            <el-input type="password" v-model="sizeForm.checkPassword"></el-input>
        </el-form-item>
        <el-form-item label="年龄" size="large" style="padding-right:100px;" prop="age">
            <el-input v-model="sizeForm.age" type="text"></el-input>
        </el-form-item>
        <el-form-item label="生日" size="large" style="padding-right:100px;" prop="birthday">
            <el-date-picker
                v-model="sizeForm.birthday"
                type="date"
                placeholder="选择日期"
                default-value="1970-01-01">
            </el-date-picker>
        </el-form-item>
        <el-form-item label="自我描述" size="large" style="padding-right:100px;" prop="text">
            <el-input v-model="sizeForm.text" resize="none" type="textarea"></el-input>
        </el-form-item>
        <el-form-item size="large" style="padding-left:110px;">
            <el-button :plain="true" type="primary" @click="onSubmit('sizeForm')">注册</el-button>
            <el-button native-type="reset">重置</el-button>
        </el-form-item>
    </el-form>
</el-card>
