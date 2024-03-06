<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index ()
    {
        return view('publishers.index', [
            'publishers' => Publisher::latest()->get(),
        ]);
    }
    
    public function create() 
    {
        return view('publishers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3'], 
            'address' => ['required', 'min:10'],
        ], [

            'name.required' => ' Nama Harus Diisi',
            'address.required' => ' Alamat Harus Diisi'
        ]);
        $publisher = new Publisher();

        $publisher->name = $request->name;
        $publisher->address = $request->address;

        $publisher->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('publisher.index');
        }

    public function edit($id)
    {
        $publisher = Publisher::find($id);
        return view('publishers.edit', [
            "publisher" => $publisher,
        ]);   
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3'], 
            'address' => ['required', 'min:10'],
        ], [

            'name.required' => ' Nama Harus Diisi',
            'address.required' => ' Alamat Harus Diisi'
        ]);
        
        $publisher = Publisher::find($id);

        $publisher->name = $request->name;
        $publisher->address = $request->address;

        $publisher->save();

        session()->flash('success', 'Data Berhasil Diedit');
        return redirect()->route('publisher.index');
    }

    public function destroy($id)

    {
        $publisher = Publisher::find($id);

        $publisher->delete();

        session()->flash('danger', 'Data Berhasil Dihapus');
        return redirect()->route('publisher.index');
    }
}
