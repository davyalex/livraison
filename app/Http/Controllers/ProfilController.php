<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (auth()->check())  {
            $profil = Profil::whereLivreur_id(Auth::user()->id)
            ->with(['media'])
            ->get();
            return response()->json([
                $profil,
                'profil'=> $profil[0]->getFirstMediaUrl('img_profil'),
                'photo_avant'=> $profil[0]->getFirstMediaUrl('img_piece_avant'),
                'photo_arriere'=> $profil[0]->getFirstMediaUrl('img_piece_arriere')

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
            'type_piece'=>'required',
            'numero_piece'=>'required|unique:profils'
        ]);

        $profil_existe = Profil::whereNumero_piece($request->numero_piece)
        ->orWhere('livreur_id',Auth::user()->id)->first();
            if (auth()->check() AND !$profil_existe ) {
                $profil = Profil::create([
                    'type_piece' =>$request->type_piece,
                    'numero_piece' => $request->numero_piece,
                    'livreur_id' => Auth::user()->id,
                ]);

        //ajout de photo de profil
        if($request->hasFile('img_profil'))
        {
            $profil->addMediaFromRequest('img_profil')
            ->toMediaCollection('img_profil');
        }

        //ajout de la piece avant
        if($request->hasFile('img_piece_avant'))
        {
            $profil->addMediaFromRequest('img_piece_avant')
            ->toMediaCollection('img_piece_avant');
        }

         //ajout de la piece arriere
         if($request->hasFile('img_piece_arriere'))
         {
             $profil->addMediaFromRequest('img_piece_arriere')
             ->toMediaCollection('img_piece_arriere');
         }

                return response()->json([
                    'message'=>'profil ajouté avec success',
                    $profil
                ],200);
            } else {
               return response()->json('Vous n\'êtes pas connecté ou profil existe déjà');
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
        //
        $request->validate([
            'type_piece'=>'required',
            'numero_piece'=>'required'
        ]);
//
   if (auth()->check()) {
       $profil_update=Profil::find($request->id)->update([
            'type_piece' =>$request->type_piece,
            'numero_piece' => $request->numero_piece,
            'livreur_id' => Auth::user()->id,
       ]);

               if ($profil_update=Profil::find($request->id)) {
                   $profil_update->clearMediaCollection('img_profil');
                   $profil_update->addMediaFromRequest('img_profil')
                   ->toMediaCollection('img_profil');

                   $profil_update->clearMediaCollection('img_piece_avant');
                   $profil_update->addMediaFromRequest('img_piece_avant')
                   ->toMediaCollection('img_piece_avant');

                   $profil_update->clearMediaCollection('img_piece_arriere');
                   $profil_update->addMediaFromRequest('img_piece_arriere')
                   ->toMediaCollection('img_piece_arriere');
               }
      
 

       return response()->json([
       $profil_update,
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
