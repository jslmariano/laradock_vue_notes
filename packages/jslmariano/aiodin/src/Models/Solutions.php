<?php

namespace Jslmariano\Aiodin\Models;

/**
 * This class describes solutions.
 */
class Solutions
{

    /**
     * Validate array if valid numbers, raise if one is not
     *
     * @param      array                      $numbers  The numbers
     *
     * @throws     \InvalidArgumentException  Invalid number
     */
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

    /**
     * Validate array if odd numbers, raise if one is not
     *
     * @param      array                      $numbers  The numbers
     *
     * @throws     \InvalidArgumentException  Invalid odd number
     */
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

    /**
     * Solution 2
     *
     * Get all missing numbers inside the array, from 1..N
     *
     * @param      array  $groups  The groups
     *
     * @return     array  The loners.
     */
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

    /**
     * Solution 2
     *
     * Get all missing numbers inside the array, from 1..N
     *
     * @param      array  $groups  The groups
     *
     * @return     array  The loners.
     * @throws     \InvalidArgumentException  (description)
     */
    public function getMissingLink($suspect = array())
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

        // NOT ON THE REQUIRMENTS BUT STILL SUPPORTED MULTIPLE MISSING
        return $missings;
    }

    /**
     * Solution 3
     *
     * Get all un-paired numbers inside the array
     *
     * @param      array  $groups  The groups
     *
     * @return     array  The loners.
     * @throws     \InvalidArgumentException  Invalid number | Invalid odd number
     */
    public function getLoners($groups = array())
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


        // NOT ON THE REQUIRMENTS BUT STILL SUPPORTED MULTIPLE UNPAIRED
        return $loners;
    }

    /**
     * Gets the most least characters.
     *
     * @param      string  $word   The word
     *
     * @return     array  The most least characters.
     */
    public function getMostLeastCharacters($word = '')
    {
        /**
         * Break into pieaces.
         * https://www.php.net/manual/en/function.str-split.php
         */
        $characters = str_split($word);

        /**
         * Count all duplicated
         * https://www.php.net/manual/en/function.array-count-values.php
         */
        $character_counts = array_count_values($characters);
        $most_count = max($character_counts);
        $least_count = 1;
        $most_characters = array();
        $least_characters = array();

        // get all most characters
        foreach ($character_counts as $character => $count) {
            if ($count == $most_count) {
                $most_characters[] = $character;
            }
            if ($count == $least_count) {
                $least_characters[] = $character;
            }
        }

        $result = array();
        $result['most_characters'] = $most_characters;
        $result['biggest_most_character'] = max($most_characters);
        $result['most_count'] = $most_count;
        $result['least_characters'] = $least_characters;
        $result['biggest_least_character'] = max($least_characters);

        return $result;
    }
}
