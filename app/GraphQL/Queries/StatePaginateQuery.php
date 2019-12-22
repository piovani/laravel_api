<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Domain\Localization\State\State;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class StatePaginateQuery extends Query
{
    protected $attributes = [
        'name' => 'statePaginate',
        'description' => 'A query of pagination'
    ];

    public function type(): Type
    {
        return GraphQl::paginate('state_type');
    }

    public function args(): array
    {
        return [
            'page' => [
                'type' => type::int(),
                'description' => 'Pagination definida para consulta',
            ],
            'paginate' => [
                'type' => type::int(),
                'description' => 'Quatidadde de registro por consulta',
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $page = $args['page'] ?? 1;

        $paginate = 5;
        if ($args['paginate'] <= 100) {
            $paginate = $args['paginate'];
        }

        return State::paginate($paginate, ['*'], 'page', $page);

    }
}
