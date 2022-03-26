<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPiece()
    {
        //
        if (auth()->check())  {
            $piece_verify = Profil::whereLivreur_id(Auth::user()->id)
            ->with(['media'])
            ->first();

            if ( $piece_verify) {
                $piece = Livreur::whereId(Auth::user()->id)
                ->with(['media','profil'])
                ->get();

                return response()->json([
                    // $piece_verify 
                    $piece,
                    'photo_avant'=> $piece[0]->getFirstMediaUrl('img_piece_avant'),
                    'photo_arriere'=>$piece[0]->getFirstMediaUrl('img_piece_arriere')
    
                      ], 200);
            }else{
                return response()->json(['message' =>'piece pas encore ajouté']);
            }

          } else {
              return response()->json('Vous n\'êtes pas connecté');
          }
    }

    public function indexImageProfil()
    {
        //
        if (auth()->check())  {
            $image_profil = Livreur::whereId(Auth::user()->id)
            ->with(['media'])
            ->get();
            return response()->json([
                $image_profil,
                'image_profil'=> $image_profil[0]->getFirstMediaUrl('img_profil'),
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
    public function storePiece(Request $request)
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


        

        $livreur = Livreur::whereId(Auth::user()->id)->first();
                if ($livreur) {
                    
                    //ajout de la piece avant
                   if($request->hasFile('img_piece_avant'))
                   {
                    $livreur->addMediaFromRequest('img_piece_avant')
                       ->toMediaCollection('img_piece_avant');
                   }
           
                    //ajout de la piece arriere
                    if($request->hasFile('img_piece_arriere'))
                    {
                        $livreur->addMediaFromRequest('img_piece_arriere')
                        ->toMediaCollection('img_piece_arriere');
                    }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePhotoProfil(Request $request)
    {
        //
    
        $image_profil = Livreur::find(Auth::user()->id );
            // if (Auth::user()->id == $request->id ) {
                //ajout de photo de profil
                if($request->hasFile('img_profil'))
                {
                    $image_profil->addMediaFromRequest('img_profil')
                    ->toMediaCollection('img_profil');
                }
             return response()->json([
                    'message'=>'profil ajouté avec success',
                    $image_profil
                ],200);
            // } elseif(Auth::user()->id != $request->id) {
            //    return response()->json('Vous n\'êtes pas connecté ou profil existe déjà');
            // }
            
        
     
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
    public function updatePhotoProfil(Request $request)
    {

        $imageProfil_update = Livreur::find(Auth::user()->id );
            // if (Auth::user()->id ==  $request->id ) {
                //ajout de photo de profil
                if($request->hasFile('img_profil'))
                {
                    $imageProfil_update->clearMediaCollection('img_profil');
                    $imageProfil_update->addMediaFromRequest('img_profil')
                   ->toMediaCollection('img_profil');
                }
             return response()->json([
                    'message'=>'MODIFIE AVEC SUCCESS',
                    $imageProfil_update
                ],200);
            // } elseif(Auth::user()->id != $request->id) {
            //    return response()->json('Vous n\'êtes pas connecté ou profil existe déjà');
            // } 
  
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePiece(Request $request)
    {
        //
        $request->validate([
            'type_piece'=>'required',
            'numero_piece'=>'required'
        ]);
//
   if (auth()->check()) {
       $profil_update=Profil::findOrFail($request->id)->update([
            'type_piece' =>$request->type_piece,
            'numero_piece' => $request->numero_piece,
            'livreur_id' => Auth::user()->id,
       ]);

               if ($profil_update=Profil::findOrFail($request->id)) {

                $livreur_piece= Livreur::whereId(Auth::user()->id)->first();

                $livreur_piece->clearMediaCollection('img_piece_avant');
                $livreur_piece->addMediaFromRequest('img_piece_avant')
                   ->toMediaCollection('img_piece_avant');

                   $livreur_piece->clearMediaCollection('img_piece_arriere');
                   $livreur_piece->addMediaFromRequest('img_piece_arriere')
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
