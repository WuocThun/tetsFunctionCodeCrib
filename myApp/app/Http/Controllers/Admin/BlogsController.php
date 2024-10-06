<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blogs::all();
        return view('admin.content.blogs.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data              = $request->validate([
            'title'       => 'required|max:255|unique:blogs',
            'slug'        => 'required',
            'content'     => 'required',
            'description' => 'required',
            'image'       => 'required',
        ],
            [
                'title.unique'         => 'Tên danh mục đã có',
                'title.required'       => 'Tên danh mục phải có',
                'description.required' => 'Mô tả đã tồn tại, hãy nhập mô tả',
                'image.required'       => 'Phải có hình ảnh',
            ]);
        $data              = $request->all();
        $blog              = new Blogs();
        $blog->title       = $data['title'];
        $blog->description = $data['description'];
        $blog->status      = $data['status'];
        $blog->user_id      = auth()->id();
        $blog->slug        = $data['slug'];
        $blog->content        = $data['content'];
        $get_image          = $request->image;
        $path               = 'uploads/blogs/';
        $get_name_image     = $get_image->getClientOriginalName();
        $name_image         = current(explode('.', $get_name_image));
        $new_image          = $name_image . rand(0, 99) . '.'
                              . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $blog->image = $new_image;
        $blog->save();

        $blog->created_at  = Carbon::now();
        return redirect()->route('admin.blogs.index')
                         ->with('status', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
