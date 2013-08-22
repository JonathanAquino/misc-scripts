<?php
/**
 * Changes timestamps in a zsh history file (~/.zsh_history) to human-readable format.
 *
 * Usage: tail -n 100 ~/.zsh_history | php zsh-history-timestamps.php
 */

date_default_timezone_set('America/Los_Angeles');

while ($line = fgets(STDIN)) {
    echo preg_replace_callback('/^: (\d+):/', 'f', $line);
}

function f($matches) {
    return date('Y-m-d g:ia ', $matches[1]);
}
