<!-- Content Header -->
<section class="content-header">
    <h1>菜单树形视图 <small></small></h1>
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
		<div class="box-header with-border">
			<h3 class="box-title">树形视图</h3>
			<div class="box-tools">
				<?= $this->Html->link('列表视图', ['action' => 'index'], ['class' => 'btn btn-skin btn-sm']) ?>
			</div>
		</div>
		<div class="box-body">
			<div class="menu-list">
				<?= $this->element('tree', ['nodes' => $sysMenus]) ?>
			</div>
		</div>
		<div class="box-footer">
			<?= $this->Html->link(__('返回'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
		</div>
	</div>	
</section>
<!-- /Main content -->