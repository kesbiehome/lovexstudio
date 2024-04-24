<div class="hero-banner" style="width:100%;">
<?php
get_template_part('template-parts/video-banner', null,[
	'title' => $title,
	'video-thumbnail' => $video_thumbnail,
	'video-url' => $video_url ?? ''
]);
?>
</div>
