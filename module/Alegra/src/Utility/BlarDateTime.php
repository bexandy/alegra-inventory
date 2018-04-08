<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 06/04/18
 * Time: 08:07 PM
 */

namespace Alegra\Utility;


class BlarDateTime extends \DateTime
{
    /**
     * Return Date in ISO8601 format
     *
     * @return String
     */
    public function __toString() {
        return $this->format('Y-m-d H:i');
    }

    /**
     * Return difference between $this and $now
     *
     * @param \DateTime|String $now
     * @return \DateInterval
     */
    public function diff($now = "now", null) {
        if(!($now instanceOf \DateTime)) {
            $now = new \DateTime($now);
        }
        return parent::diff($now);
    }

    /**
     * Return Age in Years
     *
     * @param \DateTime|String $now
     * @return Integer
     */
    public function getAge($now = "now") {
        return $this->diff($now)->format('%y');
    }

    /**
     * Return Time in Hours
     *
     * @param \DateTime|String $now
     * @return Integer
     */
    public function getHours($now = 'NOW') {
        return $this->diff($now)->format('%H');
    }
}