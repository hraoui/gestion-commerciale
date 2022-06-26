<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use \Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(25);

        return view('inventory.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categories = Category::all();

        return view('inventory.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'barcode' => 'required',
            'description' => 'required',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required',
            'price' => 'required|numeric|min:0',
            'photo' => 'required',

        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->photo = $request->photo;

        $product->save();


        return view('inventory.products',compact('qrcode'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('inventory.products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
    return view('inventory.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'name' => 'required',
            'barcode' => 'required',
            'description' => 'required',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required',
            'price' => 'required|numeric|min:0',
            'photo' => 'required',

        ]);
        Product::whereId($id)->update($updateData);
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $product = Product::findOrFail($id);
       $product->delete();
        return redirect('/products');;
    }







}
