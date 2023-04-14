<?php

exec("gcc hello.c -o hello && ./hello && rm -rf hello", $helloOutput);
$formattedOutput = array_reduce(
    $helloOutput,
    fn (
        string $prevOutputLine,
        string $currOutputLine
    ) => !empty($currOutputLine) ?
        "$prevOutputLine $currOutputLine" :
        $prevOutputLine,
    ''
);

$formattedOutput = ltrim($formattedOutput);

$formattedOutput = str_split($formattedOutput);
$formattedOutput = str_replace(' ', '-', $formattedOutput);
$separatedHelloChars = implode(' ', $formattedOutput);

exec("rustc hello.rs && ./hello $separatedHelloChars && rm hello", $rustedHelloOutput);

$formattedOutput = str_replace('-', ' ', $rustedHelloOutput);
$formattedOutput = $formattedOutput[0];

echo $formattedOutput . PHP_EOL;
