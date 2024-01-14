<?php

namespace App\JsonApi\V1\Categories;

use App\JsonApi\Filters\SearchFilter;
use App\Models\Category;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsTo;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsToMany;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class CategorySchema extends Schema
{

    /**
     * The model the schema corresponds to.
     *
     * @var string
     */
    public static string $model = Category::class;

    //todo понять куда нужно описывать аннотации
    /**
     * @OA\Get(
     *     path="/api/v1/categories",
     *     summary="Get categories",
     *     description="Get categories",
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *     )
     * )
     */
    public function fields(): array
    {
        return [
            ID::make(),
            BelongsTo::make('author')->type('users')->readOnly(),
            Str::make('name'),
            BelongsToMany::make('posts')->readOnly(),
            DateTime::make('createdAt')->sortable()->readOnly(),
            DateTime::make('updatedAt')->sortable()->readOnly(),
        ];
    }

    /**
     * Get the resource filters.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            WhereIdIn::make($this),
            SearchFilter::make('search', 'name'),
        ];
    }

    /**
     * Get the resource paginator.
     *
     * @return Paginator|null
     */
    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }

}
