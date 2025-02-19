<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livres = Livre::with('categorie')->get();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $livres
            ]);
        }

        return view('livres.index', compact('livres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $livres = Livre::all();
        $categories = Categorie::all();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'livres' => $livres,
                    'categories' => $categories
                ]
            ]);
        }

        return view('livres.create', compact('livres', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'titre' => 'required',
                'pages' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'categorie_id' => 'required|exists:categories,id',
            ]);

            $photoPath = $request->file('image')->store('images', 'public');

            $livre = Livre::create([
                'titre' => $validated['titre'],
                'pages' => $validated['pages'],
                'description' => $validated['description'],
                'image' => $photoPath,
                'categorie_id' => $validated['categorie_id'],
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Livre ajouté avec succès.',
                    'data' => $livre
                ]);
            }

            return redirect()->route('livres.index')
                ->with('success', 'Livre ajouté avec succès.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de l\'ajout du livre.',
                    'errors' => $e->getMessage()
                ], 422);
            }

            return back()->withErrors(['error' => 'Erreur lors de l\'ajout du livre.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livre = Livre::with('categorie')->findOrFail($id);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $livre
            ]);
        }

        return view('livres.show', compact('livre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livre $livre)
    {
        $livres = Livre::all();
        $categories = Categorie::all();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'livre' => $livre,
                    'categories' => $categories
                ]
            ]);
        }

        return view('livres.edit', compact('livre', 'livres', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livre $livre)
    {
        try {
            $validated = $request->validate([
                'titre' => 'required',
                'pages' => 'required',
                'description' => 'required',
                'categorie_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($livre->image) {
                    Storage::disk('public')->delete($livre->image);
                }

                $photoPath = $request->file('image')->store('images', 'public');
                $validated['image'] = $photoPath;
            }

            $livre->update($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Livre modifié avec succès.',
                    'data' => $livre
                ]);
            }

            return redirect()->route('livres.index')
                ->with('success', 'Livre modifié avec succès.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de la modification du livre.',
                    'errors' => $e->getMessage()
                ], 422);
            }

            return back()->withErrors(['error' => 'Erreur lors de la modification du livre.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livre $livre)
    {
        try {
            // Delete the image file
            if ($livre->image) {
                Storage::disk('public')->delete($livre->image);
            }

            $livre->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Livre supprimé avec succès.'
                ]);
            }

            return redirect()->route('livres.index')
                ->with('success', 'Livre supprimé avec succès.');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de la suppression du livre.',
                    'errors' => $e->getMessage()
                ], 422);
            }

            return back()->withErrors(['error' => 'Erreur lors de la suppression du livre.']);
        }
    }
}
