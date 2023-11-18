<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
        $query = Item::query();

        return DataTables::of($query)
        ->editColumn('thumbnail', function($item){
            return '<img src="' . $item->thumbnail . '" alt="Thumbnail" class="w-20 mx-auto rounded-md">';
        })
            ->addColumn('action', function ($item) {
                return '
                    <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('admin.item.edit', $item->id) . '">
                        Edit
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.item.destroy', $item->id) . '" method="POST">
                    <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Delete
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>';
            })
            ->addColumn('type.name', function ($item) {
                return $item->type ? $item->type->name : '';
            })
            ->addColumn('brand.name', function ($item) {
                return $item->brand ? $item->brand->name : '';
            })
            ->rawColumns(['action', 'thumbnail'])
            ->make();
    }

    return view('admin.item.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $types = Type::all();

        return view('admin.item.create', compact('types', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // Upload multiple photos
        if($request->hasFile('photos')){
            $photos = [];

            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('assets/item', 'public');

                // Push To Array
                array_push($photos, $photoPath);
            }

            $data['photos'] = json_encode($photos);
        }

        Item::create($data);

        return redirect(route('admin.item.index'));
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
        $item = Item::findOrFail($id);
        $brands = Brand::all();
        $types = Type::all();

        return view('admin.item.edit', compact('types', 'brands', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $data = $request->all();

        // Upload multiple photos
        if($request->hasFile('photos')){
            $photos = [];

            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('assets/item', 'public');

                // Push To Array
                array_push($photos, $photoPath);
            }

            $data['photos'] = json_encode($photos);
        }

        $item->update($data);

        return redirect(route('admin.item.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
