<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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
    public function update(Request $request, $id)
    {
        //
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



public function login(Request $request){

        //verification de l'email user entré

    $user = Livreur::whereContact($request->contact)
    ->first();

    //verification du mot de passe associé a l'email

    if (!$user) {
    return response()->json('mauvaises informations entréés');

    } elseif (!Hash::check($request->password,  $user->password)) {
       return response()->json('mauvaises informations entréés');
       
    } else {
        $token = $user->createToken('auth_token')->plainTextToken;
      return response()->json(['Vous êtes connecté', $token, Auth::user() ]);
    }
    
  
   

    // if ($user) {
    //     return response()->json([
    //         $user,
    //         'connecté avec success'
    //     ]);
    // } else {
    //     return response()->json('mauvaise information');
    // }
    
    
       

    return response()->json(Auth::user());

}


public function logout(Request $request){

   Auth::user()->tokens()->delete();

    return response()->json('deconnexion réussi');
}

}
