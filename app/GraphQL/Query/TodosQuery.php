<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Todo;

class TodosQuery extends Query
{

    protected $attributes = [
        'name' => 'todos'
    ];


    public function type()
    {
        return Type::listOf(GraphQL::type('todo'));
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
            return Todo::where('id', $args['id'])->get();
        } else {
            if (isset( $args['title'] )) {
                return Todo::where('title', $args['title'])->get();
            } else {
                return Todo::all();
            }
        }
    }

}