<?php
/**
 * The $input variable contains an array of digits
 * Return an array which will contain the same digits but repetitive by its value
 * without changing the order.
 * Example: [1,3,2] => [1,3,3,3,2,2]
 *
 * @param  array  $input
 * @return array
 */
function repeatArrayValues(array $input)
{
    if( empty($input) ) return [];
    $array = [];
    foreach ($input as $value) {
        for ($i = 0; $i < $value; $i++){
            $array[] = $value;
        }
    }
    return $array;
}

/**
 * The $input variable contains an array of digits
 * Return the lowest unique value or 0 if there is no unique values or array is empty.
 * Example: [1, 2, 3, 2, 1, 5, 6] => 3
 *
 * @param  array  $input
 * @return int
 */
function getUniqueValue(array $input)
{
    $count_values = array_count_values($input);
    $unique = [];
    foreach ($count_values as $key => $value){
        if($value === 1){
            $unique[] = $key;
        }
    }
    if(!empty($unique)){
        return min($unique);
    }else{
        return 0;
    }
}

/**
 * The $input variable contains an array of arrays
 * Each sub array has keys: name (contains strings), tags (contains array of strings)
 * Return the list of names grouped by tags
 * !!! The 'names' in returned array must be sorted ascending.
 *
 * Example:
 * [
 *  ['name' => 'potato', 'tags' => ['vegetable', 'yellow']],
 *  ['name' => 'apple', 'tags' => ['fruit', 'green']],
 *  ['name' => 'orange', 'tags' => ['fruit', 'yellow']],
 * ]
 *
 * Should be transformed into:
 * [
 *  'fruit' => ['apple', 'orange'],
 *  'green' => ['apple'],
 *  'vegetable' => ['potato'],
 *  'yellow' => ['orange', 'potato'],
 * ]
 *
 * @param  array  $input
 * @return array
 */
function groupByTag(array $input)
{
    $return_array =[];
    foreach ($input as $key => $values){
        foreach ($values['tags'] as $value){
            if(!in_array($values['name'], $return_array)){
                $return_array[$value][] = $values['name'];
            }
            sort($return_array[$value]);
        }
    }
    ksort($return_array);

    return $return_array;
}