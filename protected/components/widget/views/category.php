<div class="widget wcategory">
	<h3 class="blocktitle">CATEGORY</h3>
	<ul class="wl-category">
		<?php
		foreach ($data['category'] as $item) {
			if($item['parent_id'] == 0) {
				continue;
			}
			$static = isset($data['cate_static'][$item['id']]) ? intval($data['cate_static'][$item['id']]) : 0;
			?>
			<li>
				<div class="cc"><?php echo $static ?></div>
				<a href="<?php echo $this->_controller->createUrl('category/index', array('alias' => $item['alias'])) ?>"
				   class="ctitle"><?php echo $item['name'] ?></a>
			</li>
			<?php
		}
		?>
	</ul>
</div>