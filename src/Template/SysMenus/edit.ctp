<!-- Content Header -->
<section class="content-header">
    <h1>编辑菜单项 - #<?= $sysMenu->id ?> <small></small></h1>
    <ol class="breadcrumb">
    	<li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
    	<li>系统管理</li>
    	<li class="active">菜单管理</li>
    </ol>
</section>
<!-- /Content Header -->

<!-- Main content -->
<section class="content">
	<div class="box">
		<?= $this->Form->create($sysMenu) ?>
		<div class="box-body">
			<div class="row">
				<div class="col-md-3">
        			<div class="form-group">
        				<?php echo $this->Form->control('parent_id', ['label' => '父级菜单', 'options' => $parentSysMenus, 'empty' => true, 'class' => 'form-control']); ?>
        			</div>
        		</div>
				<div class="col-md-3">
					<div class="form-group">
						<?php echo $this->Form->control('name', ['label' => '菜单名称', 'class' => 'form-control']); ?>
        			</div>
        		</div>
        		<div class="col-md-3">
        			<div class="form-group">
        				<?php echo $this->Form->control('controller', ['label' => '控制器', 'class' => 'form-control']); ?>
        			</div>
        		</div>
        		<div class="col-md-3">
        			<div class="form-group">
        				<?php echo $this->Form->control('action', ['label' => '方法', 'class' => 'form-control']); ?>
        			</div>
        		</div>
        		<div class="col-md-3">
        			<div class="form-group">
        				<?php echo $this->Form->control('icon', ['label' => '图标', 'class' => 'form-control']); ?>
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