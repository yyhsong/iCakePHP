<!-- Content Header -->
<section class="content-header">
    <h1>用户详情 - #<?= $sysUser->id ?> <small></small></h1>
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
		<div class="box-body">
			<table class="table table-bordered view-t">
		        <tr>
		        	<th>头像</th>
		        	<td>
		        		<?php if($sysUser->headpic) : ?>
							<img src='<?= $this->Url->build('/upload/headpic/'.$sysUser->headpic)?>' class='thumb-img' />
						<?php else : ?>
							<img src='<?= $this->Url->build('/img/user-default.png')?>' class='thumb-img' />
						<?php endif; ?>
		        	</td>
		        	<th><?= __('角色') ?></th>
		            <td>
		            	<?= $sysUser->has('sys_role') ? $this->Html->link($sysUser->sys_role->name, ['controller'=>'SysRoles', 'action'=>'view', $sysUser->sys_role->id]) : '' ?>
		            </td>
		        </tr>
		        <tr>
		        	<th><?= __('账号') ?></th>
		            <td><?= h($sysUser->account) ?></td>
		        	<th><?= __('真实姓名') ?></th>
		            <td><?= h($sysUser->realname) ?></td>
		        </tr>
		        <tr>
		        	<th><?= __('手机号码') ?></th>
		            <td><?= h($sysUser->phone) ?></td>
		            <th><?= __('状态') ?></th>
		            <td>
	                	<?= $this->element('status', ['status' => $sysUser->status]) ?>
	                </td>
		        </tr>
		        <tr>
		            <th><?= __('创建时间') ?></th>
		            <td><?= h($sysUser->created) ?></td>
		            <th><?= __('最后更新') ?></th>
		            <td><?= h($sysUser->modified) ?></td>
		        </tr>
			</table>	
		</div>
		<div class="box-footer">
			<?= $this->Html->link(__('编辑'), ['action' => 'edit', $sysUser->id], ['class' => 'btn btn-skin']) ?>
			<?= $this->Html->link(__('返回'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
		</div>
	</div>
</section>
<!-- /Main content -->