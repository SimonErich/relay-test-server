<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Widget;

class WidgetsQuery extends Query
{

    protected $attributes = [
        'name' => 'Widgets query'
    ];


    public function type()
    {
        return Type::listOf(GraphQL::type('widget'));
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
        if (isset( $args['id'] )) {
            return Widget::where('id', $args['id'])->get();
        } else {
            if (isset( $args['name'] )) {
                return Widget::where('name', $args['name'])->get();
            } else {
                return Widget::all();
            }
        }
    }

}