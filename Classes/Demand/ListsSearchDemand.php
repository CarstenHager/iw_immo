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
	namespace IWAG\IwImmo\Demand;

	use IWAG\IwImmo\Utility\ImmoUtility;
	use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

	if (!defined('TYPO3_MODE')) {
		die ('Access denied.');
	}

	/**
	 * Class SearchDemand
	 *
	 * @package IWAG\IwImmo\Domain\Model
	 */
	class ListsSearchDemand {

		/**
		 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
		 * @inject
		 */
		protected $configurationManager;

		/**
		 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
		 * @inject
		 */
		protected $objectManager;

		/**
		 * @var array
		 */
		protected $settings = array();

		/**
		 * Mit Defaultwerten aus settings/flexform befüllen
		 */
		public function initializeObject() {
			$this->settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);

			$this->settings = ImmoUtility::evaluateSettingsWithStdWrap($this->settings);

			foreach ($this->settings['list']['parameters'] as $parameterName => $parameterValue) {
				$setterName = 'set' . ucfirst($parameterName);

				if (!empty($parameterValue) && method_exists($this, $setterName)) {
					$this->$setterName($parameterValue);
				}
			}
		}

		/**
		 * @var string geoid
		 */
		protected $geoid;

		/**
		 * Setzt Variable geoid
		 *
		 * @param string $geoid
		 *
		 * @return self
		 *
		 */
		public function setGeoid($geoid) {
			$this->geoid = $geoid;

			return $this;
		}

		/**
		 * Liefert die Variable geoid
		 *
		 * @return string
		 */
		public function getGeoid() {
			return $this->geoid;
		}

		// ****************************************************************************

		/**
		 * @var int roomi
		 */
		protected $roomi;

		/**
		 * Setzt Variable roomi
		 *
		 * @param int $roomi
		 *
		 * @return self
		 *
		 */
		public function setRoomi($roomi) {
			$this->roomi = $roomi;

			return $this;
		}

		/**
		 * Liefert die Variable roomi
		 *
		 * @return int
		 */
		public function getRoomi() {
			return $this->roomi;
		}

		// ****************************************************************************

		/**
		 * @var int rooma
		 */
		protected $rooma;

		/**
		 * Setzt Variable rooma
		 *
		 * @param int $rooma
		 *
		 * @return self
		 *
		 */
		public function setRooma($rooma) {
			$this->rooma = $rooma;

			return $this;
		}

		/**
		 * Liefert die Variable rooma
		 *
		 * @return int
		 */
		public function getRooma() {
			return $this->rooma;
		}

		// ****************************************************************************


		/**
		 * @var int prima
		 */
		protected $prima;

		/**
		 * Setzt Variable prima
		 *
		 * @param int $prima
		 *
		 * @return self
		 *
		 */
		public function setPrima($prima) {
			$this->prima = $prima;

			return $this;
		}

		/**
		 * Liefert die Variable prima
		 *
		 * @return int
		 */
		public function getPrima() {
			return $this->prima;
		}

		// ****************************************************************************

		/**
		 * @var int primi
		 */
		protected $primi;

		/**
		 * Setzt Variable primi
		 *
		 * @param int $primi
		 *
		 * @return self
		 *
		 */
		public function setPrimi($primi) {
			$this->primi = $primi;

			return $this;
		}

		/**
		 * Liefert die Variable primi
		 *
		 * @return int
		 */
		public function getPrimi() {
			return $this->primi;
		}

		// ****************************************************************************


		/**
		 * @var int esr
		 */
		protected $esr;

		/**
		 * Setzt Variable esr
		 *
		 * @param int $esr
		 *
		 * @return self
		 *
		 */
		public function setEsr($esr) {
			$this->esr = $esr;

			return $this;
		}

		/**
		 * Liefert die Variable esr
		 *
		 * @return int
		 */
		public function getEsr() {
			return $this->esr;
		}

		// ****************************************************************************

		/**
		 * @var int etype
		 */
		protected $etype;

		/**
		 * Setzt Variable etype
		 *
		 * @param int $etype
		 *
		 * @return self
		 *
		 */
		public function setEtype($etype) {
			$this->etype = $etype;

			return $this;
		}

		/**
		 * Liefert die Variable etype
		 *
		 * @return int
		 */
		public function getEtype() {
			return $this->etype;
		}

		// ****************************************************************************


		/**
		 * @var string where
		 */
		protected $where;

		/**
		 * Setzt Variable where
		 *
		 * @param string $where
		 *
		 * @return self
		 *
		 */
		public function setWhere($where) {
			$this->where = $where;

			return $this;
		}

		/**
		 * Liefert die Variable where
		 *
		 * @return string
		 */
		public function getWhere() {
			return $this->where;
		}

		/**
		 * @return bool
		 */
		public function hasLocationRestriction() {
			return !empty($this->where);
		}

		// ****************************************************************************

		/**
		 * @return array
		 */
		public function getGeoDataForLocation() {

			$locationsArray = array();

			if ($this->hasLocationRestriction()) {
				/** @var \IWAG\IwImmo\Service\Geo\LocationsService $locationsService */
				$locationsService = $this->objectManager->get('IWAG\IwImmo\Service\Geo\LocationsService');

				$locationsService->setName($this->getWhere());
				if ($this->getGeoid()) {
					$locationsService->setCountryGeoId($this->getGeoid());

					$locationsArray = $locationsService->execute();

				}

			}

			return $locationsArray;
		}

	}

	?>