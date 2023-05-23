<?php
add_shortcode('social_links', 'social_links_callback');

function social_links_callback() {
	$social_links = get_field('socials', 'options');
	$content = '';

	ob_start();
	if (!empty($social_links)) { ?>
		<div class="social-links">
			<?php get_template_part('template-parts/social-links'); ?>
		</div>
	<?php
	}
	$content = ob_get_clean();

	return $content;
}
