<!-- 遍历树形结构，以list形式展示 -->
<?php
	toList($nodes);
	//递归
	function toList($nodes) {
		echo '<ul>';
		foreach($nodes as $node) {
			$item = "<li><a href='#'>";
			$item .= "<i class='{$node->icon}'></i> ";
			$item .= "<span>{$node->name}</span>";
			$item .= "</a></li>";
			echo $item;
			if(!empty($node->children)) {
				toList($node->children);
			}
		}
		echo '</ul>';
	}
?>