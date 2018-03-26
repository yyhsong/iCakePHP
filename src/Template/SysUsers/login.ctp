<!DOCTYPE html>

<html>	
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
		<title>用户登录 - 般若项目管理平台</title>
		<?= $this->Html->meta('icon') ?>
	    <?= $this->Html->css([
	    	'pc/bootstrap.min.css', 
	    	'pc/font-awesome.min.css', 
	    	'pc/adminx.min.css', 
	    	'pc/skins/_all-skins.min.css', 
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
			'pc/app.js'
		]);
		?>
	</head>
	
	<body class="hold-transition login-page">
		<div class="login-box">
		    <div class="login-logo">般若项目管理平台</div>
	      	<div class="login-box-body">
	        	<p class="login-box-msg">用户登录</p>
				<?= $this->Form->create() ?>
		          	<div class="form-group has-feedback">
		            	<?= $this->Form->control('account', ['label' => false, 'class' => 'form-control', 'placeholder' => '账号']) ?>
		            	<span class="fa fa-user form-control-feedback"></span>
		          	</div>
		          	<div class="form-group has-feedback">
		            	<?= $this->Form->control('pwt', ['type' => 'password', 'label' => false, 'class' => 'form-control', 'placeholder' => '密码']) ?>
		            	<span class="fa fa-lock form-control-feedback"></span>
		          	</div>
		            <!--<div class="form-group row checkcode-row">
		            	<div class="col-md-6">
		            		<div class="form-group has-feedback">
				            	<input type="text" class="form-control" placeholder="验证码">
				            	<span class="glyphicon glyphicon glyphicon-retweet form-control-feedback"></span>
				          	</div>
		            	</div>
		            	<div class="col-md-3">
		            		<img src="checkcode.jpg" class="img-responsive checkcode-pic" />
		            	</div>
		            	<div class="col-md-3 text-center">
		            		<a href="#"><i class="glyphicon glyphicon-refresh"></i></a>
		            	</div>
		            </div>-->
		            <div class="text-red">
						<!--<?= $this->Flash->render() ?>-->
						<?= isset($loginError) ? $loginError : '' ?>
					</div>
		            <div class="form-btn-group">
		        		<?= $this->Form->button('登录', ['class' => 'btn btn-primary btn-block']) ?>
		        	</div>
	        	<?= $this->Form->end() ?>
	      	</div>
	    </div>
	</body>
</html>