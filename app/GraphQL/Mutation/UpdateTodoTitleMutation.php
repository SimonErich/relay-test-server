<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use App\Todo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\InputObjectType;
use Nuwave\Relay\Mutations\MutationWithClientId;

class UpdateTodoTitleMutation extends MutationWithClientId
{
    /**
     * Name of mutation.
     *
     * @return string
     */
    protected function name()
    {
        return 'updateTodoTitle';
    }

    /**
     * Available input fields for mutation.
     *
     * @return array
     */
    public function inputFields()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'exists:todos'] // Optional
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
            ]
        ];
    }

    /**
     * Validation rules for mutation.
     * Note: This is optional. You can also place rules on
     * your input fields
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required'
        ];
    }

    /**
     * Fields that will be sent back to client.
     *
     * @return array
     */
    protected function outputFields()
    {
        return [
            'todo' => [
                'type' => GraphQL::type('todo'),
                'resolve' => function ($payload) {
                    $todo = Todo::find($payload['id']);

                    return $todo;
                }
            ]
        ];
    }

    /**
     * Perform data mutation.
     *
     * @param  array       $input
     * @param  ResolveInfo $info
     * @return array
     */
    protected function mutateAndGetPayload(array $input, ResolveInfo $info)
    {
        $todo = Todo::find($input['id']);
        $todo->title = $input['title'];
        $todo->save();

        return ['id' => $input['id']];
    }
}