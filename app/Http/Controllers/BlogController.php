<?php

namespace App\Http\Controllers;

use App\models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('/blog/index', compact('blogs'));
    }

    /** 
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('blog/create');
    }


    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'image' => 'required',
        //     'title' => 'required',
        //     'content' => 'required',
        // ]);

        // $sendgambar = $request->image->getClientOriginalName().''. time().''. $request->image->extension();
        // $request->image->move(public_path('images'),$sendimage);
        // $blog = Blog::create([
        //     'image'=>$request['image'],
        //     'title'=>$request['title'],
        //     'content'=>$request['content']
        // ]);

        $this->validate($request, [
            'image'     => 'required|image|mimes:png,jpg,jpeg',
            'title'     => 'required',
            'content'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/blogs', $image->hashName());

        $blog = Blog::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        if($blog){
            //redirect dengan pesan sukses
            return redirect()->route('index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    /**
     * edit
     *
     * @param  mixed $blog
     * @return void
     */
    public function edit(Blog $blog)
    {
        $blog = Blog::where('id', $blog)->first();
        return view('blog/edit', compact('blog'));
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $blog
     * @return void
     */
    public function update(Request $request, Blog $blog)
    {
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->content = $request->content;
        if($request->image == ''){
            $blog->save();
            return redirect('index')->with('status','Data Berhasil Di Ubah');
        }
        else{
            $blog->image = $request->image;

            $blog->save();
            return redirect('index')->with('status','Data Berhasil Di Ubah');

        }
    }
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        Storage::disk('public')->delete('public/blogs/' . $blog->image);
        $blog->delete();

        if ($blog) {
            //redirect dengan pesan sukses
            return redirect()->route('index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
