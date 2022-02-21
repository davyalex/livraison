<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;
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
        $liste_livreur = Livreur::with('media')->get();
        $img_livreur = [$liste_livreur];
        for ($i=0; $i <count($liste_livreur) ; $i++) { 
            $img_profil_livreur = $liste_livreur[$i]->getFirstMediaUrl('img_profil');
            array_push($img_livreur,[$img_profil_livreur, $liste_livreur[$i]]); // A ce niveau j'ai fait un tableau [] dans lequel je met l'image $img_profil_livreur et le livreur qui correspond $liste_livreur[$i]
        }
        return response()->json([
            'liste_livreur'=>$liste_livreur,
            'image_livreur'=>$img_livreur,
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
        $infos_livreur = Livreur::whereId(Auth::user()->id)->get();
        return response()->json($infos_livreur);
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
