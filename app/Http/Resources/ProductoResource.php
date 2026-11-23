<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'     => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion ?? '',
            'precio'      => (float)$this->precio,
            'precio_hn1'  => 'L. ' . number_format($this->precio,2),
            'stock' => (int) $this->stock,
            'disponibilidad' => $this->stock > 0 ? 'En Existencia' : 'No Disponible',
            'fecha_registro' => $this->created_at ? $this->created_at->format('d-m-Y H:i A') : '',
        ];
    }
}
