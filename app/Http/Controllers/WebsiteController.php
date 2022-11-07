<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::orderBy('name', 'ASC')
            ->where('status', 1)
            ->get();
        $data['category']   = $category;
        $data['banner']     = Banner::where('status', 1)->get();
        $data['total_show'] = 10;
        $data['product']    = Product::query()
            ->join('categories as c', 'c.id', 'products.category_id')
            ->where('products.status', 1);
        if ($request->category == '') {
            $data['product'] = $data['product']->where('c.name', $category[0]->name);
        } else {
            $data['product'] = $data['product']->where('c.name', $request->category);
        }
        if ($request->product != '') {
            $data['product'] = $data['product']->where('products.name', 'LIKE', "%{$request->product}%");
        }
        $data['product'] = $data['product']->orderBy('products.name', 'ASC')
            ->select('products.*', 'c.name as category_name')
            ->take($data['total_show'])
            ->get();
        if (count($data['product']) < $data['total_show']) {
            $data['more']   = false;
        } else {
            $data['more']   = true;
        }
        return view('frontend.home', compact('data'));
    }
    public function more(Request $request)
    {
        $product = Product::query()
            ->join('categories as c', 'c.id', 'products.category_id')
            ->where('products.status', 1);

        if ($request->product == '') {
            $product = $product->where('c.name', $request->category_name);
        } else {
            $product = $product->where('products.name', 'LIKE', "%{$request->product}%");
        }
        $product = $product->orderBy('products.name', 'ASC')
            ->select('products.*', 'c.name as category_name')
            ->take($request->end)
            ->get();

        $data = [];
        foreach ($product as $key => $value) {
            if ($key < $request->start) {
                continue;
            } else {
                $data[] = $value;
            }
        }
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
