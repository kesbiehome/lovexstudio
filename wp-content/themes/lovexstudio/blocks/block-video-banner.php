<?php
$title = block_value('title');
$video_thumbnail = block_value('video-thumbnail');
$link_url = block_value('video-url');

get_template_part('template-parts/video-banner', null,[
	'title' => $title,
	'video-thumbnail' => $video_thumbnail,
	'video-url' => $link_url
]);
