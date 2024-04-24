<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('post',[
            // dd(auth()->id()),
            'fotos' => Foto::where('user_id', auth()->id())->latest()->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_foto' => 'required|max:255',
            'deskripsi_foto' => 'required|max:255',
            'lokasi_file' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $foto = new Foto;
        $foto->user_id = auth()->id();
        $foto->judul_foto = $request->judul_foto;
        $foto->deskripsi_foto = $request->deskripsi_foto;
        $foto->tanggal_unggah = Carbon::now();

        if($request->hasFile('lokasi_file')){
            $file = $request->file('lokasi_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $file->move($destinationPath, $fileName);
            $foto->lokasi_file = $fileName;
        }

        $foto->save();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // dd($id);
        return view('show', [
            'foto' => Foto::with('user')->where('slug', $slug)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $foto = Foto::find($id);
    return view('edit', compact('foto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

          $foto = Foto::find($id);

          // //Store Image In Folder
          if($request->lokasi_file != ''){        
            $path = public_path().'/images/';
            
            //code for remove old file
            if($foto->lokasi_file != ''  && $foto->lokasi_file != null){
                 $file_old = $path.$foto->lokasi_file;
                 unlink($file_old);
            }
            //upload new file
            $file = $request->lokasi_file;
            $filename = $request->file('lokasi_file')->getClientOriginalName();
            $file->move($path, $filename);
  
            //for update in table
            $foto->update(['lokasi_file' => $filename]);
       }

       $foto->judul_foto = $request->get('judul_foto');;
        $foto->deskripsi_foto = $request->get('deskripsi_foto');;


        $foto->save();
          return redirect()->route('post.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $foto = Foto::find($id);
    $foto->delete();
    return redirect()->route('post.index')
      ->with('success', 'Post deleted successfully');
    }
}
