<?php
/**
 * @package wool
 * @subpackage build
 */
function getSnippetContent($filename) {
    $o = file_get_contents($filename);
    return $o;
}

$snippets = array();
$snippetsSource = array(
	'wool' => array(
		'description' => $modx->lexicon('wool.adopt_desc'),
	),
	'wool.copyright' => array(
		'description' => $modx->lexicon('wool.copyright_desc'),
	),
	'wool.degree-symbol' => array(
		'description' => $modx->lexicon('wool.degree-symbol_desc'),
	),
	'wool.division-signs' => array(
		'description' => $modx->lexicon('wool.division-signs_desc'),
	),
	'wool.ellipsis' => array(
		'description' => $modx->lexicon('wool.ellipsis_desc'),
	),
	'wool.emsp' => array(
		'description' => $modx->lexicon('wool.emsp_desc'),
	),
	'wool.encode-ampersands' => array(
		'description' => $modx->lexicon('wool.encode-ampersands_desc'),
	),
	'wool.encode-quotes' => array(
		'description' => $modx->lexicon('wool.encode-quotes_desc'),
	),
	'wool.fractions' => array(
		'description' => $modx->lexicon('wool.fractions_desc'),
	),
	'wool.mdash' => array(
		'description' => $modx->lexicon('wool.mdash_desc'),
	),
	'wool.multiplication-signs' => array(
		'description' => $modx->lexicon('wool.multiplication-signs_desc'),
	),
	'wool.ndash' => array(
		'description' => $modx->lexicon('wool.ndash_desc'),
	),
	'wool.quotes' => array(
		'description' => $modx->lexicon('wool.quotes_desc'),
	),
	'wool.trademark' => array(
		'description' => $modx->lexicon('wool.trademark_desc'),
	),
	'wool.adopt' => array(
		'description' => $modx->lexicon('wool.adopt_desc'), 
        'properties' => $sources['data'].'properties/properties.wool.adopt.php'
	),
	'wool.shout-caps' => array(
		'description' => $modx->lexicon('wool.shout-caps_desc'),
	),
	'wool.crazy-exclamations' => array(
		'description' => $modx->lexicon('wool.crazy-exclamations_desc'),
	),
	'wool.crazy-question-marks' => array(
		'description' => $modx->lexicon('wool.crazy-question-marks_desc'),
	),
);

$i = 1;
foreach ($snippetsSource as $key => $options) {
	$snippets[$i]= $modx->newObject('modSnippet');
	$snippets[$i]->fromArray(array(
	    'id' => $i,
	    'name' => $key,
	    'description' => $options['description'],
	    'snippet' => getSnippetContent($sources['elements'].'snippets/' . $key . '.php'),
	));
    if($options['properties']) {
    	$properties = include $options['properties'];
    	$snippets[$i]->setProperties($properties);        
    }

	//$o = getSnippetContent($sources['elements'].'snippets/' . $key . '.php');
	//echo "\n\n\n$key\n$o";
	//unset($properties);
	$i++;
}
return $snippets;

