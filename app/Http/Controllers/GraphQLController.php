<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GraphQL;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GraphQLController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query');
        // By default, laravel-graphql looks for 'parameters' instead of 'variables'
        $variables = $request->get('variables');

        if (is_string($variables)) rz{
            $variables = json_decode($variables, true);
        }

        return GraphQL::query($query, $variables);
    }
}