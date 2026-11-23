<?php



namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductoResource;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producto  = Producto::orderBy('id', 'DESC')->paginate(10);
        return response()->json([
           'success' => true,
           'data' => ProductoResource::collection($producto),
           'pagination' => [
               'total' => $producto->total(),
               'current_page' => $producto->currentPage(),
               'per_page' => $producto->perPage(),
               'last_page' => $producto->lastPage(),
           ]
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validados = $request->validate([
            'codigo_barras' => 'required|string|unique:productos,codigo_barras|max:30',
            'nombre' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $producto = Producto::create($validados);
        return response()->json([
            'status' => 'created',
            'message' => 'El producto se ha creado correctamente',
            'data' => new ProductoResource($producto),
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::find($id);
        if (is_null($producto)) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'El producto que busca no existe'
            ],404);
        }
            return response()->json([
                'status' => 'success',
                'data' => new ProductoResource($producto),
                ],200
            );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::find($id);
        if (is_null($producto)) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'El producto que busca no existe'
            ],404);
        }
        $validados = $request->validate([
            'nombre' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
        ]);

        $producto->update($validados);
        return response()->json([
            'status' => 'updated',
            'message' => 'El producto se ha actualizado correctamente',
            'data' => new ProductoResource($producto),
        ],200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);
        if (is_null($producto)) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'El producto que busca no existe'
            ],404);

        }
        $producto->delete();
        return response()->json([
            'status' => 'deleted',
            'message' => 'El producto se ha eliminado correctamente',
        ],200);
    }
}
