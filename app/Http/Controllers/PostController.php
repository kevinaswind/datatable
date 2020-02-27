<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        dd($post);
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        echo "Delete $post->uuid";
    }

    public function getPostData()
    {
        $query = Post::select('id', 'uuid', 'first_name', 'last_name', 'title', 'created_at');

        if (request('date_filter')) {
            $filter_date = now()->subDays(request('date_filter'))->toDateString();
            info($filter_date);
            $query->where('created_at', '>=', $filter_date);
        }

        return datatables($query)->toJson();

//        return dataTables(Post::select('id', 'uuid', 'first_name', 'last_name', 'title', 'created_at'))
//            ->setRowClass(function ($post) {
//                return $post->id % 2 == 0 ? 'alert-danger' : 'alert-info';
//            })
//            ->toJson();
    }
}
