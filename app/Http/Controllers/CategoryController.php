<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('mdr.categories.categories', ['categories' => Category::all()]);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update',$category);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'name_en' => 'required|max:255',
            'name_kz' => 'required|max:255',
            'code' => 'required|max:5',
        ]);
        $category->update([
            'name' => $validated['name'],
            'name_en' => $validated['name_en'],
            'name_kz' => $validated['name_kz'],
            'code' => $validated['code'],
        ]);
        return redirect()->back()->with('status', (__('messages.updated')));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'name_en' => 'required|max:255',
            'name_kz' => 'required|max:255',
            'code' => 'required|max:5',
        ]);
        Category::create([
            'name' => $validated['name'],
            'name_en' => $validated['name_en'],
            'name_kz' => $validated['name_kz'],
            'code' => $validated['code'],
        ]);

        return redirect()->back()->with('status', (__('messages.created')));
    }

    public function delete(Request $request)
    {
        $valid = $request->validate([
            'cat_id' => 'required|exists:categories,id',
        ]);
        $category = Category::all()->where('id',$valid['cat_id'])->first();
        $this->authorize('delete',$category);
        $category->delete();
        return redirect()->back()->with('status', (__('messages.deleted')));
    }
}
