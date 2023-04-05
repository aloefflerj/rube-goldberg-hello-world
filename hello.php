<?php

exec("gcc hello.c -o hello && ./hello && rm -rf hello", $output);
$formattedOutput = array_reduce($output, fn (string $prevOutputLine, string $currOutputLine) 
    => !empty($currOutputLine) ? "$prevOutputLine $currOutputLine" : $prevOutputLine, '');

echo $formattedOutput . "\n";