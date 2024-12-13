<?php

namespace App\Http\Controllers;

use App\Models\WeightCategory;
use Illuminate\Http\Request;

class WeightCategoryController extends Controller
{
    public function index()
    {
        $categories = WeightCategory::all();
        return view('masterdata.masterManage', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gender' => 'required|string',
            'name' => 'required|string',
            'weight_range' => 'required|string',
        ]);

        WeightCategory::create($request->all());

        return redirect()->back()->with('success', 'Kategori berat berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'weight_range' => 'required|string',
        ]);

        $category = WeightCategory::findOrFail($id);
        $category->update($request->all());

        return redirect()->back()->with('success', 'Kategori berat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = WeightCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berat berhasil dihapus.');
    }
}
