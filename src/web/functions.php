<?php

define( 'ITEMS_PER_PAGE', 10 );

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
 * @return string
 */
function getPaginateCount(array $airports){

    if(array_key_exists( 'filter_by_first_letter', $_GET )){
        $airports = get_first_letter($airports, $_GET, 'filter_by_first_letter','name');
    }
    if(array_key_exists( 'filter_by_state', $_GET )){
        $airports = get_first_letter($airports, $_GET, 'filter_by_state', 'state');
    }
    $count = count($airports);
    return ceil($count/ITEMS_PER_PAGE);
}

/**
 * Get airports
 *
 * @param  array  $search_params
 * @return array
 */
function get_airports(array $search_params){
    $airports = require './airports.php';

    if(array_key_exists( 'filter_by_first_letter', $search_params )){
        $airports = get_first_letter($airports, $search_params, 'filter_by_first_letter', 'name');
    }
    if(array_key_exists( 'filter_by_state', $search_params )){
        $airports = get_first_letter($airports, $search_params, 'filter_by_state', 'state');
    }
    if(array_key_exists( 'filter', $search_params)) {
        usort($airports, function ($a, $b) use($search_params){
            $c = strcmp($a[$search_params['filter']], $b[$search_params['filter']]);
            return $c;
        });
    }

    return array_filter(array_values($airports), function ($value, $key) use ($search_params){
        if( array_key_exists( 'page', $search_params) ) {
            if($search_params['page'] == 1){
                $item_from = 0;
            }else{
                $item_from = ($search_params['page'] - 1) * ITEMS_PER_PAGE;
            }
            $item_to = $search_params['page'] * ITEMS_PER_PAGE;
            if( $key >= $item_from && $key < $item_to){
                return $value;
            }
        }
        elseif(empty($search_params) || !array_key_exists( 'page', $search_params)){
            if( $key < ITEMS_PER_PAGE){
                return $value;
            }
        }
    }, ARRAY_FILTER_USE_BOTH);
}

/**
 * Get first letters
 *
 * @param  array  $airports
 * @param  array  $search_params
 * @param  string  $value
 * @param  string  $string
 * @return array
 */
function get_first_letter (&$airports, $search_params, $value, $string){
    return array_filter($airports, function ($val) use ($search_params, $value, $string){
        if($search_params[$value] == $val[$string][0]){
            return $val;
        }
    });
}