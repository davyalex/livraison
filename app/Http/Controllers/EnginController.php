<?php

namespace App\Http\Controllers;

use App\Models\Engin;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
           if (auth()->check())  {
          $livreur_engin = Engin::whereLivreur_id(Auth::user()->id)
          ->with(['media','livreur'])
          ->get();
          return response()->json([
              $livreur_engin,
              'image'=> $livreur_engin[0]->getFirstMediaUrl('img_immatriculation')
                ], 200);
        } else {
            return response()->json('Vous n\'êtes pas connecté');
        }
        
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
        //
        $request->validate([
            // 'type_engin'=>'required',
            'immatriculation'=>'required',
        ]);

            if (auth()->check()) {
                $engin = Engin::create([
                    'type_engin' => Auth::user()->engin,
                    'immatriculation' => $request->immatriculation,
                    'livreur_id' => Auth::user()->id,
                ]);

            
        if($request->file('img_immatriculation'))
        {
            $engin->addMediaFromRequest('img_immatriculation')
            ->toMediaCollection('img_immatriculation');
        }

                return response()->json([
                    'message'=>'Engin ajouté avec success',
                    $engin
                ],200);
            } else {
               return response()->json('Vous n\'êtes pas connecté');
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
    public function update(Request $request)
    {
                 $request->validate([
                     // 'type_engin'=>'required',
                     'immatriculation'=>'required',
                 ]);
        //
            if (auth()->check()) {
                $engin_update=Engin::find($request->id)->update([
                    'type_engin' => $request->type_engin,
                    'immatriculation' => $request->immatriculation,
                    'livreur_id' => Auth::user()->id,
                ]);
                // if($request->file('img_immatriculation'))
                // {
                //     $engin->addMediaFromRequest('img_immatriculation')
                //     ->toMediaCollection('img_immatriculation');
                // }

                $engin_modify = Livreur::whereId(Auth::user()->id)->update(['engin'=> $engin_update->type_engin]);

                return response()->json([
                $engin_update,
                'modifié avec success'
                    ]);
            } else {
                return response()->json('Vous n\'êtes pas connecté');
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
        //
    }
}
