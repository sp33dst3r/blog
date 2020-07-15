<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Validator;
class CommentController extends Controller
{

    public $validator = [
        'author' => 'required|regex:/[A-ZА-Яa-zа-я]+ [A-ZА-Яa-zа-я]+/',
        'content' => 'required',
    ];

    public function create(Request $request)
    {
        $resp = [];
        $validator = Validator::make($request->all(), $this->validator);

        if ($validator->fails()) {
            $errorsCollection = $validator->errors();
                $errors = [];
                foreach($errorsCollection->all() as $error){
                    array_push($errors, $error);
                }
                $resp["status"] = "error";
                $resp['errors'] = $errors;
                return response()->json($resp);
        }

        $author =  mb_convert_case(mb_strtolower($request->author), MB_CASE_TITLE, "UTF-8");
        if(isset($request->category_id)){
            $entity = Category::find($request->category_id);
        }
        else if(isset($request->post_id)){
            $entity = Post::find($request->post_id);
        }

        else{
            die("dddd");
            $resp["status"] = "error";
            $resp['errors'] = ["Something's wrong"];
            return response()->json($resp);
        }
        if($entity){
            $comment = new Comment();
            $comment->author = $author;
            $comment->content = $request->content;
            $entity->comments()->save($comment);


            $resp["status"] = "ok";
            $resp["author"] = $author;

            return json_encode($resp);
        }else{
            $resp["status"] = "error";
                $resp['errors'] = ["Something's wrong"];
                return response()->json($resp);
        }


    }

}
