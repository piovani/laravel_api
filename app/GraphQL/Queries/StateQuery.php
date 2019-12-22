<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Domain\Localization\State\State;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class StateQuery extends Query
{
    protected $attributes = [
        'name' => 'state',
        'description' => 'A query'
    ];

    public function type(): Type
    {
//        return Type::listOf(Type::string());
        return Type::listOf(GraphQL::type('state_type'));
    }

    public function args(): array
    {
        return [
            'id' => [
//                'type' =>  Type::nonNull(Type::string()),
                'type' => Type::string(),
                'description' => 'Id uuid',
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
//        /** @var SelectFields $fields */
//        $fields = $getSelectFields();
//        $select = $fields->getSelect();
//        $with = $fields->getRelations();

//        if (isset($args['id'])) {
//            return [
//                'id' => $args['id']
//            ];
//        }
//
//        return [
//            'id' => 10
//        ];

        if (isset($args['id'])) {
            return State::where('id', $args['id'])->get();
        }

        return State::all();
    }
}
