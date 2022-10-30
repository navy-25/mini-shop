<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set('Asia/Jakarta');

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $page['title'] = 'Kategori';
        $data = Category::query();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_data', function ($row) {
                    return statusCategory($row->status);
                })
                ->addColumn('opsi', function ($row) {
                    $btn    = [];
                    $btn[]  = '<div class="d-flex">';

                    $url    = route('admin.category.update', ['id' => $row->id]);
                    $btn[]  = '<button onclick="editData(this,`' . $url . '`)"
                        data-bs-toggle="modal" data-bs-target="#modalForm"
                        class="btn btn-danger btn-sm me-2"
                        type="button" style="font-size:8px !important">Edit</button>';

                    $title  = 'Yakin hapus ' . $row->name . '?';
                    $url    = route('admin.category.destroy', ['id' => $row->id]);
                    $btn[]  = '<button onclick="alertNotif(`' . $title . '`,`' . $url . '`)" class="btn btn-secondary btn-sm" type="button" style="font-size:8px !important">Hapus</button>';

                    $btn[]  = '</div>';
                    return join("", $btn);
                })->addColumn('thumbnail_image', function ($row) {
                    if ($row->thumbnail == null) {
                        $image =  '<img width="100px" style="aspect-ratio:3/1 !important" class="" src="' . asset('app-assets/image/default-3-1.png') . '" alt="default thumbnail">';
                    } else {
                        $image =  '<img width="100px" style="aspect-ratio:3/1 !important" class="" src="' . route('storage.categoryThumbnail', ['filename' => $row->thumbnail]) .  '" alt="' . $row->thumbnail . '">';
                    }
                    return $image;
                })->addColumn('created_at', function ($row) {
                    return dateFormat($row->created_at);
                })
                ->rawColumns(['opsi', 'thumbnail_image'])
                ->make(true);
        }
        return view('backend.category', compact('page'));
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
        $this->validate(
            $request,
            [
                'name'      => 'required',
                'status'    => 'required',
            ],
            [
                'required'  => ':attribute belum di isi',
            ],
            [
                'name'      => 'nama kategori',
                'status'    => 'status kategori',
            ]
        );
        try {
            $data = Category::create([
                'name' => $request->name,
                'status' => $request->status
            ]);
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $request->validate([
                    'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
                ]);
                // PUT TO LOCAL IMAGE
                $filename       = date('dmyHis') . '_thumbnail' . '.' . $file->getClientOriginalExtension();
                $path           = config('constants.path.storage.category.thumbnail');

                // image 4x3
                $size_height    = config('constants.image.md');
                $size_width     = ceil($size_height / 3);
                // end image 4x3

                $file_compress  = imageConvert($file, $size_height, $size_width);

                Storage::disk('public')->delete($path . $data->thumbnail);
                Storage::disk('public')->put($path .  $filename, $file_compress);
                // END PUT TO LOCAL IMAGE
                $data->thumbnail = $filename;
                $data->save();
            }
            return redirect()->back()->with('success', 'Berhasil menambahkan kategori baru');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan kategori baru');
        }
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
        $this->validate(
            $request,
            [
                'name'      => 'required',
                'status'    => 'required',
            ],
            [
                'required'  => ':attribute belum di isi',
            ],
            [
                'name'      => 'nama kategori',
                'status'    => 'status kategori',
            ]
        );
        try {
            $data = Category::find($id);
            $data->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $request->validate([
                    'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
                ]);
                // PUT TO LOCAL IMAGE
                $filename       = date('dmyHis') . '_thumbnail' . '.' . $file->getClientOriginalExtension();
                $path           = config('constants.path.storage.category.thumbnail');

                // image 4x3
                $size_height    = config('constants.image.md');
                $size_width     = ceil($size_height / 3);
                // end image 4x3

                $file_compress  = imageConvert($file, $size_height, $size_width);

                Storage::disk('public')->delete($path . $data->thumbnail);
                Storage::disk('public')->put($path .  $filename, $file_compress);
                // END PUT TO LOCAL IMAGE
                $data->thumbnail = $filename;
                $data->save();
            }
            return redirect()->back()->with('success', 'Berhasil memperbarui kategori');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memperbarui kategori');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path   = config('constants.path.storage.category.thumbnail');
        $data   = Category::find($id);

        Storage::disk('public')->delete($path . $data->thumbnail);
        $data->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus kategori');
    }
}
