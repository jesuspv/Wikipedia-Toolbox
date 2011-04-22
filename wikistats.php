<?php //{{MediaWikiExtension}}<source lang="php">
# WikiStats Mediawiki Extension
#
# Tags:
# 	<wikistats lang="LANG">PAGE</wikistats>
# 	<wikicite lang="LANG">PAGE</wikicite>

$wgExtensionFunctions[] = 'wfwikistats';
$wgExtensionCredits['parserhook'][] = array(
	'name' => 'wikistats',
	'description' => 'Display Wikipedia daily-traffic statistics',
	'author' => 'Jesús Pardillo',
	'url' => 'http://www.jesuspardillo.com'
	);

function wfwikistats() {
	global $wgParser;
	$wgParser->setHook('wikistats', 'renderwikistats');
	$wgParser->setHook('wikicite', 'renderwikicite');
}

function renderwikistats($input, $params, &$parser) {
	$page = $input;
	$lang = $params['lang'];
	$prog = './extensions/Wikipedia-Toolbox/wikistats';
	$traffic = exec($prog.' "'.$lang.'" "'.$page.'"');
	return $traffic;
}

function renderwikicite($input, $params, &$parser) {
        $page = $input;
        $lang = $params['lang'];
        $prog = './extensions/Wikipedia-Toolbox/wikistats';
        $traffic = exec($prog.' "'.$lang.'" "'.$page.'"');
	$url  = '<a href="http://'.$lang.'.wikipedia.org/wiki/'.$page.'">'.$page.'</a>';
        return $url.' (<i>'.$traffic.' daily views</i>)';
}

//</source>
?>
