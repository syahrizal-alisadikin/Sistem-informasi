<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Includes;
use App\Instruktur;
use App\Kelas;
use App\Materi;
use Illuminate\Http\Request;
use Str;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;
class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.admin.kelas.index',compact('kelas'));
    }

    public function create()
    {
        $materi = Materi::all();
        $includes = Includes::all();
        $instruktur = Instruktur::where("status","Active")->get();
        return view('pages.admin.kelas.create',compact('materi','includes',"instruktur"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|max:2048',
            'type' => 'required',
            'description' => 'required',
            'harga' => 'required',
        ]);
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/kelas', $image->hashName());
        $kelas = Kelas::create([
            'image'         => $image->hashName(),
            'name'          => $request->name,
            'instruktur_id' => $request->instruktur_id,
            'slug'          => Str::slug($request->name),
            'type'          => $request->type,
            'description'   => $request->description,
            'harga'         => $request->harga  
        ]);
        //assign materi
        $kelas->materi()->attach($request->materi);
        //assign includes
        $kelas->includes()->attach($request->includes);
        $kelas->save();

        if($kelas){
            return redirect()->route('kelas.index')->with('success','Kelas berhasil dibuat!!');
        }else{
            return redirect()->route('kelas.index')->with('error','Kelas Gagal dibuat!!');

        }
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        $materi = Materi::all();
        $includes = Includes::all();
        $instruktur = Instruktur::where("status","Active")->get();
        
        return view('pages.admin.kelas.edit',compact('kelas','materi','includes',"instruktur"));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'harga' => 'required',
        ]);

        if ($request->file('image') == "") {
            
            $kelas = Kelas::findOrFail($id);
            $kelas->update([
                'name'          => $request->name,
                'instruktur_id' => $request->instruktur_id,
                'slug'          => Str::slug($request->name),
                'type'          => $request->type,
                'description'   => $request->description,
                'harga'         => $request->harga,

                ]);

        } else {
            $kelas = Kelas::findOrFail($id);
            $this->validate($request, [
            'image' => 'required|max:2048',
            
        ]);
            //remove old image
            Storage::disk('local')->delete('public/kelas/'.basename($kelas->image));

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/kelas', $image->hashName());

            $kelas = Kelas::findOrFail($id);

            $kelas->update([
                'image'         => $image->hashName(),
                'name'          => $request->name,
                'instruktur_id' => $request->instruktur_id,

                'slug'          => Str::slug($request->name),
                'type'          => $request->type,
                'description'   => $request->description,
                'harga'         => $request->harga 
            ]);

        }


        //assign materi
        $kelas->materi()->sync($request->materi);
        //assign includes
        $kelas->includes()->sync($request->includes);

        if($kelas){
            return redirect()->route('kelas.index')->with('success','Kelas berhasil diupdate!!');
        }else{
            return redirect()->route('kelas.index')->with('error','Kelas Gagal diupdate!!');

        }

    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $image = Storage::disk('local')->delete('public/kelas/'.basename($kelas->image));
        $kelas->delete();
        if($kelas){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
