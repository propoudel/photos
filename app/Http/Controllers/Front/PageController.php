<?php

namespace App\Http\Controllers\Front;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '1')->limit(8)->get();
        $banner = Banner::where('status', '1')->first();
        return view('front.pages.index')
            ->withTitle('Categories')
            ->withBanner($banner)
            ->withCategories($categories);
    }

    public function search(Request $request)
    {
        $term = $request->input('q');
        $items = [];

        if ($request->has('q')) {
            $per_page = Session::get('per_page') ? Session::get('per_page') : 12;
            $items = Item::whereHas('Category', function ($query) use ($term) {
                $query->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('description', 'LIKE', '%' . $term . '%');
            })
                ->orWhere('name', 'LIKE', '%' . $term . '%')
                ->orWhere('description', 'LIKE', '%' . $term . '%')
                ->paginate($per_page);
        }
        $items->appends($request->only('q'))->links();

        return view('front.pages.search')
            ->with('items', $items);
    }

    public function setPerPage(Request $request)
    {
        $per_page = $request->input('per_page');
        Session::set('per_page', $per_page);
        return redirect()->back();
    }


    public function category($slug)
    {
        if (!$slug) {
            return redirect()->back();
        }
        $category = Category::where('slug', $slug)->first();
        if (!$category->id)
            return redirect()->back();
        $items = Item::where('category_id', $category->id)->paginate(20);
        return view('front.pages.category')
            ->withCategory($category)
            ->withItems($items);

    }

    public function item($id)
    {
        if (!$id) {
            return redirect()->back();
        }

        $item = Item::where('id', $id)->first();
        return view('front.pages.item')
            ->withItem($item);
    }

}
