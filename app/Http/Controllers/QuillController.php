<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuillController extends Controller
{
    public function store (Request $request) {
        if ($request->has('image') && $request->file('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $image->move('storage/quill/', $name);
            return response()->json([$name], 200);
        }

        return response()->json(['success' => false], 500);
    }
}
