<?php

########################################################################
# Extension Manager/Repository config file for ext "iw_immo".
########################################################################

$EM_CONF[$_EXTKEY] = array(
    'version'                       => '1.1.7',
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
    'constraints'                   => array(
        'depends'   => array(
            'typo3'        => '6.2.0-7.6.99',
        ),
        'conflicts' => array(),
    ),
    '_md5_values_when_last_written' => '',
    'suggests'                      => array(),
);

?>