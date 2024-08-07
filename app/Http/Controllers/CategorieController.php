<?php

namespace App\Http\Controllers;

use Image;
use Auth;

use Illuminate\Support\Str;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class CategorieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategorieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'bail|required|between:1,20',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:12048000',
        // ]);

        $categorie = new Category();
        $categorie->name = $request->name;

        if ($request->is_main == 0 && $request->parent_id) {
            $categorie->parent_id = $request->parent_id;
        }

        if (!$request->parent_id) {
            $categorie->is_main = 1;
        } else {

            $categorie->is_main = 0;
        }
        // if ($request->parent_id != 0) {
        //     $categorie->is_main = 0;
        // }else{
        //     $categorie->is_main = 1;
        // }
        // dd($request->all());
        $categorie->content = $request->content;
        $categorie->restaurant_id = session('restau_id');
        $categorie->active = 1;
        $categorie->slug = Str::slug($request->name, '-');
        $categorie->image = $request->image;

        // Vérifier si une nouvelle image a été soumise
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $destinationPath = public_path('/images');
        //     $imgFile = Image::make($image->getRealPath());
        //     $imageName = session('restau_id') . 'cat-' . $categorie->slug . '.webp';
        //     $imgFile->encode('webp', 5)->save(public_path('images/' . session('restau_id') . '/' . $imageName), 5);
        //     $categorie->image = $imageName;
        // }

        $categorie->save();

        if ($request->parent_id != 0 && $categorie->id != $request->parent_id) {

            $parent_cat = Category::find($request->parent_id);

            $childsList = $parent_cat->childs;

            // dd($parent_cat);

            if ($parent_cat) {

                if ($childsList == null) {
                    $childsList = [$categorie->id];
                }

                if (!in_array($categorie->id, $childsList)) {
                    array_push($childsList, $categorie->id);
                }
                $parent_cat->childs = $childsList;
            }



            $parent_cat->save();
        }

        return redirect('admin?task=categories')
            ->with('success', 'Votre catégorie à été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategorieRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {



        $categorie = Category::findOrFail($id);


        if ($request->parent_id) {
            if ($categorie->parent_id) {
                if ($categorie->parent_id !== $request->parent_id) {
                    $lastCategory = Category::find($categorie->parent_id);
                    $catId = $categorie->id;

                    $newChilds = array_filter($lastCategory->childs, function ($valeur) use ($catId) {
                        return $valeur !== $catId;
                    });

                    $lastCategory->childs =  $newChilds;

                    $newCategory = Category::find($request->parent_id);


                    if ($newCategory->childs !== null) {
                        $newCatChilds = $newCategory->childs;
                        array_push($newCatChilds, $categorie->id);
                    } else {
                        $newCatChilds = [$categorie->id];
                    }

                    $newCategory->childs = $newCatChilds;

                    $newCategory->save();
                    $lastCategory->save();
                }
            }
            $categorie->parent_id = $request->parent_id;
            $categorie->is_main = 0;
        }
        // Valider les champs du formulaire
        // $request->validate([
        //     'name' => 'bail|required|between:1,20',
        //     'image' => 'image|mimes:jpeg,png,jpg,webp|max:10000000',
        // ]);

        // Mettre à jour les champs de la catégorie
        $categorie->name = $request->name;
        $categorie->slug = Str::slug($request->name, '-');
        if ($request->content) {
            $categorie->content = $request->content;
        }
        $categorie->image = $request->image;
        // Vérifier si une nouvelle image a été soumise
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $destinationPath = public_path('/images');
        //     $imgFile = Image::make($image->getRealPath());
        //     $imageName = session('restau_id') . '-cat-' . $categorie->slug . '.webp';
        //     $imgFile->encode('webp', 5)->save(public_path('images/' . session('restau_id') . '/' . $imageName), 5);
        //     $categorie->image = $imageName;
        //     // dd($categorie);
        // }

        // dd($categorie);
        $categorie->save();
        Cache::flush();
        return redirect('admin?task=categories')
            ->with('success', 'Votre catégorie à été modifié avec succès');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        //
    }


    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $products = $category->products()->get();


        $categoryChildsId = $category->childs;

        if ($category->parent_id) {

            // Mettre à jour les catégories parentes pour retirer la catégorie de la liste des enfants
            $parentCategory = Category::find($category->parent_id);

            if ($parentCategory) {

                $monTableau = $parentCategory->childs;
                $index = array_search($category->id, $monTableau);

                if ($index !== false) {
                    unset($monTableau[$index]);
                }
                $parentCategory->childs = $monTableau;
                $parentCategory->save();
            }
        }
        if ($category->childs) {
            if (count($categoryChildsId) > 0 || $categoryChildsId !== null) {
                $subCatProducts = [];
                foreach ($categoryChildsId as $id) {

                    $subCategory = Category::find($id);

                    $subProducts = $subCategory->products()->get();
                    if (count($subProducts) > 0 && $subProducts !== null) {
                        $subCatProducts = $subProducts;
                    }
                    $subCategory->delete();
                }

                foreach ($subCatProducts as $item) {
                    $item->delete();
                }
            }
        }

        foreach ($products as $product) {
            $product->delete();
        }

        // Supprimer tous les produits associés à la catégorie
        $category->products()->detach();

        $category->delete();
        return redirect('admin?task=categories')
            ->with('success', 'Votre catégorie à été supprimé avec succès');
    }


    public function mostViewedCats()
    {
        $id = session('restau_id');
        $mostViewedCats = Category::orderBy('seen', 'desc')
            ->where('restaurant_id', $id)
            ->limit(3)
            ->get();

        return response()->json($mostViewedCats);
    }

    public function updateOrder(Request $request)
    {
        $categoryId = $request->input('category_id');
        $newIndex = $request->input('new_index');

        try {
            $category = Category::findOrFail($categoryId);

            // Mise à jour de l'ordre du produit
            $category->display_order = $newIndex;
            $category->save();

            return response()->json(
                [
                    'message' => 'Catégorie mise à jour avec succès !',
                    'item_order' => $category->display_order
                ]
            );
        } catch (\Exception $e) {
            // Gérer les erreurs éventuelles
            return response()->json(['message' => 'Une erreur est survenue lors de la mise à jour du produit.']);
        }
    }
    public function allOrder(Request $request)
    {

        $categoryId = $request->input('category_id');
        $newIndex = $request->input('new_index');

        try {
            $category = Category::findOrFail($categoryId);

            // Mise à jour de l'ordre du produit
            $category->display_order = $newIndex;
            $category->save();

            return response()->json(
                [
                    'message' => 'Catégorie mise à jour avec succès !',
                    'item_order' => $category->display_order
                ]
            );
        } catch (\Exception $e) {
            // Gérer les erreurs éventuelles
            return response()->json(['message' => 'Une erreur est survenue lors de la mise à jour du produit.']);
        }
    }
}
