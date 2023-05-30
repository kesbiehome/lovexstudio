<?php

function getYoutubeEmbedUrl($url)
{
	if (empty($url)) {
		return false;
	}
	$shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
	$longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

	if (preg_match($longUrlRegex, $url, $matches)) {
		$youtube_id = $matches[count($matches) - 1];
	}

	if (preg_match($shortUrlRegex, $url, $matches)) {
		$youtube_id = $matches[count($matches) - 1];
	}

	if (empty($youtube_id)) {
		return false;
	}

	return 'https://www.youtube.com/embed/' . $youtube_id;
}
