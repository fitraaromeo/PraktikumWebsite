<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);

        return new CategoryResource(true, 'List Data Category', $categories);
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create([
            'category_name' => $request->category_name
        ]);

        return new CategoryResource(true, 'Data Category Berhasil di tambahkan!', $category);
    }

    /**
     * show
     * 
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $category = Category::find($id);

        return new CategoryResource(true, 'Detail Data Category!', $category);
    }

    /**
     * update
     * 
     * @param mixed $request
     * @param mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category =  Category::find($id);

        $category->update([
            'category_name' => $request->category_name
        ]);

        return new CategoryResource(true, 'Data Category Berhasil di Ubah', $category);
    }

    /**
     * destroy
     * 
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return new CategoryResource(true, 'Category berhasil di hapus!', null);
    }
}
