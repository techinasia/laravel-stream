<?php
/**
 * Config file for PHP-CS-Fixer.
 *
 * Fixers based on a modification of StyleCI's Laravel preset:
 * https://styleci.readme.io/docs/presets
 */

$finder = PhpCsFixer\Finder::create()
    ->notPath('build')
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$rules = [
    '@Symfony' => true,
    'array_syntax' => ['syntax' => 'short'],
    'concat_space' => ['spacing' => 'one'],
    'not_operator_with_successor_space' => true,
    'ordered_class_elements' => true,
    'ordered_imports' => true,
    'phpdoc_align' => false,
    'phpdoc_no_empty_return' => false,
];

return PhpCsFixer\Config::create()
    ->setRules($rules)
    ->setFinder($finder)
    ->setUsingCache(false);
