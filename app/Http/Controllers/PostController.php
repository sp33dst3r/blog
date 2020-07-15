<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
class PostController extends Controller
{
    public $validator = [
        'name' => 'required|max:255',
        'content' => 'required',
        'file' => 'required|max:2048'
    ];
    public function create(Request $request)
    {

        if ($request->isMethod('post')) {
            //dd($request->file);


            $validatedData = $request->validate($this->validator);


            $path = $request->file->store('files');

            $category = Category::where(['id'=>$request->category_id])->firstOrFail();

            $post = new Post();
            $post->name = $request->name;
            $post->content = $request->content;
            $post->file = $path;
            $post->category()->associate($category);
            $post->save();
            return redirect('/categories/view/'.$request->category_id)->with('status', 'Created!');
        }

        return view('post.create', array("category_id"=>$request->category_id));

    }

    public function edit(Request $request)
    {


        $post = Post::find($request->id);

        $oldfile = \Storage::url("app/".$post->file);

        if ($request->isMethod('post')) {
            $path = '';
            if ($request->hasFile('file')) {
                //

               \Storage::delete($post->file);

               //sdd($val);
                $path = $request->file->store('files');
            }else{
                unset($this->validator['file']);
            }



            $validatedData = $request->validate($this->validator);




            $post->name = $request->name;
            $post->content = $request->content;
            if($path) $post->file = $path;
            $post->save();
            return redirect('/categories/view/'.$request->category_id)->with('status', 'OK!');
        }



        return view('post.create', array("category_id"=>$request->category_id, "post"=>$post, "file"=>$oldfile));

    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $post = Post::find($id);
        if($post){
            foreach($post->comments as $comment){
                $comment->delete();

            }
            \Storage::delete($post->file);
            $post->delete();
        }
        return redirect('/categories/view/'.$request->category_id);

    }

    public function view(Request $request)
    {
        $post = Post::find($request->id);

        $oldfile = \Storage::url("app/".$post->file);
        return view('post.view', array("post"=>$post, "file"=>$oldfile));

    }
}
