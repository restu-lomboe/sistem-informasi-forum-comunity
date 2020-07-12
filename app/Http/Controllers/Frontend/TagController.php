<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function post(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required'
        ]);

        $data = Tag::create($request->all());

        return redirect()->back()->with('status', 'Tag berhasil ditambah');
    }
}
