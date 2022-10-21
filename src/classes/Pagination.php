<?php

namespace App\Classes;

class Pagination {
    public static $limit;
    
    public static function get_data($index, $array, $perPage = null){
        if ($index === 'no_index') {
            self::$limit = '';            
        } else {
            self::$limit = "LIMIT %d, " . ($perPage ?? PAGINATION_ROW_PER_PAGE);
            $array[] = (int) $index - 1;
        }
        return $array;
    }
}
