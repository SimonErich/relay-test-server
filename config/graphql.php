<?php


return [
    
    // The prefix for routes
    'prefix' => 'graphql',


    'controllers' => '\App\Http\Controllers\GraphQLController@index',
    
    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // 'routes' => [
    //     'query' => '/query',
    //     'mutation' => '/mutation'
    // ]
    //
    'routes' => '/',
    //'routes' => [
    //     'query' => '/query',
    //     'mutation' => '/mutation'
    // ],
    
    // The schema for query and/or mutation. It expects an array to provide
    // both the 'query' fields and the 'mutation' fields. You can also
    // provide directly an object GraphQL\Schema
    //
    // Example:
    //
    // 'schema' => new Schema($queryType, $mutationType)
    //
    // or
    //
    // 'schema' => [
    //     'query' => [
    //          'users' => 'App\GraphQL\Query\UsersQuery'
    //      ],
    //     'mutation' => [
    //          
    //     ]
    // ]
    //
    'schema' => [
        'query' => [
            'todos' => App\GraphQL\Query\TodosQuery::class,
            'widgets' => App\GraphQL\Query\WidgetsQuery::class,
            'users' => App\GraphQL\Query\UsersQuery::class,
            'viewer' => App\GraphQL\Query\ViewersQuery::class,
            'node' => Nuwave\Relay\Node\NodeQuery::class,
        ],
        'mutation' => [
            'updateTodoTitle' => App\GraphQL\Mutation\UpdateTodoTitleMutation::class,
            'addTodo' => App\GraphQL\Mutation\AddTodoMutation::class
        ]
    ],
    
    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     'user' => 'App\GraphQL\Type\UserType'
    // ]
    //
    'types' => [
        'user' => App\GraphQL\Type\UserType::class,
        'todo' => App\GraphQL\Type\TodoType::class,
        'widget' => App\GraphQL\Type\WidgetType::class,
        'viewer' => App\GraphQL\Type\ViewerType::class,
        'node' => Nuwave\Relay\Node\NodeType::class,
        'pageInfo' => Nuwave\Relay\Types\PageInfoType::class,
    ]
    
];
