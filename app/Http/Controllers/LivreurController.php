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
    public function index()
    {
        //
        $liste_livreur = Livreur::whereId(Auth::user()->id)->get();
        return response()->json($liste_livreur);
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
               'disponibilite'=>$request->disponibilite,
               'status'=>$request->status,
               'password' => Hash::make($request->password),
            //    'matricule'=>$request->matricule,
            ]);
            $token = $livreur->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'livreur enregistré avec success',
                    $token
            ]);
                
    }


    public function position(Request $request){

        $request->validate([
            'position_actuelle'=>'required',
        ]);
        if (auth()->check()) {
            $position = Livreur::find($request->id)->update([
                "position_actuelle"=>$request->position_actuelle,
                "position_precise"=>$request->position_precise,
            ]);
                return response()->json([
                    "position definie",
                    $position
                ]);
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
            // 'matricule'=>'required',
        ]);

        $livreur_update=Livreur::find($request->id)->update($request->all());
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
