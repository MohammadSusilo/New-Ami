<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\faqs;

class FAQsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function faqsSaveMulti(Request $request)
    {
        try{
            foreach ($request->addmore as $key => $value) {
                if ($value['subjek'] != null){
                    if ($value['uraian'] != null){            

                            faqs::create([
                                'subjek'=> $value['subjek'],
                                'uraian'=> $value['uraian'],
                                'urutan'=> $value['urutan'],
                                'status'=> $value['status'],
                            ]);

                    }else{
                        return back()->with('error', 'Uraian FAQs wajib di isi, FAQs gagal ditambah');
                    }

                }else{
                    return back()->with('error', 'Judul FAQs wajib di isi, FAQs gagal ditambah');
                }
            }
        
            return back()->with('success', 'FAQs berhasil ditambah');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $faqs = faqs::findOrFail($id);

        return view('menu.setting.faqs.show', compact('faqs'));
    }

    public function edit($id)
    {
        $faqs = faqs::findOrFail($id);

        return view('menu.setting.faqs.edit', compact('faqs'));
    }

    public function update(Request $request, $id)
    {
        try{
            $valid = [
                'subjek' => 'required|min:3|max:50',
                'uraian' => 'min:3|max:255',
                'urutan' => 'required',
            ];
    
            $request->validate($valid);
            $faqs = faqs::findOrFail($id);

            $faqs->update([
                'subjek'=> $request->subjek,
                'uraian'=> $request->uraian,
                'urutan'=> $request->urutan,
                'status'=> $request->status,
            ]);
            // $buktiKinerja->update($request->all());

            return redirect()->route('faqs.show', $faqs->id)->with('success', 'FAQs berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $faqs = faqs::findOrFail($id);
            $faqs->delete();

            return back()->with('success', 'FAQs berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
