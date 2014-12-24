<?php

class Wool {
    /**
     * @var modX A reference to the modX object.
     */
    public $modx = null;
    
    function __construct(modx &$modx, array $config = array()) {
        $this->modx =& $modx;
        
        $corePath = $this->modx->getOption('wool.core_path',$config,$this->modx->getOption('core_path').'components/wool/');
        $assetsUrl = $this->modx->getOption('wool.assets_url',$config,$this->modx->getOption('assets_url').'components/wool/');

        $this->config = array_merge(array(
            'corePath' => $corePath,
            'templatePath' => $corePath.'templates/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl . 'connector.php'
        ),$config);
    }
    
    public function initialize() {
        
    }
    
    public function fixEllipsis(string $s) {
        return preg_replace('/\.\.\./','&#8230;',$s);
    }
    
    public function encodeQuotes(string $s) {
        $s = preg_replace('/’/','&#8217;',$s);
        $s = preg_replace('/’/','&#8220;',$s);
        $s = preg_replace('/’/','&#8221;',$s);
        
        $s = preg_replace('/"(?=\w)/','&ldquo;',$s);
        $s = preg_replace('/"(?!\w)/','&rdquo;',$s);
        
        $s = preg_replace('/\'(?=\w)/','&lsquo;',$s); 
        $s = preg_replace('/\'(?!\w)/','&rsquo;',$s);
        return $s;
    }
    
    public function fixGreedySpaces($s) {
        return preg_replace('/  +/','&emsp;',$s);
    }
    
    public function fixDashes(string $s) {
        $s = $this->fixEmDash($s);
        $s = $this->fixEnDash($s);
        return $s;
    }
    
    public function fixEmDash(string $s) {
        return preg_replace('/--/','&mdash;',$s);
    }
    
    public function fixEnDash(string $s) {
        return preg_replace('/-/','&ndash;',$s);
    }
    
    public function fixCopyrightSymbols(string $s) {
        return preg_replace('/\(c\)/','&copy;',$s);
    }
    
    public function fixTrademarkSymbols(string $s) {
        return preg_replace_callback("/(<sup>||<sup[^>]+>)TM<\/sup>/i",function($matches){
                    return preg_replace('/TM/i','&trade;',$matches[0]);
        },$s);
    }
    
    public function fixPhonyFractions(string $s) {
        $s = preg_replace('/1\/4/','&frac14;',$s);
        $s = preg_replace('/1\/2/','&frac12;',$s);
        $s = preg_replace('/3\/4/','&frac34;',$s);
        return preg_replace_callback('/\d\/\d/',function($matches){
            $ex = explode('/',$matches[0]);
            $numerator = $ex[0];
            $denominator = $ex[1];
            return "<sup>$numerator</sup>&frasl;<sub>$denominator</sub>";
        },$s);
    }
    
    public function fixPhonyMultiplicationSigns(string $s) {
        return preg_replace_callback('/\d\sx\s\d/',function($matches){
            return preg_replace('/x/','&times;',$matches[0]);
        },$s);
    }
    
    public function fixPhonyDivisionSigns(string $s) {
        $s =  preg_replace_callback('/\d\s\/\s\d/',function($matches){
            return preg_replace('/\//','&divide;',$matches[0]);
        },$s);
        return preg_replace_callback('/\d\s%\s\d/',function($matches){
            return preg_replace('/%/','&divide;',$matches[0]);
        },$s);
    }

    public function fixDegreeSymbols(string $s) {
        return preg_replace_callback('/(0x)?[0-9]+(<sup>||<sup[^>]+>)o<\/sup>/i',function($matches){
            $s =  $matches[0];
            preg_match('/(0x)?[0-9]+(?=<)/',$s,$m);
            return $m[0] . '&deg;';
        },$s);
    }
    
    public function encodeAmpersands(string $s) {
        return preg_replace('/&(?!amp;)/','&amp;',$s);
    }
    
    public function fixShoutCaps(string $s) {
        $ws = explode(' ',$s);
        $fw = ucwords(strtolower(array_shift($ws)));
        $fw = "<span style='text-transform:uppercase'>$fw</span> ";
        $s = implode(' ',$ws);
        return $fw . preg_replace_callback('/\b[A-Z][A-Z]+\b/',function($matches){
            return '<span style="text-transform:uppercase">' . strtolower($matches[0]) . '</span>'; 
        },$s);
    }
    
    public function fixCrazyExclamations(string $s) {
        return preg_replace('/(!)+/','!',$s);
    }
    
    public function fixCrazyQuestionMarks(string $s) {
        return preg_replace('/(\?)+/','?',$s);
    }
    
    public function adopt(string $s, $mw = 3) {
        $ws = explode(' ',$s);
        if(count($ws) >= $mw) $s =  preg_replace('/\s(?=\S*$)/','&nbsp;',$s);
        return $s;
    }
    
    public function fixOrphans(string $s, $mw = 3) { return $this->adpot($s,$mw); }
}
?>