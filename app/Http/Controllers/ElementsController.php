<?php

namespace App\Http\Controllers;

use App\Models\Element;
use Illuminate\Http\Request;

class ElementsController extends Controller
{
    public function all() {
        $elements = Element::all();

        return response()->json([
            'data' => $elements
        ]);
    }
}
