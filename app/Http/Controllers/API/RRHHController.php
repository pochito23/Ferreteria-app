<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Empleado;
use App\Http\Resources\EmpleadoResource;

class RRHHController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleado  = Empleado::orderBy('id', 'DESC')->paginate(10);
        return response()->json([
            'success' => true,
            'data' => EmpleadoResource::collection($empleado),
            'pagination' => [
                'total' => $empleado->total(),
                'current_page' => $empleado->currentPage(),
                'per_page' => $empleado->perPage(),
                'last_page' => $empleado->lastPage(),
            ]
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
