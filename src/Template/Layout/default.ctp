<!DOCTYPE html>

<html>
	<head>
	    <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	    <title>CakePHP种子项目</title>
	    <?= $this->Html->meta('icon') ?>
	    <?= $this->Html->css([
	    	'pc/bootstrap.min.css', 
	    	'pc/font-awesome.min.css', 
	    	'pc/adminx.min.css', 
	    	'pc/skins/_all-skins.min.css', 
	    	'pc/plugins/datepicker.min.css', 
	    	'pc/plugins/clockpicker.min.css', 
	    	'pc/plugins/select2.min.css', 
	    	'pc/app.css']); 
	    ?>
		<!--[if lt IE 9]>
	        <?= $this->Html->script(['html5shiv.min.js', 'respond.min.js']) ?>
	    <![endif]-->
		<?= $this->Html->script([
			'pc/jquery-1.11.3.min.js', 
			'pc/bootstrap-3.3.5.min.js', 
			'pc/adminx.min.js', 
			'pc/plugins/slimscroll.min.js', 
			'pc/plugins/datepicker.min.js', 
			'pc/plugins/clockpicker.min.js', 
			'pc/plugins/select2.min.js',
			'pc/plugins/print.min.js',
			'pc/app.js'
		]);
		?>
	</head>

	<body class="hold-transition sidebar-mini skin-blue-light fixed">
		<!-- Wrapper -->
		<div class="wrapper">
			<!-- Main Header -->
			<header class="main-header">
				<!-- Logo -->
				<a class="logo hidden-xs hidden-sm">
					<span class="logo-mini">
						<?php echo $this->Html->image('logo-mini.png') ?>
					</span>
					<span class="logo-lg">
						<?php echo $this->Html->image('logo.png') ?>
					</span>
				</a>
				<!-- /Logo -->
				
				<!-- Header Navbar -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
		            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		                <span class="sr-only">切换导航栏</span>
		          	</a>
		          	<!-- /Sidebar toggle button-->
		          	
		          	<!-- Navbar Right Menu -->
          			<div class="navbar-custom-menu">
			            <ul class="nav navbar-nav">
			                <li class="dropdown user user-menu">
				                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				                    <?php
				                    	if($this->request->session()->read('User')['headpic']) {
				                    		echo $this->Html->image('/upload/headpic/'.$this->request->session()->read('User')['headpic'], ['alt'=>'', 'class'=>'user-image']);
				                    	}else {
				                    		echo $this->Html->image('user.png', ['alt'=>'', 'class'=>'user-image']);
				                    	}
				                    ?>
				                    <span class="hidden-xs"><?= h($this->request->session()->read('User')['account']) ?></span>
				                </a>
				                <ul class="dropdown-menu">
				                    <li class="user-header">
				                    	<?php
					                    	if($this->request->session()->read('User')['headpic']) {
					                    		echo $this->Html->image('/upload/headpic/'.$this->request->session()->read('User')['headpic'], ['alt'=>'', 'class'=>'user-circle']);
					                    	}else {
					                    		echo $this->Html->image('user.png', ['alt'=>'', 'class'=>'user-circle']);
					                    	}
					                    ?>
					                    <p>
					                        <?= h($this->request->session()->read('User')['realname']) ?>
					                        <small><?= h($this->request->session()->read('User')['rolename']) ?></small>
					                    </p>
				                    </li>
					                <li class="user-footer">
					                    <div class="pull-left">
					                        <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#pwtModal">修改密码</a>
					                    </div>
					                    <div class="pull-right">
					                    	<?= $this->Html->link('退出', ['controller'=>'SysUsers', 'action'=>'logout'], ['class'=>'btn btn-default btn-flat']) ?>
					                    </div>
				                    </li>
				                </ul>
			                </li>
			                <li class="hidden-xs hidden-sm">
			                	<a href="#" data-toggle="control-sidebar" id="ctrlLink"><i class="fa fa-gears"></i></a>
			                </li>
			            </ul>
          			</div>
          			<!-- /Navbar Right Menu -->
				</nav>
				<!-- /Header Navbar -->
			</header>
			<!-- /Main Header -->
			
			<!-- Main Sidebar -->
			<?php $rolecode = $this->request->session()->read('User')['rolecode']; ?>
			<?php $menus = $this->request->session()->read('Menus'); ?>
			<aside class="main-sidebar">
				<div class="sidebar">
				    <ul class="sidebar-menu">
						<li class="treeview" data-ctrl="Homes" data-hash="Homes-dashboard">
							<a href="<?= $this->Url->build(['controller'=>'Homes', 'action'=>'dashboard']) ?>">
								<i class="fa fa-dashboard"></i>
								<span>控制面板</span>
							</a>
						</li>
						
						<!-- 一级菜单 -->
						<?php if(!empty($menus)) : ?>
						<?php foreach($menus as $menu) : ?>
						<li class="treeview">
					        <a href="#">
					        	<i class="<?= h($menu->icon) ?>"></i>
					        	<span><?= h($menu->name) ?></span> 
					        	<i class="fa fa-angle-left pull-right"></i>
					        </a>
					        
					        <!-- 二级菜单 -->
					        <?php if(!empty($menu->children)) : ?>
					        <ul class="treeview-menu">
					        <?php foreach($menu->children as $sub_menu) : ?>
					        	<!-- 三级菜单 -->
					        	<?php if(!empty($sub_menu->child_sys_menus)) : ?>
					        	<li data-ctrl="#" data-hash="#">
					        		<a href="#">
					        			<i class="<?= $sub_menu->icon ?>"></i>
					        			<span><?= $sub_menu->name ?></span> 
					        			<i class="fa fa-angle-left pull-right"></i>
					        		</a>
					        		<ul class="treeview-menu" style="display:none;">
							        <?php foreach($sub_menu->child_sys_menus as $sub) : ?>
							        	<li  data-level="<?= $sub->level ?>" data-ctrl="<?= $sub->controller ?>" data-hash="<?= $sub->controller.'-'.$sub->action ?>">
							        		<a href="<?= $this->Url->build(['controller' => $sub->controller, 'action' => $sub->action]) ?>">
							        			<?= $sub->name ?>
							        		</a>
							        	</li>
							        <?php endforeach; ?>
							        </ul>
					        	</li>
					        	<?php else : ?>
					        	<li data-ctrl="<?= $sub_menu->controller ?>" data-hash="<?= $sub_menu->controller.'-'.$sub_menu->action ?>">
					        		<a href="<?= $this->Url->build(['controller' => $sub_menu->controller, 'action' => $sub_menu->action]) ?>">
					        			<i class="<?= $sub_menu->icon ?>"></i><?= $sub_menu->name ?>
					        		</a>
					        	</li>
					        	<?php endif; ?>
					        <?php endforeach; ?>
					        </ul>
					        <?php endif; ?>
					    </li>
					    <?php endforeach; ?>
					    <?php endif; ?>
				    </ul>		
				</div>
			</aside>
			<!-- /Main Sidebar -->
			
			<!-- Content Wrapper -->
			<div class="content-wrapper">
				<div class="flash-div">
					<?= $this->Flash->render() ?>
				</div>
				<?= $this->fetch('content') ?>
			</div>
			<!-- /Content Wrapper -->
			
			<!-- Main Footer -->
      		<footer class="main-footer">
		        <div class="pull-right hidden-xs">
		          	版本 V0.0
		        </div>
		        Copyright &copy; 2018 <a href="#">般若</a> 版权所有
      		</footer>
      		<!-- /Main Footer -->
      		
      		<!-- Control Sidebar -->
      		<aside class="control-sidebar control-sidebar-dark hidden-xs hidden-sm">
      			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          			<li class="active">
          				<a href="#control-sidebar-skin-tab" data-toggle="tab">
          					<i class="fa fa-yelp"></i> 换肤
          				</a>
          			</li>
          			<li>
          				<a href="#control-sidebar-layout-tab" data-toggle="tab">
          					<i class="fa fa-delicious"></i> 布局
          				</a>
          			</li>
        		</ul>
        		<div class="tab-content">
        			<div class="tab-pane active" id="control-sidebar-skin-tab">
        				<div class="row skin-links" id="skinLinks">
        					<div class="col-md-4">
        						<a href="#" data-skin="skin-blue-light" class="skin-link skin-link-blue active"></a>
        					</div>
        					<div class="col-md-4">
        						<a href="#" data-skin="skin-red-light" class="skin-link skin-link-red"></a>
        					</div>
        					<div class="col-md-4">
        						<a href="#" data-skin="skin-green-light" class="skin-link skin-link-green"></a>
        					</div>
        					<div class="col-md-4">
        						<a href="#" data-skin="skin-yellow-light" class="skin-link skin-link-yellow"></a>
        					</div>
        					<div class="col-md-4">
        						<a href="#" data-skin="skin-purple-light" class="skin-link skin-link-purple"></a>
        					</div>
        				</div>
        			</div>
        			<div class="tab-pane" id="control-sidebar-layout-tab"></div>
        		</div>
      		</aside>
			<div class="control-sidebar-bg"></div>
			<!-- /Control Sidebar -->
		</div>
		<!-- /Wrapper -->
		
		<!-- 修改密码 -->
		<div class="modal fade" tabindex="-1" role="dialog" id="pwtModal">
		    <div class="modal-dialog" role="document">
		    	<div class="modal-content">
			        <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title">修改密码</h4>
			        </div>
			        <div class="modal-body">
			        	<div class="form-group">
			        		<label>原密码</label>
			        		<input type="password" class="form-control" id="originPwt" />
			        	</div>
			        	<div class="form-group">
			        		<label>新密码</label>
			        		<input type="password" class="form-control" id="newPwt" />
			        	</div>
			        	<div class="form-group">
			        		<label>确认新密码</label>
			        		<input type="password" class="form-control" id="confirmPwt" />
			        	</div>
			        	<p class="form-error"></p>
			        </div>
			        <div class="modal-footer">
			        	<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			        	<button type="button" class="btn btn-skin" id="pwtBtn">保存</button>
			        </div>
		    	</div>
		    </div>
		</div>
		<!-- /修改密码 -->
		
		<script type="text/javascript">
			$(function() {
				//设置选中菜单
				var ctrl = "<?= $ctrl ?>";
				var hash = "<?= $hash ?>";
				$(".sidebar-menu .active").removeClass("active");
				if($("[data-ctrl='"+ctrl+"']").length == 1) {
					$("[data-ctrl='"+ctrl+"']").addClass("active").parents(".treeview").addClass("active");
				}else {
					if($("[data-hash='"+hash+"']").length == 1) {
						$("[data-hash='"+hash+"']").addClass("active").parents(".treeview").addClass("active");
						//如果是三级菜单
						if($("[data-hash='"+hash+"']").data("level") == 3) {
							$("[data-hash='"+hash+"']").parents(".treeview-menu").addClass("menu-open active").show();
						}
					}else {
						var url_hash = window.location.hash.split("#")[1];
						$("[data-hash='"+url_hash+"']").addClass("active").parents(".treeview").addClass("active");
					}
				}
				
				//修改密码
				$("#pwtModal").on("show.bs.modal", function() {
					$("#pwtModal input").val("");
				});
				$("#pwtBtn").on("click", function(e) {
					e.preventDefault();
					
					var origin_pwt = $("#originPwt").val().trim(),
						new_pwt = $("#newPwt").val().trim(),
						confirm_pwt = $("#confirmPwt").val().trim(),
						$pwt_error = $(".form-error");
					if(!origin_pwt) {
						$pwt_error.html("请输入原密码！");
						return;
					}
					if(!new_pwt) {
						$pwt_error.html("请输入新密码！");
						return;
					}
					if(!confirm_pwt) {
						$pwt_error.html("请输入确认密码！");
						return;
					}
					if(new_pwt != confirm_pwt) {
						$pwt_error.html("两次密码输入不一致！");
						return;
					}
					$.ajax({
						type: "POST",
						url: "<?= $this->Url->build(['controller'=>'SysUsers', 'action'=>'changePwt']) ?>",
						data: {"user_id":"<?= h($this->request->session()->read('User')['id']) ?>", "origin_pwt":origin_pwt, "new_pwt":new_pwt},
						dataType: 'json',
						success: function(data) {
							if(data.status == "success") {
								$("#pwtModal").modal("hide");
								$(".flash-div").empty().append('<div class="message success" onclick="this.classList.add(\'hidden\')">'+data.msg+'</div>');
							}else {
								$(".form-error").html(data.msg);
							}
						}
					});
				});
			});
		</script>
	</body>
</html>
