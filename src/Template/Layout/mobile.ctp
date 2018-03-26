<!DOCTYPE html>

<html>
	<head>
	    <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	    <title>微信端</title>
	    <?= $this->Html->meta('icon') ?>
	    <?= $this->Html->css(['mobile/weui.min.css', 'mobile/mapp.css']) ?>
	    <?= $this->Html->script(['mobile/jquery-3.2.1.min.js', 'mobile/weui.min.js', 'mobile/mapp.js', 'http://res.wx.qq.com/open/js/jweixin-1.2.0.js']) ?>
	</head>

	<body ontouchstart>
		<div class="weui-toptips">
			<?= $this->Flash->render() ?>
		</div>
		
		<div class="container">
			<?= $this->fetch('content') ?>
		</div>
	</body>
</html>