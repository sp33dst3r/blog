<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //

    public $validator = [
        'name' => 'required|max:255',
        'description' => 'required',
    ];

    public function index()
    {
        //cat list
        $categories = Category::all();

        return view('category.list', array("categories"=>$categories));
    }
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validatedData = $request->validate($this->validator);
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return redirect('categories')->with('status', 'OK!');
        }


        return view('category.create', []);

    }
    public function view(Request $request)
    {

        $category = Category::find($request->id);

        return view('category.view', array("category"=>$category));
    }
    public function edit(Request $request)
    {
        $category = Category::find($request->id);
        if ($request->isMethod('post')) {
            $validatedData = $request->validate($this->validator);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return redirect('categories')->with('status', 'OK!');
        }

        if(!$category)  return redirect('categories')->with('status', 'Not found');

        return view('category.create', array("category"=>$category));

    }

    public function delete(Request $request){
        $id = $request->id;
        $category = Category::find($id);
        if($category){
            foreach($category->comments as $comment){
                $comment->delete();
            }
            foreach($category->posts as $post){
                foreach($post->comments as $comment){
                    $comment->delete();
                }
                \Storage::delete($post->file);
                $post->delete();
            }
            $category->delete();
        }
        return redirect('categories');

    }
}
