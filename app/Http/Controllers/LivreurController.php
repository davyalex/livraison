<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;
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
            'position_actuelle'=>'required',
            'engin'=>'required',
            'disponibilite'=>'required',
            'status'=>'required',
            'matricule'=>'required',
        ]);

            $livreur = Livreur::create([
               'nom'=>$request->nom,
               'prenom'=>$request->prenom,
               'contact'=>$request->contact,
               'lieu_de_residence'=>$request->lieu_de_residence,
               'position_actuelle'=>$request->position_actuelle,
               'engin'=>$request->engin,
               'disponibilite'=>$request->disponibilite,
               'status'=>$request->status,
               'matricule'=>$request->matricule,
            ]);

                return response()->json('livreur enregistré avec success');
                
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
            'nom'=>'required',
            'prenom'=>'required',
            'contact'=>'required',
            'lieu_de_residence'=>'required',
            'position_actuelle'=>'required',
            'engin'=>'required',
            'disponibilite'=>'required',
            'status'=>'required',
            'matricule'=>'required',
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
