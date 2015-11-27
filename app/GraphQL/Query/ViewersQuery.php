<?php

namespace App\GraphQL\Query;

use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use App\Viewer;

class ViewersQuery extends Query
{

    protected $attributes = [
        'name' => 'viewer'
    ];


    public function type()
    {
        return GraphQL::type('user');
    }


    public function args()
    {
        return [
            'id'    => [ 'name' => 'id', 'type' => Type::string() ],
            'name' => [ 'name' => 'name', 'type' => Type::string() ]
        ];
    }


    public function resolve($root, $args)
    {
        return User::first();
    }

}