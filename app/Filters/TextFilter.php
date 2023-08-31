<?php
namespace App\Filters;

class TextFilter
{
    function __invoke($query, $q)
    {
        return $query->whereRaw('LOWER(movies.name) LIKE ' . "'%" . strtolower($q) . "%'");
    }
}

?>
