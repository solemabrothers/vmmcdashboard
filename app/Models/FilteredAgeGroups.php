<?php
/**
 * Created by PhpStorm.
 * User: SOLEMA
 * Date: 11/07/2018
 * Time: 11:58
 */

namespace App\Models;


class FilteredAgeGroups
{

    public $objectname;
    public $objectvalue;


    /**
     * PieChart constructor.
     * @param $objectname
     * @param $objectvalue
     */

    public function __construct($objectname, $objectvalue)
    {
        $this->objectname = $objectname;
        $this->objectvalue = $objectvalue;
           }
    /**
     * @return mixed
     */
//    public function getTarget()
//    {
//        return $this->target;
//    }

    /**
     * @param mixed $target
     */
//    public function setTarget($target): void
//    {
//        $this->target = $target;
//    }

    /**
     * @return mixed
     */
    public function getObjectname()
    {
        return $this->objectname;
    }

    /**
     * @param mixed $objectname
     */
    public function setObjectname($objectname): void
    {
        $this->objectname = $objectname;
    }

    /**
     * @return mixed
     */
    public function getObjectvalue()
    {
        return $this->objectvalue;
    }

    /**
     * @param mixed $objectvalue
     */
    public function setObjectvalue($objectvalue): void
    {
        $this->objectvalue = $objectvalue;
    }


}
