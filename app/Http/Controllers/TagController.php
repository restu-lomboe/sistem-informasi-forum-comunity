<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Tag\TagCreateRequest;
use App\Http\Requests\Tag\TagUpdateRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::all();
        return view('pages.tag.index', compact('tag'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('pages.tag.show', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagCreateRequest $request)
    {
        try {
            Tag::create($request->all());
            return redirect()->back()->with(['error' => false, 'message' => 'Create tag success']);
        } catch(\Exception $e) {
            return redirect()->back()->with(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $id)
    {
        try {
            $tag = Tag::find($id);
            $tag->update($request->all());
            return redirect()->back()->with(['error' => false, 'message' => 'Update tag success']);
        } catch(\Exception $e) {
            return redirect()->back()->with(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tag = Tag::find($id);
            if($tag->pertanyaan->isEmpty()) {
                $tag->delete();
                return redirect()->back()->with(['error' => false, 'message' => 'Delete tag success']);
            } else {
                return redirect()->back()->with(['error' => false, 'message' => 'Tag masih memiliki artikel']);
            }
        } catch(\Exception $e) {
            return redirect()->back()->with(['error' => true, 'message' => $e->getMessage()]);
        }
    }
}
