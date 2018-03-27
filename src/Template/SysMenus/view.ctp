<!-- Content Header -->
<section class="content-header">
    <h1>菜单项详情  - #<?= $sysMenu->id ?> <small></small></h1>
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
		<div class="box-body">
			<table class="table table-bordered view-t">
		        <tr>
		        	<th><?= __('父级菜单') ?></th>
		            <td><?= $sysMenu->has('parent_sys_menu') ? $this->Html->link($sysMenu->parent_sys_menu->name, ['controller' => 'SysMenus', 'action' => 'view', $sysMenu->parent_sys_menu->id]) : '-' ?></td>
		            <th><?= __('菜单名称') ?></th>
		            <td><?= h($sysMenu->name) ?></td>
		        </tr>
		        <tr>
		            <th><?= __('控制器') ?></th>
		            <td><?= h($sysMenu->controller ? $sysMenu->controller : '-') ?></td>
		            <th><?= __('方法') ?></th>
		            <td><?= h($sysMenu->action ? $sysMenu->action : '-') ?></td>
		        </tr>
		        <tr>
		            <th><?= __('图标') ?></th>
		            <td>
		            	<i class="<?= h($sysMenu->icon) ?>"></i>
		            	<?= h($sysMenu->icon) ?>	
		           </td>
		           <th>Level</th>
		           <td><?= $this->Number->format($sysMenu->level) ?></td>
		        </tr>
		        <tr>
		            <th><?= __('Left') ?></th>
		            <td><?= $this->Number->format($sysMenu->lft) ?></td>
		            <th><?= __('Right') ?></th>
		            <td><?= $this->Number->format($sysMenu->rght) ?></td>
		        </tr>
			</table>	
		</div>
		<div class="box-footer">
			<?= $this->Html->link(__('编辑'), ['action' => 'edit', $sysMenu->id], ['class' => 'btn btn-skin']) ?>
			<?= $this->Html->link(__('返回'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
		</div>
	</div>
</section>
<!-- /Main content -->