<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

trait CanLoadRelationships
{
    /**
     * Load specified relationships conditionally
     * @param Model|QueryBuilder|EloquentBuilder $for
     * @param array|null $relations
     * @return Model|QueryBuilder|EloquentBuilder
     */
    public function loadRelationships(
        Model|QueryBuilder|EloquentBuilder $for,
        ?array $relations = null
    ): Model|QueryBuilder|EloquentBuilder
    {
        // Use provided relations or default to class property
        $relations = $relations ?? $this->relations ?? [];

        // Iterate over each relationship defined in the $relations array
        foreach ($relations as $relation) {
            // Conditionally include the relationship in the query if it should be included
            $for->when(
                $this->shouldIncludeRelation($relation),
                fn($q) => $for instanceof Model ? $for->load($relation) : $q->with($relation)
            );
        }

        return $for;
    }

    /**
     * Determine if a relation should be included based on request query
     * @param string $relation
     * @return bool
     */
    protected function shouldIncludeRelation(string $relation): bool
    {
        // Get the 'include' query parameter
        $include = request()->query('include');

        // If 'include' is not present, return false
        if (!$include) {
            return false;
        }

        // Split 'include' parameter into an array of relations
        $relations = array_map('trim', explode(',', $include));

        // Check if the relation is in the array
        return in_array($relation, $relations);
    }
}
