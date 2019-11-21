<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryFormRequest;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        return view('admin.subcategories.index')->withCategory($category)->withSubcategories($category->subcategories()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('admin.subcategories.add')->withCategory($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request, Category $category)
    {
        $request->merge(['slug' => str_slug(request('name'))]);
        $category->subcategories()->create($request->all());
        return redirect()->route('subcategories.index', $category)->with('status', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.subcategories.show')->withSubcategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @param  \App\Category  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Category $subcategory)
    {   
        return view('admin.subcategories.edit')->withCategory($category)->withSubcategory($subcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, Category $category, Category $subcategory)
    {
        $request->merge(['slug' => str_slug(request('name'))]);
        $subcategory->update($request->all());
        return redirect()->route('subcategories.index', $category)->with('status', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Category $subcategory)
    {
        $subcategory->delete();
        return redirect()->back()->with('status', 'Category Deleted Successfully');
    }
}
