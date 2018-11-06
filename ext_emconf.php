<?php

$EM_CONF[$_EXTKEY] = [
    'version'                       => '1.2.7',
    'title'                         => 'IwImmo',
    'description'                   => 'Immowelt Extension',
    'category'                      => 'plugin',
    'shy'                           => 0,
    'dependencies'                  => '',
    'conflicts'                     => '',
    'priority'                      => '',
    'loadOrder'                     => '',
    'module'                        => '',
    'state'                         => 'stable',
    'uploadfolder'                  => 0,
    'createDirs'                    => '',
    'modify_tables'                 => '',
    'clearcacheonload'              => 0,
    'lockType'                      => '',
    'author'                        => 'Immowelt AG',
    'author_email'                  => 'support@immowelt.de',
    'author_company'                => 'Immowelt AG',
    'CGLcompliance'                 => '',
    'CGLcompliance_note'            => '',
    'constraints'                   => [
        'depends'   => [
            'typo3'        => '9.5.0-9.5.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'IWAG\\IwImmo\\' => 'Classes',
        ],
    ],
];
