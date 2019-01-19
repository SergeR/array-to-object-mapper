<?php
/**
 * @author Serge Rodovnichenko, <serge@syrnik.com>
 * @copyright Serge Rodovnichenko, 2019
 * @license MIT
 */

namespace SergeR\ArrayToObjectMapper;

/**
 * Interface FillableFromArray
 * @package SergeR\ArrayToObjectMapper
 */
interface FillableFromArray
{
    public static function fromArray(array $values);
}