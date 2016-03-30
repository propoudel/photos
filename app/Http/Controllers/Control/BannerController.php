<?php

namespace App\Http\Controllers\Control;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::paginate(12);
        if ($request->has('search')) {
            $filterFields['search'] = $request->input('search');
            $banners = Banner::where('title', 'LIKE', '%'.$request->input('search').'%')->paginate(1);
            $banners->appends($filterFields)->links();
        }
        return view('controls.banner.index')
            ->withTitle('Banners')
            ->withBanners($banners);
    }

    public function add()
    {
        return view('controls.banner.add')
            ->withTitle('Add New');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|max:255',
        ]);

        $data = [];
        $banner = "";
        if (Input::hasFile('image')) {
            $image = Input::file('image');
            $destinationPath = public_path('/uploads/banner');
            $banner = date('Y-m-d-H-i-s') . '-' . $image->getClientOriginalName();
            $image->move($destinationPath, $banner);
        }

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'position' => $request->input('position'),
            'status' => $request->input('status'),
        ];

        if ($banner) {
            $data['image'] = $banner;
        }

        Banner::insert([$data]);

        Session::flash('message', 'Item successfully added!');
        return redirect('/admin/banner');
    }

    public function edit($id = 0)
    {
        if ($id) {
            $item = Banner::where('id', $id)->first();
            return view('controls.banner.edit')
                ->withItem($item)
                ->withTitle('Edit - ' . $item->title);
        }

    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
        ]);

        $item = Banner::where('id', $id)->first();

        $banner = "";
        if (Input::hasFile('image')) {
            $image = Input::file('image');
            $destinationPath = public_path('/uploads/banner');
            $banner = date('Y-m-d-H-i-s') . '-' . $image->getClientOriginalName();
            $image->move($destinationPath, $banner);
        }


        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'position' => $request->input('position'),
            'status' => $request->input('status'),
        ];

        if($request->input('remove_banner') != ""){
            $filename = public_path('/uploads/banner') . '/' . $item->image;
            if (File::exists($filename)) {
                File::delete($filename);
            }
            $data['image'] = null;
        }



        if ($banner) {
            $filename = public_path('/uploads/banner') . '/' . $item->image;
            if (File::exists($filename)) {
                File::delete($filename);
            }
            $data['image'] = $banner;
        }

        Banner::where('id', $id)->update($data);
        Session::flash('message', 'Item successfully updated!');
        return redirect()->back();
    }


    public function delete($id){
        if($id > 0){
            $item = Banner::where('id', $id)->first();
            $filename = public_path('/uploads/banner') . '/' . $item->image;
            if (File::exists($filename)) {
                File::delete($filename);
            }
            Banner::destroy($id);
            Session::flash('message', 'Item successfully deleted!');
        }
        return redirect()->back();

    }
}
