<?php
$social_links = get_field('socials', 'options');

if (!empty($social_links)):
	foreach($social_links as $item) :
		?>
		<a href="<?php echo $item['url']; ?>" class="social-links__item">
			<?php echo kesbie_get_svg($item['type']); ?>
		</a>
		<?php
	endforeach;
endif;
