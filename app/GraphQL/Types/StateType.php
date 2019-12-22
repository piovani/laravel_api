<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Domain\Localization\State\State;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class StateType extends GraphQLType
{
    protected $attributes = [
        'name' => 'State',
        'description' => 'A type',
        'model' => State::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'O id do estado',
            ],
            'name' => [
                'type'        => Type::string(),
                'description' => 'O nome do estado',
            ],
        ];
    }
}
