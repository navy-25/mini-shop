<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title']  = 'Pengaturan';
        $data           = Settings::first();
        return view('backend.settings', compact('data', 'page'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings, $id)
    {
        try {
            $data = Settings::find($id);
            $data->update([
                'name'         => $request->name,
                'service_time' => $request->service_time,
                'address'      => $request->address,
                'description'  => $request->description,
                'keywords'     => $request->keywords,
                'instagram'    => $request->instagram,
                'facebook'     => $request->facebook,
                'email'        => $request->email,
                'whatsapp'     => $request->whatsapp,
                'phone'        => $request->phone,
            ]);
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg',
                ]);
                // PUT TO LOCAL IMAGE
                $filename       = date('dmyHis') . '_logo' . '.' . $file->getClientOriginalExtension();
                $path           = config('constants.path.storage.settings.logo');

                // image 1:1
                $size           =  config('constants.image.sm');
                // end image 1:1

                $file_compress  = imageSquare($file, $size);

                Storage::disk('public')->delete($path . $data->logo);
                Storage::disk('public')->put($path .  $filename, $file_compress);
                // END PUT TO LOCAL IMAGE
                $data->logo = $filename;
                $data->save();
            }
            return redirect()->back()->with('success', 'Berhasil memperbarui pengaturan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memperbarui pengaturan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
