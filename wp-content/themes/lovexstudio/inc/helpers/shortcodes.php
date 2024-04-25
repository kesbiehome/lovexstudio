<?php
add_shortcode('social_links', 'social_links_callback');

function social_links_callback()
{
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


add_shortcode('contact-form', 'contact_form_section_callback');
function contact_form_section_callback()
{
	$image = get_field('form_image', 'options');

	ob_start();
	the_block('contact-form', [
		'image' => $image,
	]);
	$content = ob_get_clean();

	return $content;
}

add_shortcode('cta-section', 'cta_section_callback');

function cta_section_callback()
{

	$image = get_field('cta_image', 'options');

	ob_start();
	the_block('cta', [
		'image' => $image,
	]);
	$content = ob_get_clean();
	return $content;
}
