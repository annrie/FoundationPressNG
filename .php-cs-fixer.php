<?php

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(false)
    ->setRules(Suin\PhpCsFixer\Rules::create([
        // ルールセットのデフォルトを上書きしたり、ルールを追加したい場合はここに書く。
        'declare_strict_types' => false,
    ]))
    ->setFinder(
        PhpCsFixer\Finder::create()
        ->exclude('vendor')
        ->in(__DIR__)
    );