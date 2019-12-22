<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Domain\Localization\State\State;
use App\GraphQL\Types\StateType;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class StateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'state',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('state_type');
    }

    public function args(): array
    {
        return [
            'name'     => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Nome do estado',
            ],
            'initials' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Initials do estado',
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
//        $fields = $getSelectFields();
//        $select = $fields->getSelect();
//        $with = $fields->getRelations();

        $state = factory(State::class)->create([
            'name' => $args['name'],
            'initials' => $args['initials'],
        ]);

        return $state;
    }
}
