<?php

namespace App\Http\Livewire\Public\Pedido;

use App\Models\Pedido;
use Livewire\Component;

class ListPedido extends Component
{
    public $pedidos;
    public $visitas = 0;

    public function mount()
    {
        $userId = auth()->user()->id;
        $this->pedidos = Pedido::GetPedidosByUsuario($userId);
    }

    public function render()
    {
        return view('livewire.public.pedido.list-pedido')->layout('layouts.public', ['fondo' => false]);
    }
}
