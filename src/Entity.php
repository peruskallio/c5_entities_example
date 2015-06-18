<?php

/**
 * This is a simple helper class that provides visibility to the object
 * properties outside of this class. By default, all properties are readable
 * and writable from outside of the entity class but each property can be
 * protected from both outside actions (read or write) with the $protect,
 * $protectRead and $protectWrite arrays as follows:
 * 
 * $protect      - All properties defined within this array are neither writable
 *                 nor readable. They are protected to be used only by this
 *                 entity class.
 * $protectRead  - All properties defined within this array are protected from
 *                 reading outside of this class. It means that they can only
 *                 be read within this entity class.
 * $protectWrite - All properties defined within this array are protected from
 *                 writing outside of this class. It means that they can only
 *                 be written within this entity class.
 * 
 * @author Antti Hukkanen <antti.hukkanen(at)mainiotech.fi>
 * @copyright 2014 Mainio Tech Ltd.
 * @license MIT
 */

namespace Concrete\Package\EntitiesExample\Src;

abstract class Entity
{

    protected $protect = array();
    protected $protectRead = array();
    protected $protectWrite = array();

    public function get($name)
    {
        if(property_exists($this, $name) && !in_array($name, $this->protect) && !in_array($name, $this->protectRead)) {
            return $this->$name;
        }
    }

    public function set($name, $value)
    {
        if(property_exists($this, $name) && !in_array($name, $this->protect) && !in_array($name, $this->protectWrite)) {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

}
