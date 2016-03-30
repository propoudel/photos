<?php

namespace App\Http\Controllers\Control;

use App\Models\Category;
use App\Models\Color;
use App\Models\FileType;
use App\Models\Item;
use App\Models\ItemFile;
use App\Models\MediaType;
use App\Models\Orientation;
use App\Models\Price;
use App\Models\Publisher;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::paginate(12);
        if ($request->has('search')) {
            $filterFields['search'] = $request->input('search');
            $items = Item::where('name', 'LIKE', '%' . $request->input('search') . '%')->paginate(1);
            $items->appends($filterFields)->links();
        }
        return view('controls.item.index')
            ->withTitle('Items')
            ->withItems($items);
    }

    public function add()
    {
        $size = Size::where('status', '1')->get();
        $categories = Category::where('status', '1')->get();
        $colors = Color::where('status', 1)->get();
        $filetypes = FileType::where('status', '1')->get();
        $mediatypes = MediaType::where('status', '1')->get();
        $orientations = Orientation::where('status', '1')->get();
        $publishers = Publisher::where('status', '1')->get();
        return view('controls.item.add')
            ->withCategories($categories)
            ->withSize($size)
            ->withColors($colors)
            ->withFiletypes($filetypes)
            ->withMediatypes($mediatypes)
            ->withOrientations($orientations)
            ->withPublishers($publishers)
            ->withTitle('Add New');
    }


    public function store(Request $request)
    {
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

        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->publisher_id = $request->input('publisher');
        $item->category_id = $request->input('category');
        $item->color_id = $request->input('color');
        $item->file_type_id = $request->input('file_type');
        $item->media_type_id = $request->input('media_type');
        $item->orientation_id = $request->input('orientation');
        $item->metaTitle = $request->input('metaTitle');
        $item->metaDescription = $request->input('metaDescription');
        $item->metaKeyword = $request->input('metaKeyword');
        $item->status = $request->input('status');
        if ($thumbnail) {
            $item->thumbnail = $thumbnail;
        }
        $item->save();
        $id = $item->id;

        //Save file
        $files = Input::file('file');
        foreach ($files as $kye => $file) {
            $rules = array('file' => 'required');
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = 'uploads/meroitem';
                $filename = $id . '-' . $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $fileObj = new ItemFile();
                $fileObj->name = $filename;
                $fileObj->location = $destinationPath;
                $fileObj->item_id = $id;
                $fileObj->save();
                $fileId = $fileObj->id;
                //Save price
                $this->savePrice($id, $fileId, $request->input('size')[$kye], $request->input('price')[$kye]);
            }
        }

        Session::flash('message', 'Item successfully added!');
        return redirect('/admin/item');
    }


    public function savePrice($item_id, $file_id, $size, $price)
    {
        $priceObj = new Price();
        $priceObj->item_id = $item_id;
        $priceObj->file_id = $file_id;
        $priceObj->price = $price;
        $priceObj->size_id = $size;
        $priceObj->save();
        $id = $priceObj->id;
        return $id;
    }


    public function edit($id)
    {
        if ($id) {
            $item = Item::where('id', $id)->first();
            $price = Price::where('item_id', $id)->get();
            $size = Size::where('status', '1')->get();
            $categories = Category::where('status', '1')->get();
            $colors = Color::where('status', 1)->get();
            $filetypes = FileType::where('status', '1')->get();
            $mediatypes = MediaType::where('status', '1')->get();
            $orientations = Orientation::where('status', '1')->get();
            $publishers = Publisher::where('status', '1')->get();


            return view('controls.item.edit')
                ->withProduct($item)
                ->withPrice($price)
                ->withCategories($categories)
                ->withSize($size)
                ->withColors($colors)
                ->withFiletypes($filetypes)
                ->withMediatypes($mediatypes)
                ->withOrientations($orientations)
                ->withPublishers($publishers)
                ->withTitle('Edit - ' . $item->name);
        }
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $product = Item::where('id', $id)->first();

        $data = [];
        $thumbnail = "";
        if (Input::hasFile('thumbnail')) {
            $filename = public_path('/uploads/thumbnail') . '/' . $product->thumbnail;
            if (File::exists($filename)) {
                File::delete($filename);
            }

            $image = Input::file('thumbnail');
            $destinationPath = public_path('/uploads/thumbnail');
            $thumbnail = date('Y-m-d-H-i-s') . '-' . $image->getClientOriginalName();
            $image->move($destinationPath, $thumbnail);
        }

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'publisher_id' => $request->input('publisher'),
            'category_id' => $request->input('category'),
            'color_id' => $request->input('color'),
            'file_type_id' => $request->input('file_type'),
            'media_type_id' => $request->input('media_type'),
            'orientation_id' => $request->input('orientation'),
            'metaTitle' => $request->input('metaTitle'),
            'metaDescription' => $request->input('metaDescription'),
            'metaKeyword' => $request->input('metaKeyword'),
            'status' => $request->input('status'),
        ];

        if ($thumbnail) {
            $data['thumbnail'] = $thumbnail;
        }

        //Save file
        $files = Input::file('file');
        if (!empty($files)) {
            foreach ($files as $kye => $file) {
                $rules = array('file' => 'required');
                $validator = Validator::make(array('file' => $file), $rules);
                if ($validator->passes()) {
                    $destinationPath = 'uploads/meroitem';
                    $filename = $id . '-' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);
                    $fileObj = new ItemFile();
                    $fileObj->name = $filename;
                    $fileObj->location = $destinationPath;
                    $fileObj->item_id = $id;
                    $fileObj->save();
                    $fileId = $fileObj->id;
                    //Save price
                    $this->savePrice($id, $fileId, $request->input('size')[$kye], $request->input('price')[$kye]);
                }
            }
        }

        if (!empty($request->input('remove_me'))) {
            foreach ($request->input('remove_me') as $key => $value) {
                $price = Price::where('id', $key)->first();
                $file = ItemFile::where('id', $price->file_id)->first();
                $filename = public_path('/uploads/meroitem') . '/' . $file->name;

                if (File::exists($filename)) {
                    File::delete($filename);
                }

                ItemFile::destroy($price->file_id);
                Price::destroy($key);


            }
        }


        Item::where('id', $id)->update($data);
        Session::flash('message', 'Item successfully updated!');
        return redirect()->back();
    }


    public function delete($id)
    {
        if ($id > 0) {
            $product = Item::where('id', $id)->first();
            $price = Price::where('item_id', $product->id)->get();
            if (!empty($price)) {
                foreach ($price as $item) {
                    Price::destroy($item->id);
                    $file = ItemFile::where('id', $item->file_id)->first();
                    $filename = public_path('/uploads/meroitem') . '/' . $file->name;
                    if (File::exists($filename)) {
                        File::delete($filename);
                    }
                    ItemFile::destroy($item->file_id);
                }
            }

            $filename = public_path('/uploads/thumbnail') . '/' . $product->thumbnail;
            if (File::exists($filename)) {
                File::delete($filename);
            }

            Item::destroy($id);
            Session::flash('message', 'Item successfully deleted!');
        }
        return redirect()->back();

    }


}
