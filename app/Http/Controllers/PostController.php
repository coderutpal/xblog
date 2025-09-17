<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Models\Category;
use App\Models\Post;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\File;

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
            'featured_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = public_path('images/posts/');
            $thumb_path = public_path('images/posts/thumbs/');
            $resized_path = public_path('images/posts/resized/');

            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = uniqid() . '_' . $filename;

            // ensure directories exist
            if (!File::isDirectory($path)) File::makeDirectory($path, 0777, true);
            if (!File::isDirectory($thumb_path)) File::makeDirectory($thumb_path, 0777, true);
            if (!File::isDirectory($resized_path)) File::makeDirectory($resized_path, 0777, true);

            // Upload original
            $file->move($path, $new_filename);

            /** Generate resized image and thumbnail start */

            // Thumbnail (250x250)
            Image::read($path . $new_filename)
                ->cover(250, 250)
                ->save($thumb_path . 'thumb_' . $new_filename);

            // Resized Image (512x320)
            Image::read($path . $new_filename)
                ->cover(512, 320)
                ->save($resized_path . 'resized_' . $new_filename);

            /** Generate resized image and thumbnail end */

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
        }
    }
}
