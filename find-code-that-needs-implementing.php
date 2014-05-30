<?php
/**
 * Finds X code that doesn't have corresponding Y code. This helps us
 * to know what Y code still needs implementing.
 *
 * This script needs ack to run. See http://beyondgrep.com/ .
 */
// Case-insensitive patterns for initial search.
$x = 'contentInboundEmailPrefix';
$y = 'extendedAttributes';
// Case-sensitive X-Y pairs that are considered to be equivalent.
$equivalentPairs = [
    'contentInboundEmailPrefix' => 'extendedAttributes',
    'ContentInboundEmailPrefix' => 'ExtendedAttributes',
];
// Filename and string patterns to ignore. Empty this list when you are starting.
$ignore = [];
$ignore = implode('|', $ignore);
$baseDirectory = dirname(__FILE__);
$xMatches = shell_exec("cd $baseDirectory; ack -i $x" . ($ignore ? " | ack -v '$ignore'" : ''));
$yMatches = shell_exec("cd $baseDirectory; ack -i $y" . ($ignore ? " | ack -v '$ignore'" : ''));
$xMatches = preg_replace('/:\d+:/', '::: ', $xMatches);
$yMatches = preg_replace('/:\d+:/', '::: ', $yMatches);
$replacedXMatches = str_replace(array_keys($equivalentPairs), array_values($equivalentPairs), $xMatches);
$xLines = explode("\n", $xMatches);
$replacedXLines = explode("\n", $replacedXMatches);
$replacedXLineNumbers = array_flip($replacedXLines);
$yLines = explode("\n", $yMatches);
$unmatchedReplacedXLines = array_diff($replacedXLines, $yLines);
// Ignore comments.
$ignore = '@:::\\s*/
           |:::\\s*\*
           @xi';
foreach ($unmatchedReplacedXLines as $unmatchedReplacedXLine) {
    if (preg_match($ignore, $unmatchedReplacedXLine)) {
        continue;
    }
    $replacedXLineNumber = $replacedXLineNumbers[$unmatchedReplacedXLine];
    $xLine = $xLines[$replacedXLineNumber];
    // echo "DEBUG: Can't find: " . $unmatchedReplacedXLine . "\n";
    echo "$xLine\n";
}