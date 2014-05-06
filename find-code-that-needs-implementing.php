<?php
/**
 * Finds X code that doesn't have corresponding Y code. This helps us
 * to know what Y code still needs implementing.
 *
 * This script needs ack to run. See http://beyondgrep.com/ .
 */
$x = 'googlePlusOne';
$y = 'linkedInSharing';
// Case-sensitive X-Y pairs that are considered to be equivalent.
$equivalentPairs = [
    'GooglePlusOne' => 'LinkedInSharing',
    'googlePlusOne' => 'linkedInSharing',
    'google-plusone' => 'linkedin-sharing',
];
// Filename and string patterns to ignore. Empty this list when you are starting.
$ignore = ['instances/main/widget-configuration.xml',
           'lib/XG_App.php',
           'lib/XG_ConfigHelper.php',
           'lib/Migration/NetworkSetting.php',
           'afterContent.php',
           'googlePlusOneButton.php',
           'XG_JsMetadata.php',
           'LikeController.php',
           'googlePlusOne.js',
           'GooglePlusOneApi'];
$ignore = implode('|', $ignore);
$baseDirectory = realpath(dirname(__FILE__) . "/../webapp");
$xMatches = shell_exec("cd $baseDirectory; ack -i $x | ack -v '$ignore' | ack -vi $y");
$yMatches = shell_exec("cd $baseDirectory; ack -i $y | ack -v '$ignore'");
$xMatches = preg_replace('/:\d+:/', '::: ', $xMatches);
$yMatches = preg_replace('/:\d+:/', '::: ', $yMatches);
$replacedXMatches = str_replace(array_keys($equivalentPairs), array_values($equivalentPairs), $xMatches);
$xLines = explode("\n", $xMatches);
$replacedXLines = explode("\n", $replacedXMatches);
$replacedXLineNumbers = array_flip($replacedXLines);
$yLines = explode("\n", $yMatches);
$unmatchedReplacedXLines = array_diff($replacedXLines, $yLines);
$ignore = '@:::\\s*/
           |:::\\s*\*
           @xi';
foreach ($unmatchedReplacedXLines as $unmatchedReplacedXLine) {
    if (preg_match($ignore, $unmatchedReplacedXLine)) {
        continue;
    }
    $replacedXLineNumber = $replacedXLineNumbers[$unmatchedReplacedXLine];
    $xLine = $xLines[$replacedXLineNumber];
    echo "$xLine\n";
}