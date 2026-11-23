<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
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
            'cargo' => $this->cargo,
            'salario' => $this->salario,
            'fecha_registro' => $this->created_at ? $this->created_at->format('d-m-Y H:i A') : '',
        ];
    }
}
