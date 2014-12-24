<?php
/* Get the core config */
if (!file_exists(dirname(dirname(__FILE__)).'/config.core.php')) {
    die('ERROR: missing '.dirname(dirname(__FILE__)).'/config.core.php file defining the MODX core path.');
}

require_once dirname(dirname(__FILE__)) . '/config.core.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx= new modX();
$modx->initialize('mgr');
$modx->getService('error','error.modError', '', '');
$modx->setLogTarget('HTML');

$settings = include dirname(dirname(__FILE__)) . '/_build/data/transport.settings.php';
$update = false;

foreach ($settings as $key => $setting) {
    /** @var modSystemSetting $setting */
    $exists = $modx->getObject('modSystemSetting', array('key' => 'wool.'.$key));
    if (!($exists instanceof modSystemSetting)) {
        $setting->save();
    }
    elseif ($update && ($exists instanceof modSystemSetting)) {
        $exists->fromArray($setting->toArray(), '', true);
        $exists->save();
    }
}


$componentPath = dirname(dirname(__FILE__));
$Wool = $modx->getService('wool','Wool', $componentPath.'/core/components/wool/model/wool/', array(
    'wool.core_path' => $componentPath.'/core/components/wool/',
));


/* Namespace */
if (!createObject('modNamespace',array(
    'name' => 'wool',
    'path' => $componentPath.'/core/components/wool/',
    'assets_path' => $componentPath.'/assets/components/wool/',
),'name', false)) {
    echo "Error creating namespace wool.\n";
}

/* Path settings */
if (!createObject('modSystemSetting', array(
    'key' => 'wool.core_path',
    'value' => $componentPath.'/core/components/wool/',
    'xtype' => 'textfield',
    'namespace' => 'wool',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating wool.core_path setting.\n";
}

if (!createObject('modSystemSetting', array(
    'key' => 'wool.assets_path',
    'value' => $componentPath.'/assets/components/wool/',
    'xtype' => 'textfield',
    'namespace' => 'wool',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating wool.assets_path setting.\n";
}

/* Fetch assets url */
$url = 'http';
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) {
    $url .= 's';
}
$url .= '://'.$_SERVER["SERVER_NAME"];
if ($_SERVER['SERVER_PORT'] != '80') {
    $url .= ':'.$_SERVER['SERVER_PORT'];
}
$requestUri = $_SERVER['REQUEST_URI'];
$bootstrapPos = strpos($requestUri, '_bootstrap/');
$requestUri = rtrim(substr($requestUri, 0, $bootstrapPos), '/').'/';
$assetsUrl = "{$url}{$requestUri}assets/components/wool/";

if (!createObject('modSystemSetting', array(
    'key' => 'wool.assets_url',
    'value' => $assetsUrl,
    'xtype' => 'textfield',
    'namespace' => 'wool',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating wool.assets_url setting.\n";
}

/**
 * Plugin
 */

if (!createObject('modPlugin', array(
    'name' => 'Wool',
    'static' => true,
    'static_file' => $componentPath.'/_build/elements/plugins/wool.plugin.php',
), 'name', true)) {
    echo "Error creating Wool Plugin.\n";
}


/**
 * Creates an object.
 *
 * @param string $className
 * @param array $data
 * @param string $primaryField
 * @param bool $update
 * @return bool
 */
function createObject ($className = '', array $data = array(), $primaryField = '', $update = true) {
    global $modx;
    /* @var xPDOObject $object */
    $object = null;

    /* Attempt to get the existing object */
    if (!empty($primaryField)) {
        $object = $modx->getObject($className, array($primaryField => $data[$primaryField]));
        if ($object instanceof $className) {
            if ($update) {
                $object->fromArray($data);
                return $object->save();
            } else {
                echo "Skipping {$className} {$data[$primaryField]}: already exists.\n";
                return true;
            }
        }
    }

    /* Create new object if it doesn't exist */
    if (!$object) {
        $object = $modx->newObject($className);
        $object->fromArray($data, '', true);
        return $object->save();
    }

    return false;
}
