<!-- Content Header -->
<section class="content-header">
    <h1>权限设置 <small></small></h1>
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
		<?= $this->Form->create($sysRole) ?>
		<div class="box-body">
			<table class="table table-bordered view-t">
		        <tr>
		            <th><?= __('角色名称') ?></th>
		            <td><?= h($sysRole->name) ?></td>
		            <th><?= __('角色代码') ?></th>
		            <td><?= h($sysRole->code) ?></td>
		        </tr>
			</table>
			
			<table class="table table-bordered view-t">
				<caption>为该角色选择可访问的系统菜单：</caption>
				<tr>
					<th>一级菜单</th>
					<td>二级菜单</td>
				</tr>
				<?php foreach($sysMenus as $menu) : ?>
				<tr>
					<th>
						<?php if(in_array($menu->id, $menuIds)) : ?>
						<input type="checkbox" name="menu_ids[]" value="<?= h($menu->id) ?>" 
							id="menu<?= h($menu->id) ?>" checked />
						<?php else: ?>
						<input type="checkbox" name="menu_ids[]" value="<?= h($menu->id) ?>" 
							id="menu<?= h($menu->id) ?>" />	
						<?php endif; ?> 
						<label for="menu<?= h($menu->id) ?>"><?= h($menu->name) ?></label>	
					</th>
					<td>
						<div class="row">
							<?php foreach($menu->children as $sub_menu) : ?>
								<div class="col-md-3">
									<?php if(in_array($sub_menu->id, $menuIds)) : ?>
									<input type="checkbox" name="menu_ids[]" value="<?= h($sub_menu->id) ?>" 
										id="menu<?= h($sub_menu->id) ?>" checked />
									<?php else: ?>
									<input type="checkbox" name="menu_ids[]" value="<?= h($sub_menu->id) ?>" 
										id="menu<?= h($sub_menu->id) ?>" />	
									<?php endif; ?> 
									<label for="menu<?= h($sub_menu->id) ?>" style="font-weight:normal;"><?= h($sub_menu->name) ?></label>
								</div>
							<?php endforeach; ?>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div class="box-footer">
			<?= $this->Form->button(__('提交'), ['class' => 'btn btn-skin']) ?>
			<?= $this->Html->link(__('返回'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
		</div>
		<?= $this->Form->end() ?>
	</div>
</section>
<!-- /Main content -->