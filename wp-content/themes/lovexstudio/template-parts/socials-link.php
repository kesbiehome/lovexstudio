<?php
$socials_link = get_field('socials', 'options');

if (!empty($socials)):
	foreach($socials as $item) :
		?>
		<?php
	endforeach;
endif;
