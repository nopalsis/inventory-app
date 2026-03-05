<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProductStatement;
use Illuminate\Support\Facades\DB;

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
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'         => 'required',
            'sku'          => 'nullable|unique:products,sku,' . $id,
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id'  => 'required',
            'stock'        => 'required|integer',
            'credit_price' => 'required|numeric',
            'cash_price'   => 'required|numeric',
        ]);

        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($product->gambar && Storage::exists($product->gambar)) {
                Storage::delete($product->gambar);
            }

            // simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }


        $product->update($data);

        Alert::success('Sukses', 'Data berhasil diupdate');

        return redirect('/product');
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

    public function updateStock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount'     => 'required|integer|min:1',
            'type'       => 'required|in:in,out',
        ]);

        DB::transaction(function () use ($request) {

            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            if ($request->type == 'out' && $product->stock < $request->amount) {
                throw new \Exception('Stock tidak cukup');
            }

            ProductStatement::create([
                'product_id' => $product->id,
                'amount'     => $request->amount,
                'type'       => $request->type,
                'note'       => $request->note,
            ]);

            if ($request->type == 'in') {
                $product->increment('stock', $request->amount);
            } else {
                $product->decrement('stock', $request->amount);
            }
        });

        Alert::success('Sukses', 'Stock berhasil diupdate');

        return redirect('/product');
    }
}
