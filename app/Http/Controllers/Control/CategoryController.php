<?php

namespace App\Http\Controllers\Control;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::paginate(12);
        if ($request->has('search')) {
            $filterFields['search'] = $request->input('search');
            $categories = Category::where('name', 'LIKE', '%'.$request->input('search').'%')->paginate(1);
            $categories->appends($filterFields)->links();
        }
        return view('controls.category.index')
            ->withTitle('Categories')
            ->withCategories($categories);
    }

    public function add()
    {
        return view('controls.category.add')
            ->withTitle('Add New');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $data = [];
        $thumbnail = "";
        if (Input::hasFile('thumbnail')) {
            $image = Input::file('thumbnail');
            $destinationPath = public_path('/uploads/thumbnail');
            $thumbnail = date('Y-m-d-H-i-s') . '-' . $image->getClientOriginalName();
            $image->move($destinationPath, $thumbnail);
        }

        $banner = "";
        if (Input::hasFile('bannerImage')) {
            $image = Input::file('bannerImage');
            $destinationPath = public_path('/uploads/category');
            $banner = date('Y-m-d-H-i-s') . '-' . $image->getClientOriginalName();
            $image->move($destinationPath, $banner);
        }

        $data = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'bannerVideo' => $request->input('bannerVideo'),
            'position' => $request->input('position'),
            'metaTitle' => $request->input('metaTitle'),
            'metaDescription' => $request->input('metaDescription'),
            'metaKeyword' => $request->input('metaKeyword'),
            'status' => $request->input('status'),
        ];

        if ($thumbnail) {
            $data['thumbnail'] = $thumbnail;
        }

        if ($banner) {
            $data['bannerImage'] = $banner;
        }

        Category::insert([$data]);


        Session::flash('message', 'Item successfully added!');
        return redirect('/admin/category');
    }

    public function edit($id = 0)
    {
        if ($id) {
            $item = Category::where('id', $id)->first();
            return view('controls.category.edit')
                ->withItem($item)
                ->withTitle('Edit - ' . $item->name);
        }

    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $category = Category::where('id', $id)->first();

        $thumbnail = "";
        if (Input::hasFile('thumbnail')) {
            $image = Input::file('thumbnail');
            $destinationPath = public_path('/uploads/thumbnail');
            $thumbnail = date('Y-m-d-H-i-s') . '-' . $image->getClientOriginalName();
            $image->move($destinationPath, $thumbnail);
        }

        $banner = "";
        if (Input::hasFile('bannerImage')) {
            $image = Input::file('bannerImage');
            $destinationPath = public_path('/uploads/category');
            $banner = date('Y-m-d-H-i-s') . '-' . $image->getClientOriginalName();
            $image->move($destinationPath, $banner);
        }


        $data = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'bannerVideo' => $request->input('bannerVideo'),
            'position' => $request->input('position'),
            'metaTitle' => $request->input('metaTitle'),
            'metaDescription' => $request->input('metaDescription'),
            'metaKeyword' => $request->input('metaKeyword'),
            'status' => $request->input('status'),
        ];

        if($request->input('remove_banner') != ""){
            $filename = public_path('/uploads/category') . '/' . $category->bannerImage;
            if (File::exists($filename)) {
                File::delete($filename);
            }
            $data['bannerImage'] = null;
        }

        if($request->input('remove_thumbnail') != ""){
            $filename = public_path('/uploads/thumbnail') . '/' . $category->thumbnail;
            if (File::exists($filename)) {
                File::delete($filename);
            }
            $data['thumbnail'] = null;
        }

        if ($thumbnail) {
            $filename = public_path('/uploads/thumbnail') . '/' . $category->thumbnail;
            if (File::exists($filename)) {
                File::delete($filename);
            }
            $data['thumbnail'] = $thumbnail;
        }

        if ($banner) {
            $filename = public_path('/uploads/category') . '/' . $category->bannerImage;
            if (File::exists($filename)) {
                File::delete($filename);
            }
            $data['bannerImage'] = $banner;
        }




        Category::where('id', $id)->update($data);
        Session::flash('message', 'Item successfully updated!');
        return redirect()->back();
    }


    public function delete($id){
        if($id > 0){
            Category::destroy($id);
            Session::flash('message', 'Item successfully deleted!');
        }
        return redirect()->back();

    }

}
