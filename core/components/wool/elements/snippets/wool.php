<?php
/**
 * wool
 * 
 * Stop stealing sheep & make your clients look like they know how type works with this typographic crime-stopping snippet for MODX 2.x.
 * 
 * @author JP DeVries
 * @copyright Copyright 2013-2014, JP DeVries
 * 
 * "Any man who would letterspace blackletter would shag sheep." — Frederic Goudy
 * 
 * Inspired by Erik Spiekermann and Line25
 * http://line25.com/articles/10-html-entity-crimes-you-really-shouldnt-commit
*/

/* load the wool service */
$corePath = $modx->getOption('wool.core_path', null, $modx->getOption('core_path').'components/wool/');    
$wool = $modx->getService('wool', 'Wool', $corePath . 'model/wool/');
if (!($wool instanceof Wool)) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[Wool] Error loading Wool service class.');
    return $input;
}

/* set default properties */
$fixEllipsis = (boolean) $modx->getOption('fixEllipsis',$scriptProperties,true);
$encodeQuotes = (boolean) $modx->getOption('encodeQuotes',$scriptProperties,true);
$fixGreedySpaces = (boolean) $modx->getOption('fixGreedySpaces',$scriptProperties,true);
$fixDashes = (boolean) $modx->getOption('fixDashes',$scriptProperties,true);
$fixPhonyFractions = (boolean) $modx->getOption('fixPhonyFractions',$scriptProperties,true);
$fixPhonyMultiplicationSigns = (boolean) $modx->getOption('fixPhonyMultiplicationSigns',$scriptProperties,true);
$fixPhonyDivisionSigns = (boolean) $modx->getOption('fixPhonyDivisionSigns',$scriptProperties,true);
$fixDegreeSymbols = (boolean) $modx->getOption('fixDegreeSymbols',$scriptProperties,true);
$fixCopyrightSymbols = (boolean) $modx->getOption('fixCopyrightSymbols',$scriptProperties,false);
$fixTrademarkSymbols = (boolean) $modx->getOption('fixTrademarkSymbols',$scriptProperties,false);
$encodeAmpersands = (boolean) $modx->getOption('encodeAmpersands',$scriptProperties,false);
$fixShoutCaps = (boolean) $modx->getOption('fixShoutCaps',$scriptProperties,false);
$fixCrazyExclamations = (boolean) $modx->getOption('fixCrazyExclamations',$scriptProperties,false);
$fixCrazyQuestionMarks = (boolean) $modx->getOption('fixCrazyQuestionMarks',$scriptProperties,false);

/* conditionally perform regex magic */
if($fixEllipsis) $input = $wool->fixEllipsis($input);
if($fixOrphans) $input = $wool->adpot($input);
if($encodeQuotes) $input = $wool->encodeQuotes($input);
if($fixGreedySpaces) $input = $wool->fixGreedySpaces($input);
if($fixDashes) $input = $wool->fixDashes($input);
if($fixCopyrightSymbols) $input = $wool->fixCopyrightSymbols($input);
if($fixTrademarkSymbols) $input = $wool->fixTrademarkSymbols($input);
if($fixPhonyFractions) $input = $wool->fixPhonyFractions($input);
if($fixPhonyMultiplicationSigns) $input = $wool->fixPhonyMultiplicationSigns($input);
if($fixPhonyDivisionSigns) $input = $wool->fixPhonyDivisionSigns($input);
if($fixDegreeSymbols) $input = $wool->fixDegreeSymbols($input);
if($encodeAmpersands) $input = $wool->encodeAmpersands($input);
if($fixShoutCaps) $input = $wool->fixShoutCaps($input);
if($fixCrazyExclamations) $input = $wool->fixCrazyExclamations($input);
if($fixCrazyQuestionMarks) $input = $wool->fixCrazyQuestionMarks($input);

return $input;