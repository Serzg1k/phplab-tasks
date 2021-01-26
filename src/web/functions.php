<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports)
{
    $first_word = [];
    if( is_array($airports) ) {
        foreach ($airports as $airport) {
            if( !in_array($airport['name'][0], $first_word) ){
                $first_word[] = $airport['name'][0];
            }
        }
    }
    sort($first_word);
    return $first_word;
}

/**
 * Build get params
 *
 * @param  string  $key
 * @param  string  $value
 * @return string
 */
function addQueryArgs( $key, $value){
    $get_args = $_GET;
    $get_args[$key] = $value;
    $i = 0;
    $ulr_params = '';
    foreach ($get_args as $k => $v){
        if($i === 0){
            $ulr_params .= "?{$k}={$v}";
        }else{
            $ulr_params .= "&{$k}={$v}";
        }
        $i++;
    }

    return $ulr_params;
}

/**
 * Get paginate count
 *
 * @param  array  $airports
 * @param  numeric  $items_per_page
 * @return string
 */
function getPaginateCount(array $airports, $items_per_page = 5){
    $count = count($airports);

    return gmp_div_q($count, $items_per_page);
}