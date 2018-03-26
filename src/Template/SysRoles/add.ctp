<!-- Content Header -->
<section class="content-header">
    <h1>新增角色 <small></small></h1>
    <ol class="breadcrumb">
    	<li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
    	<li>系统管理</li>
    	<li class="active">角色管理</li>
    </ol>
</section>
<!-- /Content Header -->

<!-- Main Content -->
<section class="content">
	<div class="box">
		<?= $this->Form->create($sysRole) ?>
		<div class="box-body">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<?php echo $this->Form->control('name', ['label' => '角色名称', 'class' => 'form-control']); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<?php echo $this->Form->control('code', ['label' => '角色代码', 'class' => 'form-control']); ?>
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
<!-- /Main Content -->