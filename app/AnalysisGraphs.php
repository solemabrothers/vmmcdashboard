<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisGraphs
{
    public $name;
    public $values;
    public $object_id;

    /**
     * AnalysisGraphs constructor.
     * @param $name
     * @param $values
     * @param $object_id
     */
    public function __construct($name, $values, $object_id)
    {
        $this->name = $name;
        $this->values = $values;
        $this->object_id = $object_id;
    }

    /**
     * AnalysisGraphs constructor.
     * @param $name
     * @param $values
     */
//    public function __construct($name, $values)
//    {
//        $this->name = $name;
//        $this->values = $values;
//    }


    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->object_id;
    }

    /**
     * @param mixed $object_id
     */
    public function setObjectId($object_id): void
    {
        $this->object_id = $object_id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     */
    public function setValues($values): void
    {
        $this->values = $values;
    }


}
