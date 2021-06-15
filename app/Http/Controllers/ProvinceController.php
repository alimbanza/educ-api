<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $provinces = Province::all();

        return response()->json([
            'success' => true,
            'message' => 'Provinces récupérées avec succès',
            'data' => $provinces
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('name');
        echo json_encode(['test'=>'test']);die();
        $validator = Validator::make($data, [
            'name' => 'required|string',
        ]);

        //Retourne les messages en cas d'erreur lors de la validation des données soumises

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Ajout d'une nouvelle province

        $ptovince = Province::create([
            'name' => $request->name,
        ]);

        //Retourne une reponse après insertion des données

        return response()->json([
            'success' => true,
            'message' => 'Province ajoutée avec succès',
            'data' => $province
        ], Response::HTTP_OK);
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
        //Validation des informations soumises

        $data = $request->only('name');

        $validator = Validator::make($data, [
            'name' => 'required|string'
        ]);

        //Retourne les messages en cas d'erreur lors de la validation des données soumises

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Modifie la province

        $province = Province::update([
            'name' => $request->name
        ]);

        //Retourne une réponse

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $province
        ], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Suppression de la province

        Province::destroy($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Province supprimée avec succès'
        ], Response::HTTP_OK);
    }

    public function villes()
    {
        
    }
}
