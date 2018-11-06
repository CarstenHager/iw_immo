<?php
namespace IWAG\IwImmo\ViewHelpers\Widget;

use IWAG\IwImmo\Service\Lists\AbstractListsService;
use IWAG\IwImmo\ViewHelpers\Widget\Controller\PaginateController;

if (!defined('TYPO3_MODE')) die ('Access denied.');

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
class PaginateViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Widget\PaginateViewHelper
{
    /**
     * @var \IWAG\IwImmo\ViewHelpers\Widget\Controller\PaginateController
     * @inject
     */
    protected $controller;

    /**
     * @param \IWAG\IwImmo\ViewHelpers\Widget\Controller\PaginateController $controller
     */
    public function injectController(PaginateController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param AbstractListsService $objects
     * @param string $as
     * @param array $configuration
     *
     * @return string|\TYPO3\CMS\Extbase\Mvc\ResponseInterface
     * @throws \TYPO3\CMS\Fluid\Core\Widget\Exception\MissingControllerException
     */
    public function render(AbstractListsService $objects, $as, array $configuration = array('itemsPerPage' => 10, 'insertAbove' => FALSE, 'insertBelow' => TRUE, 'maximumNumberOfLinks' => 99))
    {
        return $this->initiateSubRequest();
    }
}

?>