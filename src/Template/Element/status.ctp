<?php 
	if($status === 1) {
		echo '<span class="text-green">启用</span>';
	}else if($status === 2) {
		echo '<span class="text-red">禁用</span>';
	}else {
		echo '<span class="text-gray">未知</span>';
	}
?>