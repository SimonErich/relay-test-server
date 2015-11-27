<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TodoType extends GraphQLType
{

    protected $attributes = [
        'name'        => 'Todo',
        'description' => 'A todo'
    ];


    public function fields()
    {
        return [
            'id'    => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'The id of the todo'
            ],
            'title' => [
                'type'        => Type::string(),
                'description' => 'The title of this todo'
            ]
        ];
    }


    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    /*protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }*/

}