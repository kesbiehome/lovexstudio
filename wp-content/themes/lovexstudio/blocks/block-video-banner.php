<?php
$title = block_value('title');
$video_thumbnail = block_value('video-thumbnail');
$link_url = block_value('video-url');

$youtube = !empty($link_url) ? $link_url : '';
$image_video = !empty($video_thumbnail) ? $video_thumbnail : '';
$embed_video = !empty($youtube) ? getYoutubeEmbedUrl($youtube) : '';

if (!empty($embed_video) && empty($image_video)) {
	preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $embed_video, $match);
	$image_video = !empty($match) ? 'https://i.ytimg.com/vi/' . $match[1] . '/maxresdefault.jpg' : '';
}


if (!empty($embed_video)) :  ?>
	<div class="grid-container">
		<div class="hero-banner__wrapper" data-child-block='about-us'>
			<div class="hero-banner__cover">
				<?php
				if (is_int($image_video)) :
					the_block(
						'image',
						[
							'image' => $image_video,
							'class' => 'image--default image__img',
							'size' => 'full'
						]
					);
				?>
				<?php else : ?>
					<img src="<?php echo $image_video; ?>" alt="<?php echo $title ?? 'About Us'; ?>">
				<?php endif; ?>
			</div>
			<div class="hero-banner__title">
				<a href="<?php echo $link_url; ?>" class="hero-banner__button" data-fancybox="video">
					<?php echo kesbie_get_svg('next-btn'); ?>
				</a>
				<h1><?php echo $title; ?></h1>
			</div>
		</div>
	</div>


<?php endif; ?>
