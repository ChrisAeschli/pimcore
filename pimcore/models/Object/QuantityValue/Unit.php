<?php
/**
 * Pimcore
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @category   Pimcore
 * @package    Object
 * @copyright  Copyright (c) 2009-2015 pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GNU General Public License version 3 (GPLv3)
 */

namespace Pimcore\Model\Object\QuantityValue;

use Pimcore\Model;


class Unit extends Model\AbstractModel {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $abbreviation;


    /**
     * @var string
     */
    public $group;


    /**
     * @var string
     */
    public $longname;


    /**
     * @var string
     */
    public $baseunit;


    /**
     * @var double
     */
    public $factor;


    /**
     * @param string $abbreviation
     * @return QuantityValue_Unit
     */
    public static function getByAbbreviation($abbreviation) {
        $unit = new self();
        $unit->getResource()->getByAbbreviation($abbreviation);
        return $unit;
    }

    /**
     * @param string $id
     * @return QuantityValue_Unit
     */
    public static function getById($id) {

        $cacheKey = Unit\Resource::TABLE_NAME . "_" . $id;

        try {
            $unit = \Zend_Registry::get($cacheKey);
        }
        catch (\Exception $e) {

            try {
                $unit = new self();
                $unit->getResource()->getById($id);
                \Zend_Registry::set($cacheKey, $unit);
            } catch(\Exception $ex) {
                \Logger::debug($ex->getMessage());
                return null;
            }

        }

        return $unit;
    }

    /**
     * @param array $values
     * @return Unit
     */
    public static function create($values = array()) {
        $unit = new self();
        $unit->setValues($values);
        return $unit;
    }

    /**
     * @return void
     */
    public function save() {
        $this->getResource()->save();
    }

    /**
     * @return void
     */
    public function delete() {
        $cacheKey = Unit\Resource::TABLE_NAME . "_" . $this->getId();
        \Zend_Registry::set($cacheKey, null);

        $this->getResource()->delete();
    }


    public function __toString() {
        return ucfirst($this->getAbbreviation() . " (" . $this->getId() . ")");
    }

    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;
    }

    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    public function setBaseunit($baseunit)
    {
        $this->baseunit = $baseunit;
    }

    public function getBaseunit()
    {
        return $this->baseunit;
    }

    public function setFactor($factor)
    {
        $this->factor = $factor;
    }

    public function getFactor()
    {
        return $this->factor;
    }

    public function setGroup($group)
    {
        $this->group = $group;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLongname($longname)
    {
        $this->longname = $longname;
    }

    public function getLongname()
    {
        return $this->longname;
    }


}
