<?php

namespace App\Http\Controllers\cms;

use App\Models\post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $count = 10;

        if($request->has('count')) {
            $count = $request->count;
            // if($request->count == 'all') {
            //     $count = Post::count();

            // }
        }


        $posts = Post::orderByDesc('id')->paginate($count);

        if($request->has('search')) {
            $posts = Post::where('title', 'like', '%'.$request->search.'%')->orderByDesc('id')->paginate($count);
        }

        return view('cms.posts.index')->with('posts', $posts);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'content' => ['required'],
        ], [
            'title.required' => 'العنوان مطلوب',
            'content.required' => 'الوصف مطلوب'
        ]);

        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'image' => 'required|image|mimes:png,jpg,jpeg',
        //     'content' => ['required'],
        // ], [
        //     'title.required' => 'العنوان مطلوب',
        //     'content.required' => 'الوصف مطلوب'
        // ])->validate();

         $path = $request->file('image')->store('/', 'custom');
        // $imgname = $request->file('image')->getClientOriginalName();
        //  $path = $request->file('image')->move(public_path('images'), $imgname);

        // $path = $request->file('image')->store('uploads', 'public');
        // Save in Database
                $post = new Post();
                $post->title = $request->title;
                $post->slug = Str::slug($request->title);
                $post->image = $path;
                $post->content = $request->content;
                $post->user_id = 1;
                $post->save();
                return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('cms.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $path = $post->image;
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('/', 'custom');
        }
        // $path = $request->file('image')->move(public_path('images'), $imgname);

        $title = $this->removescript($request->title);
        $post->update([
            'title' => $title,
            'image' => $path,
            'content' => $this->removescript($request->content),
            'updated_by' => 1
        ]);

        // Redirect
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('admin.posts.index');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->orderByDesc('id')->paginate(10);
        return view('cms.posts.trash', compact('posts'));
    }

    public function restore(Post $post)
    {
        $post->restore();
        return redirect()->route('admin.posts.index');
        // $post->update(['deleted_at' => null]);
    }

    public function forcedelete(Post $post)
    {
        File::delete(public_path('uploads/'.$post->image));
        $post->forcedelete();
        return redirect()->route('admin.posts.index');
        // $post->update(['deleted_at' => null]);
    }

    private function removescript($input) {
        $input = str_replace('<script>', '', $input);
        return str_replace('</script>', '', $input);
    }
}
