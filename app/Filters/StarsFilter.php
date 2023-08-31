<?php
namespace App\Filters;

class StarsFilter
{
    function __invoke($query, $estrellas)
    {
        return $query->where('movies.stars', ">=", $estrellas);
    }
}

?>
