<?php
namespace App\Filters;

class CategoryFilter
{
    function __invoke($query, $categoria)
    {
        return $query->join('categories', 'movies.category_id', '=', 'categories.id')
            ->where('categories.name', 'like', '%' . $categoria . '%');
    }
}
?>
