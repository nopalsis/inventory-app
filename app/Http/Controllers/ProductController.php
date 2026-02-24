<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        $categories = Category::all();

        return view('admin.product.index', compact('products', 'categories'));
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
        $data = $request->validate([
            'name'         => 'required',
            'sku'          => 'nullable|unique:products,sku',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id'  => 'required',
            'stock'        => 'required|integer',
            'credit_price' => 'required|numeric',
            'cash_price'   => 'required|numeric',
        ]);
        // uploadfile
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('products', $filename, 'public');
            $data['gambar'] = $path;
        }


        Product::create($data);
        Alert::success('SUKSES', 'Data Berhasil dibuat', 'Type');
        return redirect('/product');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        Alert::success('Sukses', 'Data berhasil dihapus');
        return redirect('/product');
    }
}
