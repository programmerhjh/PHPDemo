<el-card class="box-card">
    <div slot="header" class="clearfix">
        <div style="text-align:center;">修改密码</div>
    </div>
    <el-form status-icon :rules="rules" ref="sizeForm" :model="sizeForm" label-width="150px" size="large">
        <el-form-item label="新密码" size="large" style="padding-right:100px;" prop="newPassword">
            <el-input v-model="sizeForm.newPassword" type="password"></el-input>
        </el-form-item>
        <el-form-item label="密码" size="large" style="padding-right:100px;" prop="password">
            <el-input v-model="sizeForm.password" type="password"></el-input>
        </el-form-item>
        <el-form-item label="再次确认密码" size="large" style="padding-right:100px;" prop="checkPassword">
            <el-input type="password" v-model="sizeForm.checkPassword"></el-input>
        </el-form-item>
        <el-form-item size="large" style="padding-left:50px;">
            <el-button type="primary" @click="onSubmit('sizeForm')">修改</el-button>
            <el-button native-type="reset">重置</el-button>
        </el-form-item>
    </el-form>
</el-card>
