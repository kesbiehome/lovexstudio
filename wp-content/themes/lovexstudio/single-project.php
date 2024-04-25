<?php

get_header();

the_block('project-info');

the_block('project-content');

the_block('other-project');

echo do_shortcode('[contact-form]');

get_footer();