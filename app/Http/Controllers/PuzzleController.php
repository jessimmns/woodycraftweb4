<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;

class PuzzleController extends Controller
{
    public function index()
    {
        $puzzles = Puzzle::all();

        return view('puzzles.index', compact('puzzles'));
    }

    public function create()
    {
        return view('puzzles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'prix' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Puzzle::create($data);

        return redirect()->route('puzzles.index')
            ->with('message', 'Puzzle créé avec succès');
    }

    public function show(Puzzle $puzzle)
    {
        return view('puzzles.show', compact('puzzle'));
    }

    public function edit(Puzzle $puzzle)
    {
        return view('puzzles.edit', compact('puzzle'));
    }

    public function update(Request $request, Puzzle $puzzle)
    {
        $data = $request->validate([
            'nom' => 'required|max:100',
            'categorie' => 'required|max:100',
            'description' => 'required|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'prix' => 'required|numeric|between:0,99.99',
        ]);

        $puzzle->nom = $request->nom;
        $puzzle->categorie = $request->categorie;
        $puzzle->description = $request->description;

        if ($request->hasFile('image')) {
            $puzzle->image = $request->file('image')->store('images', 'public');
        }

        $puzzle->prix = $request->prix;

        $puzzle->save();

        return redirect()->route('puzzles.index')
            ->with('message', 'Puzzle modifié avec succès !');
    }

    public function destroy(Puzzle $puzzle)
    {
        $puzzle->delete();

        return redirect()->route('puzzles.index')
            ->with('message', 'Puzzle supprimé avec succès !');
    }
}