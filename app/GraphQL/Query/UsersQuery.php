<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\User;

class UsersQuery extends Query
{

    protected $attributes = [
        'name' => 'users'
    ];


    public function type()
    {
        return Type::listOf(GraphQL::type('user'));
    }


    public function args()
    {
        return [
            'id'    => [ 'name' => 'id', 'type' => Type::string() ],
            'title' => [ 'name' => 'title', 'type' => Type::string() ]
        ];
    }


    public function resolve($root, $args)
    {
        if (isset( $args['id'] )) {
            return User::where('id', $args['id'])->get();
        } else {
            if (isset( $args['title'] )) {
                return User::where('title', $args['title'])->get();
            } else {
                return User::all();
            }
        }
    }

}