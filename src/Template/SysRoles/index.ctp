<!-- Content Header -->
<section class="content-header">
    <h1>角色管理 <small></small></h1>
    <ol class="breadcrumb">
    	<li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
    	<li>系统管理</li>
    	<li class="active">角色管理</li>
    </ol>
</section>
<!-- /Content Header -->

<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">角色列表</h3>
			<div class="box-tools">
				<?= $this->Html->link('新增', ['action' => 'add'], ['class' => 'btn btn-skin btn-sm']) ?>
			</div>
		</div>
		<div class="box-body no-padding table-responsive">
			<table class="table table-striped">
		        <tbody>
			        <tr>
						<th><?= $this->Paginator->sort('id', '#') ?></th>
						<th><?= $this->Paginator->sort('name', '角色名称') ?></th>
						<th><?= $this->Paginator->sort('code', '角色代码') ?></th>
						<th><?= $this->Paginator->sort('user_count', '包含用户数') ?></th>
						<th><?= $this->Paginator->sort('status', '状态') ?></th>
						<th class="actions"><?= __('操作') ?></th>		
					</tr>
		        
	            	<?php foreach ($sysRoles as $sysRole): ?>
		            <tr>
		                <td><?= h($sysRole->id) ?></td>
		                <td><?= h($sysRole->name) ?></td>
		                <td><?= h($sysRole->code) ?></td>
		                <td><?= h($sysRole->user_count) ?></td>
		                <td>
		                	<?= $this->element('status', ['status' => $sysRole->status]) ?>
		                </td>
			            <td class="actions">
		                    <?= $this->Html->link(__('详情'), ['action' => 'view', $sysRole->id]) ?>
		                    <?= $this->Html->link(__('编辑'), ['action' => 'edit', $sysRole->id]) ?>
		                    <?= $this->Html->link(__('权限'), ['action' => 'auth', $sysRole->id]) ?>
		                    <?= $this->Form->postLink(__('删除'), ['action' => 'delete', $sysRole->id], ['confirm' => __('确认删除记录 #{0}?', $sysRole->id)]) ?>
		                </td>
	            	</tr>
	            	<?php endforeach; ?>					
		        </tbody>
	    	</table>
		</div>
		<div class="box-footer">
			<?= $this->element('paginator'); ?>
		</div>
	</div>	
</section>
<!-- /Main content -->