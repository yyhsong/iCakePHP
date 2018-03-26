<!-- Content Header -->
<section class="content-header">
    <h1>角色详情 - #<?= $sysRole->id ?> <small></small></h1>
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
		<div class="box-body">
			<table class="table table-bordered view-t">
		        <tr>
		            <th><?= __('角色名称') ?></th>
		            <td><?= h($sysRole->name) ?></td>
		            <th><?= __('角色代码') ?></th>
		            <td><?= h($sysRole->code) ?></td>
		        </tr>
		        <tr>
		            <th>包含用户数</th>
		            <td><?= count($sysRole->sys_users) ?></td>
		            <th><?= __('状态') ?></th>
		            <td>
		            	<?= $this->element('status', ['status' => $sysRole->status]); ?>
		            </td>
		        </tr>
		        <tr>
					<th class="vertical-t"><?= __('包含用户') ?></th>
					<td colspan="3">
						<div class="row">
						<?php if($sysRole->code != 'Administrator') : ?>
						<?php foreach($sysRole->sys_users as $key => $user) : ?>
							<div class="col-md-4">
								<p><?= $this->Html->link(($key+1).'. '.$user->realname.' ('.$user->account.')', ['controller'=>'SysUsers', 'action'=>'view', $user->id]) ?></p>
							</div>
						<?php endforeach; ?>
						<?php endif; ?>
						</div>
					</td>
				</tr>
			</table>	
		</div>
		<div class="box-footer">
			<?= $this->Html->link(__('编辑'), ['action' => 'edit', $sysRole->id], ['class' => 'btn btn-skin']) ?>
			<?= $this->Html->link(__('返回'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
		</div>
	</div>
</section>
<!-- /Main content -->