<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function index()
    {
        $panier = session()->get('panier', []);

        return view('panier.index', compact('panier'));
    }

    public function ajouter(Puzzle $puzzle)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$puzzle->id])) {
            $panier[$puzzle->id]['quantite']++;
        } else {
            $panier[$puzzle->id] = [
                'nom' => $puzzle->nom,
                'prix' => $puzzle->prix,
                'image' => $puzzle->image,
                'quantite' => 1,
            ];
        }

        session()->put('panier', $panier);

        return redirect()->route('panier.index')
            ->with('message', 'Produit ajouté au panier !');
    }

    public function modifier(Request $request, Puzzle $puzzle)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $panier = session()->get('panier', []);

        if (isset($panier[$puzzle->id])) {
            $panier[$puzzle->id]['quantite'] = $request->quantite;
        }

        session()->put('panier', $panier);

        return redirect()->route('panier.index')
            ->with('message', 'Quantité modifiée !');
    }

    public function supprimer(Puzzle $puzzle)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$puzzle->id])) {
            unset($panier[$puzzle->id]);
        }

        session()->put('panier', $panier);

        return redirect()->route('panier.index')
            ->with('message', 'Produit supprimé du panier !');
    }
}