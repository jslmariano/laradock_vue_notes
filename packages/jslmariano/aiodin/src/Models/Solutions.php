<?php

namespace Jslmariano\Aiodin\Models;

class Solutions
{

    protected function _validateNumbers($numbers = array())
    {
        foreach($numbers as $value){
            if( ! is_int($value)){
                throw new \InvalidArgumentException(
                    sprintf(
                        '"%s" is not a valid number inside your array',
                        $value
                    )
                );
            }
        }
    }

    protected function _validateOddNumbers($numbers = array())
    {
        foreach($numbers as $value){
            if((int)$value % 2 == 0) {
                throw new \InvalidArgumentException(
                    sprintf(
                        '"%s" is not a valid odd number inside your array',
                        $value
                    )
                );
            }
        }
    }

    // solution 1
    public function countBinaryGap($n = 0)
    {
        if (!is_numeric($n)) {
            return 0;
        }

        $binary              = decbin($n);
        $check_last_validity = substr((string) $binary, -1);

        // split to gorup of zeros
        $binaries = explode("1", $binary);
        $binaries = array_filter($binaries, 'is_numeric');

        // remove last zeros if no ending 1
        if ($check_last_validity == "0") {
            array_pop($binaries);
        }

        // now get max of any remaining zeros
        $max_zeros = 0;
        foreach ($binaries as $zeros) {
            if ($max_zeros < strlen($zeros)) {
                $max_zeros = strlen($zeros);
            }
        }
        return (int) $max_zeros;
    }

    // solution 2
    public function findMissingLink($suspect = array())
    {
        if (empty($suspect)) {
            return array();
        }

        $min_number = 1;
        $max_number = max($suspect);
        $missings   = array();

        $this->_validateNumbers($suspect);

        // loop and get all the missing numbers
        for ($i = $min_number; $i <= $max_number; $i++) {
            if (in_array($i, $suspect)) {
                continue;
            }
            $missings[] = $i;
        }

        if (empty($missings)) {
            return array();
        }

        if (count($missings) == 1) {
            return $missings[0];
        }

        // having mercy to support multiple missing links
        return $missings;
    }

    // solution 3
    public function findLoners($groups = array())
    {
        $loners = array();

        // clean out groups
        $groups = array_filter($groups);

        // make sure we got all integer
        $this->_validateNumbers($groups);

        // make sure we got all odd integer
        $this->_validateOddNumbers($groups);

        /**
         * Count all duplicates
         * https://www.php.net/manual/en/function.array-count-values.php
         */
        $group_counts = array_count_values($groups);

        // now get all non-duplicates
        foreach ($group_counts as $number => $count) {
            if ($count == 1) {
                $loners[] = $number;
            }
        }

        if (empty($loners)) {
            return array();
        }

        if (count($loners) == 1) {
            return $loners[0];
        }


        return $loners;
    }
}
