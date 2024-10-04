<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BlogController extends Controller
{
    public function store(Request $req)
  {

    $validator = Validator::make($req->all(), [
      'title' => 'required|min:3',
      'content' => 'required|min:50'
    ]);
    if ($validator->fails()) {
        return response()->json([
          'status' => 422,
          'message' => $validator->messages()
        ], 422);
      } else {
        $blog = new Blog();
        $blog->title = $req->title;
        $blog->content = $req->content;
        $blog->author = $req->author;
        $blog->save();
      }
      return response()->json([
        'status' => 200,
        'message' => 'Blog created successfully'
      ], 200);
}
public function show($id)
    {
        $blog = Blog::find($id);
        return response()->json([
            'status_code' => 200,
            'data' => $blog,
        ], 200);
    }

    public function index()
    {
        $blog = Blog::get();
        return response()->json([
            'status_code' => 200,
            'data' => $blog,
        ], 200);
    }
    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);
        if (($validator->fails())) {
            return response()->json([
                'status_code' => 422,
                'message' => $validator->messages()
            ], 422);
        }
        $blog = Blog::find($id);
        if($blog){
            $blog->title = $req->title;
            $blog->content = $req->content;
            $blog->author = $req->author;
            $blog->save();
            return response()->json([
                'status' => 200,
                'message' => 'Blog updated successfully'
              ], 200);
        }
        else {
            return response()->json([
                'status' => 422,
                'message' => 'Id not found'
            ], 422);
        }
    }
    public function destroy($id)
    {

        $blog = Blog::find($id);
        $blog->delete();
        if ($blog) {
            return response()->json([
                'status_code' => 200,
                'message' => 'Blog deleted successfully!...'
            ]);
        } else {
            return response()->json([
                'status_code' => 422,
                'message' => 'Id not found'
            ], 422);
        }
    }
}
