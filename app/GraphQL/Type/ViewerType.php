<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ViewerType extends GraphQLType
{

    protected $attributes = [
        'name'        => 'Viewer',
        'description' => 'A viewer'
    ];


    public function fields()
    {
        return [
            'id'    => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'The id of the viewer'
            ],
            'email' => [
                'type'        => Type::string(),
                'description' => 'The email of this viewer'
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