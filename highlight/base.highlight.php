<?php

if (!defined('VALID_REQUEST')) die ('Access Denied.'); // Security

require_once(PATH_INCLUDE . 'highlight.inc.php');


class HighlightBaseItems {
	public static function GetCommentLightItems() {
		$items = array();

		return $items;
	}

	public static function GetCommentItems() {
		$items = array();

		$items[] = new HighlightItem('$1┨$2', '$1 ($3)', '$4', '/(?<alias>.+)(.*?)（注：\k<alias>[=＝]([- \w]+)[，。]([^（）]+)）/', 'comment');
		$items[] = new HighlightItem('$1┨$2', '$1',      '$3', '/(?<alias>.+)(.*?)(?:<\/p>\r\n<p>)?（注：(?:\k<alias>[，。：]|「\k<alias>」|\k<alias>＝)([^（）]+)）/', 'comment');
		$items[] = new HighlightItem('$1┨$2', NULL,      '$3', '/([^<>?!　，。？！：；…—「」“”]+)([，。？！：；…—」”）]*)(?:<\/p>\r\n<p>)?（注：([^（）]+)）/', 'comment');
		$items[] = new HighlightItem('$1', '$2', NULL,          '/([^<>?!　、，。？！：；…—「」“”『』‘’（）]+)（\g{-1}[=＝]([ .\'\w]+)）/', 'comment');

		return $items;
	}

	public static function GetCommentEndItems() {
		$items = array();

		$items[] = new HighlightItem('$1┠$2┨$4', '$3', NULL, '/(「|『)([^<>　、，。？！：；…—「」“”『』‘’（）{}]+)（([ \w]+)）(』|」)/', 'comment');
	
		$items[] = new HighlightItem('亟需', null, '强调客观上的需要迫不及待', null, 'comment');

		return $items;
	}

	public static function GetIdiomItems() {
		$items = array();

		$items[] = New_Highlight__Re('奈米', '奈米公尺');
		$items[] = New_Highlight__Re('米',   '公尺');
		$items[] = New_Highlight__Re('厘米', '公分');
		$items[] = New_Highlight__Re('厘米', '公厘');

		$items[] = New_Highlight__Re('奥斯曼', '鄂图曼');

		$items[] = New_Highlight__Re('超市', '超商');

		return $items;
	}
}

?>
