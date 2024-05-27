<?php

namespace App\Observers;

use App\Models\Movement;
use App\Models\Product;

class MovementObserver
{
    /**
     * Handle the Movement "created" event.
     */
    public function created(Movement $movement): void
    {
        // dd($movement->getAttributes()['product_id']);
        
        //agregar iffiset xD  para evitar cosas raras

        //tomamos el id del producto
        $id_product = $movement->getAttributes()['product_id'];
        //tomamos el tipo de movimiento
        $type = $movement->getAttributes()['type'];

        $cantidad = $movement->getAttributes()['stock'];
        
        if ($type=="salida") {
            $cantidad = $cantidad * -1;
        }
            
        // buscamos ese ID en la tabla producto y lo asignamos
        $product = Product::find($id_product);
        $product->quantity = $product->quantity + $cantidad;
        $product->push();
        //
    }

    /**
     * Handle the Movement "updated" event.
     */
    public function updated(Movement $movement): void
    {
        //
    }

    /**
     * Handle the Movement "deleted" event.
     */
    public function deleted(Movement $movement): void
    {
        //
    }

    /**
     * Handle the Movement "restored" event.
     */
    public function restored(Movement $movement): void
    {
        //
    }

    /**
     * Handle the Movement "force deleted" event.
     */
    public function forceDeleted(Movement $movement): void
    {
        //
    }
}
