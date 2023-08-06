<?php

namespace App\Tables;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Countries extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('code', 'LIKE', "%{$value}%");
                });
            });
        });


        return QueryBuilder::for(Country::class)
                    ->defaultSort('id')
                    ->allowedSorts(['id', 'name', 'code'])
                    ->allowedFilters(['name', 'code', $globalSearch]);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id', 'name', 'code'])
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('code', sortable: true)
            // ->rowLink(function (User $user) {
            //     return route('admin.users.edit', $user);
            // })
            ->column('action', sortable: false)
            ->paginate(15)
        ;
    }
}
