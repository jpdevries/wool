<?php
    
$corePath = $modx->getOption('wool.core_path', null, $modx->getOption('core_path').'components/wool/');    

$wool = $modx->getService('wool', 'Wool', $corePath . 'model/wool/');
if (!($wool instanceof Wool)) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[Wool] Error loading Wool service class.');
    return $input;
}

$minWords = $modx->getOption('minWords',$scriptProperties,3);
return $wool->adopt($input,$minWords);
