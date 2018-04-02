<!-- Content Header -->
<section class="content-header">
    <h1>新增用户 <small>新增用户的初始登录密码为abc123</small></h1>
    <ol class="breadcrumb">
    	<li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
    	<li>系统管理</li>
    	<li class="active">用户管理</li>
    </ol>
</section>
<!-- /Content Header -->

<!-- Main content -->
<section class="content">
	<div class="box">
		<?= $this->Form->create($sysUser, ['type' => 'file']) ?>
		<div class="box-body">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<?php echo $this->Form->control('sys_role_id', ['label' => '角色', 'options' => $sysRoles, 
							'class' => 'form-control sel2']); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<?php echo $this->Form->control('account', ['label' => '账号', 'class' => 'form-control']); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<?php echo $this->Form->control('realname', ['label' => '真实姓名', 'class' => 'form-control']); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<?php echo $this->Form->control('phone', ['label' => '手机号', 'class' => 'form-control']); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<div class="form-group">
						<?php echo $this->Form->control('headpic', ['type' => 'file', 'label' => '上传头像', 
							'accept' => 'image/jpeg, image/jpg, image/png', 'class' => 'form-control']); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<?php echo $this->Form->control('status', ['label' => '状态', 'options' => $status, 'class' => 'form-control']); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<?= $this->Form->button(__('提交'), ['class' => 'btn btn-skin']) ?>
			<?= $this->Html->link(__('取消'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
		</div>
		<?= $this->Form->end() ?>
	</div>
</section>
<!-- /Main content -->

<script type="text/javascript">
	$(function() {
		//初始化select2插件
		$(".sel2").select2();
	});
</script>