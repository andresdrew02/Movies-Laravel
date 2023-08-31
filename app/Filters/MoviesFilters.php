<?php
namespace App\Filters;

class MoviesFilters
{

    protected $filters = [
        'categoria' => CategoryFilter::class,
        'estrellas' => StarsFilter::class,
        'q' => TextFilter::class
    ];

    public function apply($query)
    {
        foreach ($this->receivedFilters() as $filter => $value) {
            $filterInstance = new $this->filters[$filter];
            $query = $filterInstance($query, $value);
        }
        return $query;
    }
    public function receivedFilters(): array
    {
        return request()->only(array_keys($this->filters));
    }
}


?>
