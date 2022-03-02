<?php

namespace App\Http\Controllers;

use App\Models\Engin;
use App\Models\Profil;
use App\Models\Livreur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpFoundation\Response;

class LivreurController extends Controller
{

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        //
       
        $liste_livreur = Livreur::with('media','engin','profil')->get();
        $liste_profil = Profil::with('media','livreur')->get();
        $liste_engin = Engin::with('media','livreur')->get();
        $all_livreur = [];

        if (!$liste_livreur) {
            return response()->json(['message'=>'livreur pas  encore enregistré']);
        }elseif (!$liste_profil) {
            return response()->json(['message'=>'profil pas  encore enregistré']);
        }elseif (!$liste_engin) {
            return response()->json(['message'=>'engin pas  encore enregistré']);
        }else {
            for ($i=0; $i <count($liste_livreur) ; $i++) { 
                $img_profil_livreur = $liste_livreur[$i]->getFirstMediaUrl('img_profil');
                $img_piece_avant = $liste_livreur[$i]->getFirstMediaUrl('img_piece_avant');
                $img_piece_arriere= $liste_livreur[$i]->getFirstMediaUrl('img_piece_arriere');
                $img_immatriculation= $liste_livreur[$i]->getFirstMediaUrl('img_immatriculation');
                    array_push($all_livreur,
                    [
                    'img_profil'=>$img_profil_livreur,
                    'img_piece_avant'=>$img_piece_avant, 
                    'img_piece_arriere'=>$img_piece_arriere,
                    'img_immatriculation'=>$img_immatriculation,
                    'livreur'=>$liste_livreur[$i]
        
                ]); // 
                // }
                       
               
            }
        }

        return response()->json([
            // 'liste_livreur'=>$liste_livreur,
            'all_livreur'=>$all_livreur,
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $livreur_connecte = Livreur::whereId(Auth::user()->id)->with('media','profil','engin')->get();
        $profil_connecte = Profil::whereId(Auth::user()->id)->with('media','livreur')->get();
        $engin_connecte = Engin::whereId(Auth::user()->id)->with('media','livreur')->get();

      

        if (!$livreur_connecte) {
            return response()->json(['message'=>'livreur pas  encore enregistré']);
        }elseif (!$profil_connecte) {
            return response()->json(['message'=>'profil pas  encore enregistré']);
        }elseif (!$engin_connecte) {
            return response()->json(['message'=>'engin pas  encore enregistré']);
        }
        else {
       
            return response()->json([
                'infos_livreur'=> $livreur_connecte,

                'img_profil'=> $livreur_connecte[0]->getFirstMediaUrl('img_profil'),
                'img_piece_avant'=> $livreur_connecte[0]->getFirstMediaUrl('img_piece_avant'),
                'img_piece_arriere'=> $livreur_connecte[0]->getFirstMediaUrl('img_piece_arriere'),
                'img_immatriculation'=> $livreur_connecte[0]->getFirstMediaUrl('img_immatriculation'),
               
            ]);
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

        $data = $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'contact'=>'required|unique:livreurs',
            'lieu_de_residence'=>'required',
            // 'position_actuelle'=>'required',
            'engin'=>'required',
            'disponibilite'=>'required',
            'status'=>'required',
            'password'=>'required|max:15',

            // 'matricule'=>'required',
        ]);

            $livreur = Livreur::create([
               'nom'=>$request->nom,
               'prenom'=>$request->prenom,
               'contact'=>$request->contact,
               'lieu_de_residence'=>$request->lieu_de_residence,
               'position_actuelle'=>'en attente',
               'engin'=>$request->engin,
               'quartier'=>$request->quartier,
               'disponibilite'=>$request->disponibilite,
               'status'=>$request->status,
               'password' => Hash::make($request->password),
            ]);
            $token = $livreur->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'livreur enregistré avec success',
                    $token
            ]);
                
    }

    /** 
     * 
     * controller pour definir la position du livreur 
     * 
     * */

    public function position(Request $request){

        $request->validate([
            'position_actuelle'=>'required',
        ]);

        $position=Livreur::find($request->id);
        $position_id = $position ->id;
        if ($position_id == Auth::user()->id ) {
            $position_update = Livreur::whereId(Auth::user() ->id)->update([
                   "position_actuelle"=>$request->position_actuelle,
                   "position_precise"=>$request->position_precise,
               ]) ;  
               return response()->json(["position definie"], 200);
        } else if( $position_id != Auth::user() ->id) {
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



    public function auth(){
        $user = Auth::user();
        return response()->json($user);
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
            'nom'=>'required',
            'prenom'=>'required',
            'contact'=>'required',
            'lieu_de_residence'=>'required',
            // 'position_actuelle'=>'required',
            'engin'=>'required',
            'disponibilite'=>'required',
            'status'=>'required',
            // 'password'=>'required|max:8',
        ]);

        $livreur_update=Livreur::find($request->id)->update([
            'nom'=>$request->nom,
               'prenom'=>$request->prenom,
               'contact'=>$request->contact,
               'lieu_de_residence'=>$request->lieu_de_residence,
            //    'position_actuelle'=>'en attente',
               'engin'=>$request->engin,
               'quartier'=>$request->quartier,
               'disponibilite'=>$request->disponibilite,
               'status'=>$request->status,
            //    'password' => Hash::make($request->password),
        ]);
             return response()->json([
                 $livreur_update,
             'modifié avec success'
                 ]);
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
