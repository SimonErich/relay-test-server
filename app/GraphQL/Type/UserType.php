<?php

namespace App\GraphQL\Type;

use App\Todo;
use App\User;
use App\Widget;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Nuwave\Relay\Types\RelayType;

class UserType extends RelayType
{

    protected $attributes = [
        'name'        => 'User',
        'description' => 'A user'
    ];




    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    /*protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }*/


    /**
     * Get widget by id.
     *
     * When the root 'node' query is called, it will use this method
     * to resolve the type by providing the id.
     *
     * @param  string $id
     * @return Customer
     */
    public function resolveById($id)
    {
        return User::find($id);
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
                'description' => 'The id of the user'
            ],
            'email' => [
                'type'        => Type::string(),
                'description' => 'The email of this user'
            ]
        ];
    }





    /**
     * List of related connections.
     *
     * @return array
     */
    public function connections()
    {
        return [
            'widgets' => [
                'type' => Type::listOf(GraphQL::type('widget')),
                'description' => 'Users widgets',
                'resolve' => function ($user, $args, ResolveInfo $info) {
                    // Note: This is just an example. This type of resolve functionality may not make sense for your
                    // application so just use what works best for you. However, you will need to pass back an object
                    // that implements the LengthAwarePaginator as mentioned above in order for it to work with the
                    // Relay connections spec.
                    $orders = Widget::all();


                    if (isset($args['first'])) {
                        $total = $orders->count();
                        $first = $args['first'];
                        // decodeCursor is a helper function that can be used to
                        // decode the cursor from thee Relay query.
                        $after = $this->decodeCursor($args);
                        $currentPage = $first && $after ? floor(($first + $after) / $first) : 1;

                        return new LengthAwarePaginator(
                            $orders->slice($after)->take($first),
                            $total,
                            $first,
                            $currentPage
                        );
                    }

                    return $orders;
                }
            ],
            'todos' => [
                'type' => Type::listOf(GraphQL::type('todo')),
                'description' => 'Users todos',
                'resolve' => function ($user, $args, ResolveInfo $info) {
                    // Note: This is just an example. This type of resolve functionality may not make sense for your
                    // application so just use what works best for you. However, you will need to pass back an object
                    // that implements the LengthAwarePaginator as mentioned above in order for it to work with the
                    // Relay connections spec.
                    $orders = Todo::all();


                    if (isset($args['first'])) {
                        $total = $orders->count();
                        $first = $args['first'];
                        // decodeCursor is a helper function that can be used to
                        // decode the cursor from thee Relay query.
                        $after = $this->decodeCursor($args);
                        $currentPage = $first && $after ? floor(($first + $after) / $first) : 1;

                        return new LengthAwarePaginator(
                            $orders->slice($after)->take($first),
                            $total,
                            $first,
                            $currentPage
                        );
                    }

                    return $orders;
                }
            ]
        ];
    }

}