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

    namespace IWAG\IwImmo\Controller;
    use TYPO3\CMS\Core\Utility\GeneralUtility;

    /**
     * Class SearchController
     *
     * @package IWAG\IwImmo\Controller
     */
    class SearchController extends BaseController {

        /**
         *
         */
        public function indexAction() {
            try {
                /** @var \IWAG\IwImmo\Service\Geo\AutocompleteService $autocompleteService */
                $autocompleteService = $this->objectManager->get('IWAG\\IwImmo\\Service\\Geo\\AutocompleteService');

                $autocompleteService->setCountryGeoId($this->settings['list']['parameters']['geoid']);

            } catch (\Exception $e) {
                $autocompleteService = NULL;
                $this->logger->error($e->getCode() . ': ' . $e->getMessage());
            }

            $this->view->assign('autocompleteService', $autocompleteService);
        }


    }

    ?>
