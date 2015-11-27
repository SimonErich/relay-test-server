<?php

namespace App\GraphQL\Type;

use App\Widget;
use GraphQL\Type\Definition\Type;
use Nuwave\Relay\Types\RelayType;

class WidgetType extends RelayType
{

    protected $attributes = [
        'name'        => 'Widget',
        'description' => 'A widget'
    ];


    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    /*protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }*/


    /**
     * Get customer by id.
     *
     * When the root 'node' query is called, it will use this method
     * to resolve the type by providing the id.
     *
     * @param  string $id
     * @return Customer
     */
    public function resolveById($id)
    {
        return Widget::find($id);
    }

    /**
     * Available fields of Type.
     *
     * @return array
     */
    public function relayFields()
    {
        return [
            'id'    => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'The id of the widget'
            ],
            'name' => [
                'type'        => Type::string(),
                'description' => 'The name of this widget'
            ]
        ];
    }

}