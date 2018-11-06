<?php
    /***************************************************************
     *  Copyright notice
     *
     *  (c) 2016 Immowelt AG <support@immowelt.de>
     *  All rights reserved
     *
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 2 of the License, or
     *  (at your option) any later version.
     *
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/
    namespace IWAG\IwImmo\ResultObjects;

    use TYPO3\CMS\Core\Utility\GeneralUtility;
    use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
    use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

    if (!defined('TYPO3_MODE')) {
        die ('Access denied.');
    }

    /**
     * Class AbstractResultProperty
     *
     * @package IWAG\IwImmo\ResultObjects
     */
    abstract class AbstractResultProperty extends AbstractEntity {

        /**
         * @var array
         */
        protected $configuration = array();

        /**
         *
         */
        public function __construct() {
            $this->configuration = GeneralUtility::removeDotsFromTS(
                GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)
                    ->get('iw_immo')
            );
        }

        /**
         * @return array
         */
        protected function getSettings() {


            static $settings = array();

            if (empty($settings)) {
                /** @var \\TYPO3\\CMS\\Extbase\\Object\\ObjectManager $objectManager */
                $objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
                $configurationManager = $objectManager->get('\TYPO3\CMS\Extbase\Configuration\ConfigurationManager');
                $settings             = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
            }

            return $settings;
        }
    }

    ?>
