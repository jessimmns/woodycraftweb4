<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Puzzle;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();

        return view('categories.index', compact('categories'));
    }

    public function show(Categorie $categorie)
    {
        $puzzles = Puzzle::where('categorie', $categorie->nom)->get();

        return view('categories.show', compact('categorie', 'puzzles'));
    }
}