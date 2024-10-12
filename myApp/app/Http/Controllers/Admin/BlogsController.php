<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\withMiddleware;

class BlogsController extends Controller implements HasMiddleware
{

    public static function middleware(): array

    {
        return [
            'auth',
            new Middleware('permission:add blogs|edit blogs|delete blogs|publish blogs',
                ['only' => ['index', 'show']]),
//            only: ['index','show']),
            new Middleware('permission:add blogs',
                ['only' => ['create', 'store']]),
            new Middleware('permission:edit blogs',
                ['only' => ['edit', 'update']]),
            new Middleware('permission:delete blogs', ['only' => ['destroy']]),
        ];
    }
    public function preview_blogs(string $id)
    {
        $blog = Blogs::find($id);
//        dd($blog);
        return view('admin.content.blogs.preview_blogs',compact('blog'));
    }
    public function get_pending_blogs()
    {
        $blog = Blogs::where('status','=','2')->get();
        return view('admin.content.blogs.peding_blogs',compact('blog'));
    }


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
        $blog->user_id     = auth()->id();
        $blog->slug        = $data['slug'];
        $blog->content     = $data['content'];
        $get_image         = $request->image;
        $path              = 'uploads/blogs/';
        $get_name_image    = $get_image->getClientOriginalName();
        $name_image        = current(explode('.', $get_name_image));
        $new_image         = $name_image . rand(0, 99) . '.'
                             . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $blog->image = $new_image;
        $blog->save();

        $blog->created_at = Carbon::now();

        return redirect()->route('admin.blogs.myblogs')
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
        $blog = Blogs::find($id);
        return view('admin.content.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data              = $request->validate([
            'title'       => 'required|max:255',
            'slug'        => 'required',
            'content'     => 'required',
            'description' => 'required',
        ],
            [
                'description.required' => 'Mô tả đã tồn tại, hãy nhập mô tả',
            ]);
        $data = $request->all();
        $blog = Blogs::find($id);
        $blog->title = $data['title'];
        $blog->description = $data['description'];
        $blog->status = $data['status'];
        $blog->slug = $data['slug'];
        $blog->content = $data['content'];
        $get_image = $request->image;
        if ($get_image) {
            $path_unlink = 'uploads/blogs/' . $blog->image;
            if (file_exists($path_unlink)) {
                unlink($path_unlink);
            }
            $path           = 'uploads/blogs/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image     = current(explode('.', $get_name_image));
            $new_image      = $name_image . rand(0, 99) . '.'
                              . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $blog->image = $new_image;
        }
        $blog->save();
        return redirect()->back()->with('status', 'Cập nhật thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog        = Blogs::find($id);
        $path_unlink = 'uploads/blogs/' . $blog->image;
        if (file_exists($path_unlink)) {
            unlink($path_unlink);
        }
        $blog->delete();

        return redirect()->back();
    }
    public function myblogs()
    {
        $user_id = auth()->id();
        $blog = Blogs::where('user_id', $user_id)->get();
        return view('admin.content.blogs.myblogs',compact('blog'));
    }
}
