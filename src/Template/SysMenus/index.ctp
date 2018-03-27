<!-- Content Header -->
<section class="content-header">
    <h1>菜单管理 <small></small></h1>
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
		<div class="box-header">
			<h3 class="box-title">菜单项列表</h3>
			<div class="box-tools">
				<?= $this->Html->link('树形视图', ['action' => 'tree'], ['class' => 'btn btn-skin btn-sm']) ?>
				<?= $this->Html->link('新增菜单项', ['action' => 'add'], ['class' => 'btn btn-skin btn-sm']) ?>
			</div>
		</div>
		<div class="box-body no-padding table-responsive">
			<table class="table table-striped">
		        <tbody>
			        <tr>
						<th><?= $this->Paginator->sort('id', '#') ?></th>
						<th><?= $this->Paginator->sort('parent_id', '父级菜单') ?></th>
						<th><?= $this->Paginator->sort('name', '菜单名称') ?></th>
						<th><?= $this->Paginator->sort('controller', '控制器') ?></th>
						<th><?= $this->Paginator->sort('action', '方法') ?></th>
						<th><?= $this->Paginator->sort('icon', '图标') ?></th>
						<th class="actions"><?= __('操作') ?></th>		
					</tr>
	            	<?php foreach ($sysMenus as $sysMenu): ?>
		            <tr>
		                <td><?= h($sysMenu->id) ?></td>
		                <td><?= $sysMenu->has('parent_sys_menu') ? $sysMenu->parent_sys_menu->name : '-' ?></td>
		                <td><?= h($sysMenu->name) ?></td>
		                <td><?= h($sysMenu->controller ? $sysMenu->controller : '-') ?></td>
		                <td><?= h($sysMenu->action ? $sysMenu->action : '-') ?></td>
		                <td><i class="<?= h($sysMenu->icon) ?>"></i> <?= h($sysMenu->icon) ?></td>
			            <td class="actions">
		                    <?= $this->Html->link(__('详情'), ['action' => 'view', $sysMenu->id]) ?>
		                    <?= $this->Html->link(__('编辑'), ['action' => 'edit', $sysMenu->id]) ?>
		                    <?= $this->Html->link(__('上移'), ['action' => 'moveUp', $sysMenu->id]) ?>
		                    <?= $this->Html->link(__('下移'), ['action' => 'moveDown', $sysMenu->id]) ?>
		                    <?= $this->Form->postLink(__('删除'), ['action' => 'delete', $sysMenu->id], ['confirm' => __('确认删除该菜单项 #{0}?', $sysMenu->id)]) ?>
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