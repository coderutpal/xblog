<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function addPost(Request $request)
    {
        $categories_html = '';
        $pcategories = ParentCategory::whereHas('children')->orderBy('name', 'asc')->get();
        $categories = Category::where('parent', 0)->orderBy('name', 'asc')->get();

        if ($pcategories->count() > 0) {
            foreach ($pcategories as $item) {
                $categories_html .= '<optgroup label="' . e($item->name) . '">';
                foreach ($item->children as $category) {
                    $categories_html .= '<option value="' . $category->id . '">' . e($category->name) . '</option>';
                }
                $categories_html .= '</optgroup>';
            }
        }

        if ($categories->count() > 0) {
            foreach ($categories as $item) {
                $categories_html .= '<option value="' . $item->id . '">' . e($item->name) . '</option>';
            }
        }

        $data = [
            'pageTitle'       => 'Add new post',
            'categories_html' => $categories_html
        ];

        return view('back.pages.add-post', $data);
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts,title',
            'content' => 'required',
            'category' => 'required|exists:categories,id',
            'featured_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        //Create post and show SweetAlert notification instead of Toaster Notification
        if ($request->hasFile('featured_image')) {
            $path = 'images/posts/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = uniqid() . '_' . $filename;

            //Upload featured image
            $upload = $file->move(public_path($path), $new_filename);

            if ($upload) {
                $post = new Post();
                $post->author_id = auth()->id();
                $post->category = $request->category;
                $post->title = $request->title;
                $post->content = $request->content;
                $post->featured_image = $new_filename;
                $post->tags = $request->tags;
                $post->meta_keywords = $request->meta_keywords;
                $post->meta_description = $request->meta_description;
                $post->visibility = $request->visibility;
                $saved = $post->save();

                if ($saved) {
                    return response()->json([
                        'status' => 1,
                        'msg' => 'New post has been successfully created'
                    ]);
                } else {
                    return response()->json([
                        'status' => 0,
                        'msg' => 'Something went wrong!'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Something went wrong when upolading featured image!'
                ]);
            }
        }
    }
}
