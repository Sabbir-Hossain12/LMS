<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors= User::role(['admin','teacher'])->where('status',1)->get();
        return view('backend.pages.website.blog',compact('authors'));
    }


    public function getData()
    {
        $blogs = Blog::all();


        return DataTables::of($blogs)
            ->addColumn('status', function ($blog) {
//                if(Auth::user()->can('Status Testimonial')) {
                if ($blog->status == 1) {
                    return ' <a class="status" id="testimonialStatus" href="javascript:void(0)"
                                               data-id="'.$blog->id.'" data-status="'.$blog->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                } else {
                    return '<a class="status" id="testimonialStatus" href="javascript:void(0)"
                                               data-id="'.$blog->id.'" data-status="'.$blog->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';
                }
//                }

            })
            ->addColumn('action', function ($blog) {
                $editAction = '';
                $deleteAction = '';

//                if(Auth::user()->can('Edit Testimonial')) {

                $editAction = '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
                                    data-id="'.$blog->id.'" data-bs-toggle="modal" data-bs-target="#editTestimonialFormModal">
                                    <i class="fas fa-edit"></i></a>';

//                }

//                if(Auth::user()->can('Delete Testimonial')) {

                $deleteAction = '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                    data-id="'.$blog->id.'" id="deleteTestimonialBtn""> 
                                    <i class="fas fa-trash"></i></a>';

//                }

                return '<div class="d-flex gap-3"> '.$editAction.$deleteAction.'</div>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'main_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'thumbnail_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $blog = new Blog();

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title).uniqid() ;
        $blog->author_id = $request->author_id;
        $blog->short_desc = $request->short_desc;
        $blog->desc = $request->desc;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->user_id = auth()->user()->id;


        if ($request->hasFile('main_img')) {
            $file = $request->file('main_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/blogs/'), $filename);
            $blog->main_img = 'backend/upload/blogs/'.$filename;
        }

        if ($request->hasFile('thumbnail_img')) {
            $file = $request->file('thumbnail_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/blogs/'), $filename);
            $blog->thumbnail_img = 'backend/upload/blogs/'.$filename;
        }
        
        if ($request->hasFile('meta_img')) {
            $file = $request->file('meta_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/blogs/'), $filename);
            $blog->meta_img = 'backend/upload/blogs/'.$filename;
            
        }

        $save = $blog->save();

        if ($save) {
            return response()->json(['status' => 'success', 'message' => 'Blog added successfully'], 200);
        }
        return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
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
        $blog = Blog::find($id);

        if ($blog) {
            return response()->json(['status' => 'success', 'data' => $blog], 200);
        }

        return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'string',
            'main_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'thumbnail_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->desc = $request->desc;
        $blog->author_id = $request->author_id;
        $blog->short_desc = $request->short_desc;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;


        if ($request->hasFile('main_img')) {
            if ($blog->main_img && file_exists(public_path($blog->main_img))) {
                unlink(public_path($blog->main_img));
            }
            $file = $request->file('main_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/blogs/'), $filename);
            $blog->main_img = 'backend/upload/blogs/'.$filename;
        }

        if ($request->hasFile('thumbnail_img')) {
            if ($blog->thumbnail_img && file_exists(public_path($blog->thumbnail_img))) {
                unlink(public_path($blog->thumbnail_img));
            }

            $file = $request->file('thumbnail_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/blogs/'), $filename);
            $blog->thumbnail_img = 'backend/upload/blogs/'.$filename;
        }
        
        if ($request->hasFile('meta_img')) {
            if ($blog->meta_img && file_exists(public_path($blog->meta_img))) {
                unlink(public_path($blog->meta_img));
            }
            $file = $request->file('meta_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/blogs/'), $filename);
            $blog->meta_img = 'backend/upload/blogs/'.$filename;
            
        }

        $save = $blog->save();

        if ($save) {
            return response()->json(['status' => 'success', 'message' => 'Blog updated successfully'], 200);
        }
        return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);

        if ($blog->main_img && file_exists(public_path($blog->main_img))) {
            unlink(public_path($blog->main_img));
        }

        if ($blog->thumbnail_img && file_exists(public_path($blog->thumbnail_img))) {
            unlink(public_path($blog->thumbnail_img));
        }

        $delete = $blog->delete();

        if ($delete) {
            return response()->json(['status' => 'success', 'message' => 'Blog deleted successfully'], 200);
        }
        return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
    }


    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;


        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = Blog::findOrFail($id);
        $page->status = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }


    //    Upload in CkEditor
    public function uploadCkeditorImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('backend/upload/blogs/ckeditor/'), $fileName);
        }

        return response()->json([
            'url' => asset('backend/upload/blogs/ckeditor/'.$fileName), 'fileName' => $fileName,
            'uploaded' => 1
        ]);
    }

}
