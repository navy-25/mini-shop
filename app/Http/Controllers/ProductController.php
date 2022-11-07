<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

date_default_timezone_set('Asia/Jakarta');

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page['title'] = 'Produk';
        $data = Product::query()
            ->join('categories as c', 'c.id', 'products.category_id')
            ->where('c.status', 1)
            ->select('products.*', 'c.name as category_name');

        $request->category_id   == '' ? '' : $data = $data->where('products.category_id', $request->category_id);
        $request->status        == '' ? '' : $data = $data->where('products.status', $request->status);
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_data', function ($row) {
                    return getBasicBadge($row->status);
                })
                ->addColumn('price_format', function ($row) {
                    return 'Rp. ' . numberFormat($row->price);
                })
                ->addColumn('quantity_format', function ($row) {
                    return numberFormat($row->quantity);
                })
                ->addColumn('opsi', function ($row) {
                    $btn    = [];
                    $btn[]  = '<div class="d-flex">';

                    $url    = route('admin.product.update', ['id' => $row->id]);
                    $btn[]  = '<button onclick="editData(this,`' . $url . '`)"
                        data-bs-toggle="modal" data-bs-target="#modalForm"
                        class="btn btn-danger btn-sm me-2"
                        type="button" style="font-size:8px !important">Edit</button>';

                    $title  = 'Yakin hapus ' . $row->name . '?';
                    $url    = route('admin.product.destroy', ['id' => $row->id]);
                    $btn[]  = '<button onclick="alertNotif(`' . $title . '`,`' . $url . '`)" class="btn btn-secondary btn-sm" type="button" style="font-size:8px !important">Hapus</button>';

                    $btn[]  = '</div>';
                    return join("", $btn);
                })
                ->addColumn('thumbnail_image', function ($row) {
                    if ($row->thumbnail == '') {
                        $image =  '<img width="100px" style="aspect-ratio:4/3 !important" class="" src="' . asset('app-assets/image/default-4-3.png') . '" alt="default thumbnail">';
                    } else {
                        $image =  '<img width="100px" style="aspect-ratio:4/3 !important" class="" src="' . route('storage.productThumbnail', ['filename' => $row->thumbnail]) .  '" alt="' . $row->thumbnail . '">';
                    }
                    return $image;
                })
                ->addColumn('created_at', function ($row) {
                    return dateTimeFormat($row->created_at);
                })
                ->rawColumns(['opsi', 'thumbnail_image', 'status_data'])
                ->make(true);
        }
        return view('backend.product', compact('page'));
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
                'name'          => 'required',
                'category_id'   => 'required',
                'quantity'      => 'required',
                'price'         => 'required',
                'status'        => 'required',
            ],
            [
                'required'      => ':attribute belum di isi',
            ],
            [
                'name'          => 'nama produk',
                'category_id'   => 'kategori',
                'quantity'      => 'jumlah stok',
                'price'         => 'harga satuan',
                'status'        => 'status produk',
            ]
        );
        try {
            $data = Product::create([
                'name'          => $request->name,
                'status'        => $request->status,
                'category_id'   => $request->category_id,
                'quantity'      => unFormatMoney($request->quantity),
                'price'         => unFormatMoney($request->price),
            ]);
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $request->validate([
                    'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
                ]);
                // PUT TO LOCAL IMAGE
                $filename       = date('dmyHis') . '_thumbnail' . '.' . $file->getClientOriginalExtension();
                $path           = config('constants.path.storage.product.thumbnail');

                // image 4x3
                $size_width     = config('constants.image.sm');
                $size_height    = ceil($size_width * 1.33);
                // end image 4x3

                $file_compress  = imageConvert($file, $size_height, $size_width);

                Storage::disk('public')->delete($path . $data->thumbnail);
                Storage::disk('public')->put($path .  $filename, $file_compress);
                // END PUT TO LOCAL IMAGE
                $data->thumbnail = $filename;
                $data->save();
            }
            return redirect()->back()->with('success', 'Berhasil menambahkan produk baru');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk baru');
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
                'name'          => 'required',
                'category_id'   => 'required',
                'quantity'      => 'required',
                'price'         => 'required',
                'status'        => 'required',
            ],
            [
                'required'      => ':attribute belum di isi',
            ],
            [
                'name'          => 'nama produk',
                'category_id'   => 'kategori',
                'quantity'      => 'jumlah stok',
                'price'         => 'harga satuan',
                'status'        => 'status produk',
            ]
        );
        try {
            $data = Product::find($id);
            $data->update([
                'name'          => $request->name,
                'status'        => $request->status,
                'category_id'   => $request->category_id,
                'quantity'      => unFormatMoney($request->quantity),
                'price'         => unFormatMoney($request->price),
            ]);
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $request->validate([
                    'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
                ]);
                // PUT TO LOCAL IMAGE
                $filename       = date('dmyHis') . '_thumbnail' . '.' . $file->getClientOriginalExtension();
                $path           = config('constants.path.storage.product.thumbnail');

                // image 4x3
                $size_width     = config('constants.image.sm');
                $size_height    = ceil($size_width * 1.33);
                // end image 4x3

                $file_compress  = imageConvert($file, $size_height, $size_width);

                Storage::disk('public')->delete($path . $data->thumbnail);
                Storage::disk('public')->put($path .  $filename, $file_compress);
                // END PUT TO LOCAL IMAGE
                $data->thumbnail = $filename;
                $data->save();
            }
            return redirect()->back()->with('success', 'Berhasil memperbarui produk');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memperbarui produk');
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
        $path   = config('constants.path.storage.product.thumbnail');
        $data   = Product::find($id);

        Storage::disk('public')->delete($path . $data->thumbnail);
        $data->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus produk');
    }
}
