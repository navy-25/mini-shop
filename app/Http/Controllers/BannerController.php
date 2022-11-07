<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page['title'] = 'Banner';
        $data = Banner::get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_data', function ($row) {
                    return getBasicBadge($row->status);
                })
                ->addColumn('opsi', function ($row) {
                    $btn    = [];
                    $btn[]  = '<div class="d-flex">';

                    $url    = route('admin.banner.update', ['id' => $row->id]);
                    $btn[]  = '<button onclick="editData(this,`' . $url . '`)"
                        data-bs-toggle="modal" data-bs-target="#modalForm"
                        class="btn btn-danger btn-sm me-2"
                        type="button" style="font-size:8px !important">Edit</button>';

                    $title  = 'Yakin hapus ' . $row->name . '?';
                    $url    = route('admin.banner.destroy', ['id' => $row->id]);
                    $btn[]  = '<button onclick="alertNotif(`' . $title . '`,`' . $url . '`)" class="btn btn-secondary btn-sm" type="button" style="font-size:8px !important">Hapus</button>';
                    $btn[]  = '</div>';
                    return join("", $btn);
                })
                ->addColumn('bannerImage', function ($row) {
                    if ($row->banner == null) {
                        $image =  '<img width="200px" style="aspect-ratio:3/1 !important" class="" src="' . asset('app-assets/image/default-3-1.png') . '" alt="default thumbnail">';
                    } else {
                        $image =  '<img width="200px" style="aspect-ratio:3/1 !important" class="" src="' . route('storage.bannerImage', ['filename' => $row->banner]) .  '" alt="' . $row->banner . '">';
                    }
                    return $image;
                    return '';
                })
                ->rawColumns(['opsi', 'bannerImage', 'status_data'])
                ->make(true);
        }
        return view('backend.banner', compact('page', 'data'));
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
                'status'    => 'required',
            ],
            [
                'required'  => ':attribute belum di isi',
            ],
            [
                'status'    => 'status kategori',
            ]
        );
        try {
            $data = Banner::create([
                'status' => $request->status,
                'banner' => $request->banner,
            ]);
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $request->validate([
                    'banner' => 'required|image|mimes:jpeg,png,jpg',
                ]);
                // PUT TO LOCAL IMAGE
                $filename       = date('dmyHis') . '_banner' . '.' . $file->getClientOriginalExtension();
                $path           = config('constants.path.storage.banner.image');

                // image 4x3
                $size_height    = config('constants.image.sm');
                $size_width     = ceil($size_height / 3);
                // end image 4x3

                $file_compress  = imageConvert($file, $size_height, $size_width);

                Storage::disk('public')->delete($path . $data->banner);
                Storage::disk('public')->put($path .  $filename, $file_compress);
                // END PUT TO LOCAL IMAGE
                $data->banner = $filename;
                $data->save();
            }
            return redirect()->back()->with('success', 'Berhasil menambahkan banner baru');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan banner baru');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner, $id)
    {

        $this->validate(
            $request,
            [
                'status'    => 'required',
            ],
            [
                'required'  => ':attribute belum di isi',
            ],
            [
                'status'    => 'status kategori',
            ]
        );
        try {
            $data = Banner::find($id);
            $data->update([
                'status' => $request->status,
            ]);
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $request->validate([
                    'banner' => 'required|image|mimes:jpeg,png,jpg',
                ]);
                // PUT TO LOCAL IMAGE
                $filename       = date('dmyHis') . '_banner' . '.' . $file->getClientOriginalExtension();
                $path           = config('constants.path.storage.banner.image');

                // image 4x3
                $size_height    = config('constants.image.sm');
                $size_width     = ceil($size_height / 3);
                // end image 4x3

                $file_compress  = imageConvert($file, $size_height, $size_width);

                Storage::disk('public')->delete($path . $data->banner);
                Storage::disk('public')->put($path .  $filename, $file_compress);
                // END PUT TO LOCAL IMAGE
                $data->banner = $filename;
                $data->save();
            }
            return redirect()->back()->with('success', 'Berhasil memperbarui banner');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memperbarui banner');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner, $id)
    {
        $path   = config('constants.path.storage.banner.image');
        $data   = Banner::find($id);

        Storage::disk('public')->delete($path . $data->thumbnail);
        $data->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus banner');
    }
}
