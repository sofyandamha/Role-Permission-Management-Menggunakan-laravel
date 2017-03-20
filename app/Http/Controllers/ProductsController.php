<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('id','DESC')->paginate(5);
        return view('Product.index',compact('products'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products',
            'model' => 'required',
            // not using `image` rule, as that will allow svg
            'photo' => 'mimes:jpeg,png|max:10240'
        ]);
		$data = $request->only('name', 'model');
		
		if ($request->hasFile('photo')) {
            $data['photo'] = $this->savePhoto($request->file('photo'));
        }

        $product = Product::create($data);
        $product->categories()->sync($request->get('category_lists'));

        //Product::create($request->all());

        return redirect()->route('Product.index')
                        ->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Product = Product::find($id);
        return view('Product.show',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Product = Product::find($id);
        return view('Product.edit',compact('products'));
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
        $this->validate($request, [
            'name' => 'required|unique:products,name,'. $product->id,
            'model' => 'required',
            'photo' => 'mimes:jpeg,png|max:10240'
        ]);
        $data = $request->only('name', 'model');

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->savePhoto($request->file('photo'));
            // I'm not deleting old photo, as stub image file is used by multiple product.
        }

        $product->update($data);
        if (count($request->get('category_lists')) > 0) {
            $product->categories()->sync($request->get('category_lists'));
        } else {
            // no category set, detach all
            $product->categories()->detach();
        }

        //Product::find($id)->update($request->all());

        return redirect()->route('Product.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('Product.index')
                        ->with('success','Product deleted successfully');
    }
}
