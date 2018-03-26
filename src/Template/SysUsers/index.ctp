<!-- Content Header -->
<section class="content-header">
    <h1>用户管理 <small></small></h1>
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
		<div class="box-header">
			<h3 class="box-title">用户列表</h3>
			<div class="box-tools">
				<?= $this->Html->link('新增', ['action' => 'add'], ['class' => 'btn btn-skin btn-sm']) ?>
			</div>
		</div>
		<div class="box-body no-padding table-responsive">
			<!--<?= $this->Form->create(null, ['novalidate' => 'novalidate', 'class' => 'hidden-xs hidden-sm']); ?>
			<table class="table table-search">
				<tr>
					<td class="left">Name</td>
					<td>
						<?= $this->Form->control('name', ['label' => false, 'class' => 'form-control']); ?>
					</td>
					<td class="right">
						<?= $this->Form->button(__('查询'), ['class' => 'btn btn-skin btn-sm']); ?>
					</td>
				</tr>
			</table>
			<?= $this->Form->end(); ?>-->
				
			<table class="table table-striped">
		        <tbody>
			        <tr>
						<th><?= $this->Paginator->sort('id', '#') ?></th>
						<th><?= $this->Paginator->sort('sys_role_id', '角色') ?></th>
						<th><?= $this->Paginator->sort('account', '账号') ?></th>
						<th><?= $this->Paginator->sort('realname', '真实姓名') ?></th>
						<th><?= $this->Paginator->sort('phone', '手机号') ?></th>
						<th><?= $this->Paginator->sort('status', '状态') ?></th>
						<th><?= $this->Paginator->sort('modified', '最后更新') ?></th>
						<th class="actions"><?= __('操作') ?></th>		
					</tr>
		        
	            	<?php foreach ($sysUsers as $sysUser): ?>
		            <tr>
		                <td><?= h($sysUser->id) ?></td>
		                <td><?= $sysUser->has('sys_role') ? $sysUser->sys_role->name : '' ?></td>
		                <td><?= h($sysUser->account) ?></td>
		                <td><?= h($sysUser->realname) ?></td>
		                <td><?= h($sysUser->phone) ?></td>
		                <td>
		                	<?= $this->element('status', ['status' => $sysUser->status]) ?>
		                </td>
		                <td><?= h($sysUser->modified) ?></td>
			            <td class="actions">
		                    <?= $this->Html->link(__('详情'), ['action' => 'view', $sysUser->id]) ?>
		                    <?= $this->Html->link(__('编辑'), ['action' => 'edit', $sysUser->id]) ?>
		                    <a href="#" class="resetPwt" data-id="<?= h($sysUser->id) ?>">重置密码</a>
		                    <!--<?= $this->Form->postLink(__('删除'), ['action' => 'delete', $sysUser->id], ['confirm' => __('确认删除记录 #{0}?', $sysUser->id)]) ?>-->
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

<script type="text/javascript">
	$(function() {
		//重置密码
		$(".resetPwt").on("click", function(e) {
			e.preventDefault();
			
			var userId = $(this).data("id");
			if(window.confirm("确认重置用户 #"+userId+" 的登录密码？")) {
				$.ajax({
					type: "POST",
					url: "<?= $this->Url->build(['controller'=>'SysUsers', 'action'=>'resetPwt']) ?>",
					data: {"user_id":userId},
					dataType: 'json',
					success: function(data) {
						if(data.status == "success") {
							$(".flash-div").empty().append('<div class="message success" onclick="this.classList.add(\'hidden\')">'+data.msg+'</div>');
						}else {
							$(".flash-div").empty().append('<div class="message error" onclick="this.classList.add(\'hidden\')">'+data.msg+'</div>');
						}
					}
				});
			}
		});
	});
</script>