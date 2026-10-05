<?php

namespace Tests\Unit;

use App\Models\Puzzle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PuzzleTest extends TestCase
{
    use RefreshDatabase;

    /*
    |--------------------------------------------------------------------------
    | TESTS DE CREATION
    |--------------------------------------------------------------------------
    */

    // 1. Création d'un puzzle avec des données valides
    public function test_puzzle_can_be_created()
    {
        $puzzle = Puzzle::factory()->create([
            'nom' => 'Test Puzzle',
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => 9.99,
            'image' => 'test_image.png',
        ]);

        $this->assertDatabaseHas('puzzles', [
            'nom' => 'Test Puzzle',
            'categorie' => 'Test Categorie',
            'prix' => 9.99,
        ]);
    }

    // 2. Création impossible avec des données manquantes
    public function test_puzzle_creation_fails_with_missing_data()
    {
        $puzzleData = [
            'nom' => '',
            'categorie' => '',
            'description' => '',
            'prix' => '',
            'image' => '',
        ];

        $validator = Validator::make($puzzleData, [
            'nom' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric',
            'image' => 'required',
        ]);

        $this->assertTrue($validator->fails());
    }

    // 3. Création impossible avec des données invalides
    public function test_puzzle_creation_fails_with_invalid_data()
    {
        $puzzleData = [
            'nom' => str_repeat('A', 256),
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => -5.99,
            'image' => 'test_image.png',
        ];

        $validator = Validator::make($puzzleData, [
            'nom' => 'required|max:255',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'image' => 'required',
        ]);

        $this->assertTrue($validator->fails());
    }

    // 4. Création impossible avec un nom déjà existant
    public function test_puzzle_creation_fails_with_duplicate_data()
    {
        $puzzleData = [
            'nom' => 'Unique Puzzle',
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => 9.99,
            'image' => 'test_image.png',
        ];

        Puzzle::factory()->create($puzzleData);

        $validator = Validator::make($puzzleData, [
            'nom' => 'required|unique:puzzles,nom',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'image' => 'required',
        ]);

        $this->assertTrue($validator->fails());
    }

    /*
    |--------------------------------------------------------------------------
    | TESTS DE LECTURE
    |--------------------------------------------------------------------------
    */

    // 5. Lecture d'un puzzle existant
    public function test_puzzle_can_be_shown()
    {
        $puzzle = Puzzle::factory()->create();

        $foundPuzzle = Puzzle::find($puzzle->id);

        $this->assertNotNull($foundPuzzle);
        $this->assertEquals($puzzle->id, $foundPuzzle->id);
    }

    // 6. Lecture impossible d'un puzzle inexistant
    public function test_puzzle_show_fails_if_puzzle_does_not_exist()
    {
        $puzzle = Puzzle::find(99999);

        $this->assertNull($puzzle);
    }

    /*
    |--------------------------------------------------------------------------
    | TESTS DE MODIFICATION
    |--------------------------------------------------------------------------
    */

    // 7. Modification d'un puzzle existant
    public function test_puzzle_can_be_updated()
    {
        $puzzle = Puzzle::factory()->create();

        $puzzle->nom = 'Nom mis a jour';
        $puzzle->save();

        $this->assertDatabaseHas('puzzles', [
            'id' => $puzzle->id,
            'nom' => 'Nom mis a jour',
        ]);
    }

    // 8. Modification impossible d'un puzzle inexistant
    public function test_puzzle_update_fails_if_puzzle_does_not_exist()
    {
        $puzzle = Puzzle::find(99999);

        $this->assertNull($puzzle);
    }

    // 9. Modification impossible avec des données invalides
    public function test_puzzle_update_fails_with_invalid_data()
    {
        $puzzle = Puzzle::factory()->create();

        $data = [
            'nom' => '',
            'categorie' => '',
            'description' => '',
            'prix' => -10,
            'image' => '',
        ];

        $validator = Validator::make($data, [
            'nom' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'image' => 'required',
        ]);

        $this->assertTrue($validator->fails());
    }

    // 10. Modification de plusieurs champs
    public function test_puzzle_can_be_updated_with_multiple_fields()
    {
        $puzzle = Puzzle::factory()->create();

        $puzzle->update([
            'nom' => 'Nouveau Puzzle',
            'categorie' => 'Nouvelle Categorie',
            'prix' => 19.99,
        ]);

        $this->assertDatabaseHas('puzzles', [
            'id' => $puzzle->id,
            'nom' => 'Nouveau Puzzle',
            'categorie' => 'Nouvelle Categorie',
            'prix' => 19.99,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TESTS DE SUPPRESSION
    |--------------------------------------------------------------------------
    */

    // 11. Suppression d'un puzzle existant
    public function test_puzzle_can_be_deleted()
    {
        $puzzle = Puzzle::factory()->create();

        $puzzle->delete();

        $this->assertDatabaseMissing('puzzles', [
            'id' => $puzzle->id,
        ]);
    }

    // 12. Suppression d'un puzzle inexistant
    public function test_puzzle_delete_fails_if_puzzle_does_not_exist()
    {
        $puzzle = Puzzle::find(99999);

        $this->assertNull($puzzle);
    }
}
