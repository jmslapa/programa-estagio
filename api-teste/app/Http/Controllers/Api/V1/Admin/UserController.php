<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *   name="Users",
 *   description="Conjunto de rotas com operações de CRUD para Usuários"
 * )
 */

class UserController extends Controller
{

    private $user;

    /**
     * Instantiate a UserController class
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *   path="/users",
     *   summary="Lista de usuários",
     *   tags={"Users"},
     *   @OA\Response(
     *     response=200,
     *     description="Uma lista com todos os usuários cadastrados"
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Acesso não autorizado"
     *   )
     * )  
     */
    public function index()
    {
        return response()->json($this->user->all());
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
}
