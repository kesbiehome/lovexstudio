<?php
$data = wp_parse_args($args, [
	'title' => '',
	'video-thumbnail' => '',
	'video-url' => ''
]);

$youtube = !empty($data['video-url']) ? $data['video-url'] : '';
$image_video = !empty($data['video-thumbnail']) ? $data['video-thumbnail'] : '';
$embed_video = !empty($youtube) ? getYoutubeEmbedUrl($youtube) : '';

if (!empty($embed_video) && empty($image_video)) {
	preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $embed_video, $match);
	$image_video = !empty($match) ? 'https://i.ytimg.com/vi/' . $match[1] . '/maxresdefault.jpg' : '';
}

if (!empty($embed_video)) :  ?>
	<div class="grid-container">
		<div class="hero-banner__wrapper">
			<div class="hero-banner__cover">
				<?php
					the_block(
						'image',
						[
							'image' => $image_video,
							'class' => 'image--default image__img',
							'size' => 'full'
						]
					);
				?>
			</div>
			<div class="hero-banner__title">
				<a href="<?php echo $data['video-url']; ?>" class="hero-banner__button" data-fancybox="video">
					<?php echo kesbie_get_svg('next-btn'); ?>
				</a>
				<h1><?php echo $data['title']; ?></h1>
			</div>
		</div>
	</div>

<?php endif; ?>
