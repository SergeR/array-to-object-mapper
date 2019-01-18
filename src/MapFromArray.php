<?php
/**
 * @author Serge Rodovnichenko, <serge@syrnik.com>
 * @copyright Serge Rodovnichenko, 2019
 * @license MIT
 */

namespace SergeR\ArrayToObjectMapper;

use Syrnik\Text\Inflector;
/**
 * Trait MapFromArray
 * @package SergeR\ArrayToObjectMapper
 */
trait MapFromArray
{
    /**
     * @param array $values
     * @return $this
     */
    public static function fromArray(array $values)
    {
        $obj = new self();
        $_fillable_fields = property_exists($obj, '_fillable_fields') && (is_array($obj->_fillable_fields) || is_null($obj->_fillable_fields)) ? $obj->_fillable_fields : null;

        foreach ($values as $key => $value) {
            if (($_fillable_fields === null) || in_array($key, $_fillable_fields)) {
                if (substr($key, 0, 1) === '_') {
                    continue;
                }
                if (substr($key, 0, 1) === '@') {
                    $_key = substr($key, 1);
                } else {
                    $_key = $key;
                }
                $camelized_key = Inflector::camelize($_key);
                $method = 'set' . $camelized_key;
                if (method_exists($obj, $method)) {
                    $obj->$method($value);
                    continue;
                }
                if (property_exists($obj, $_key)) {
                    $obj->$_key = $value;
                    continue;
                }
                if (property_exists($obj, $camelized_key)) {
                    $obj->$camelized_key = $value;
                }
            }
        }

        return $obj;
    }
}