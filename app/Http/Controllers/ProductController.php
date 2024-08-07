<?php

namespace App\Http\Controllers;

use Image;
use Auth;

use Illuminate\Support\Str;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use \App\Models\Restaurant;

class ProductController extends Controller
{
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([]);
        if (!$request->category_id || $request->category_id === null || $request->category_id === '') {
            return redirect('admin?task=products')
                ->with('error', 'Votre produit ne contient de catégorie et n\'a pas été ajouté, séléctionnez en une pour ajouter un produit');
        }
        $product = new Product();

        $product->name = $request->name;
        $product->content = $request->content;
        $product->price = $request->price;
        // $product->allergenes = $request->allergenes;
        $product->appellations = json_encode($request->appellations, JSON_UNESCAPED_UNICODE);
        $product->allergenes_list = json_encode($request->allergenes, JSON_UNESCAPED_UNICODE);

        // dd($product->allergenes_list);
        if ($request->active === "on") {
            $product->active = 1;
        } else {
            $product->active = 0;
        }

        $product->save();

        /**
         * @todo Nomenclature renommage image
         */


        if ($request->hasFile('image')) {
            $image = $request->file('image')->getRealPath();
            $imageName = session('restau_id') . '-prod-' . $product->id . '.png';

            $imgFile = Image::make($image);
            $imgFile->encode('png', 100)->save('images/' . session('restau_id') . '/' . $imageName, 100);

            $product->image = $imageName;
        }
        $product->save();

        $product->categories()->attach($request->category_id);


        return redirect('admin?task=products')
            ->with('success', 'Votre produit à été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {

        $product = Product::findOrFail($id);


        // echo "<pre>";
        // print_r($product);
        // echo "</pre>";
        //
        // die();

        $product->name = $request->name;
        $product->content = $request->content;
        $product->price = $request->price;
        $product->allergenes = $request->allergenes;
        $product->appellations = json_encode($request->appellations, JSON_UNESCAPED_UNICODE);
        $product->allergenes_list = json_encode($request->allergenes, JSON_UNESCAPED_UNICODE);
        $categorie_id = $request->categorie;

        // dd($request->active);


        if ($request->active) {
            $product->active = 1;
        } else {
            $product->active = 0;
        }

        if ($request->featured) {
            $product->featured = 1;
        } else {
            $product->featured = 0;
        }



        $product->save();

        /**
         * @todo Nomenclature renommage image
         */
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image s'il en existe une
            if ($product->image) {
                $oldImagePath = ('images/' . session('restau_id') . '/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image')->getRealPath();
            $imageName = session('restau_id') . '-prod-' . $product->id . '.png';

            $imgFile = Image::make($image);
            $imgFile->encode('png', 5)->save('images/' . session('restau_id') . '/' . $imageName, 5);
            $product->image = $imageName;
            $product->save();
        }

        $categorie = Category::find($categorie_id);
        $oldCategorie = Category::find($request->old_cat);

        if ($request->categorie_id !== $request->old_cat) {
            $oldCategorie->products()->detach($product->id);
            $categorie->products()->attach($product->id);
        }

        //  $product->categories()->attach($request->category_id);
        return redirect('admin?task=products')
            ->with('success', 'Votre produit à été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect('admin?task=products')
            ->with('success', 'Votre produit à été supprimé avec succès');
    }


    public function addOneView($id)
    {
        $product = Product::findOrFail($id);
        $lastSeen = $product->seen;
        $newSeen = $lastSeen + 1;
        $product->seen = $newSeen;
        $product->save();
    }


    public function mostViewedProducts()
    {
        $id = session('restau_id');
        $allcategories = Category::where('restaurant_id', $id)
            ->get();
        $allcategoryIds = $allcategories->pluck('id')->toArray();

        $mostViewedProducts = Product::whereHas('categories', function ($query) use ($allcategoryIds) {
            $query->whereIn('categories.id', $allcategoryIds);
        })
            ->orderBy('seen', 'desc')
            ->limit(3)
            ->get();

        return response()->json($mostViewedProducts);
    }


    public function showOne($id, $resto_id)
    {

        $productId = $id;
        $product = Product::findOrFail($productId);
        $restaurant = Restaurant::find($resto_id);
        $lastSeen = $product->seen;
        $newSeen = $lastSeen + 1;
        $product->seen = $newSeen;

        $this->addOneView($productId);

        $product->save();

        return view('product', compact('product', 'resto_id', 'restaurant'));
    }



    public function updateOrder(Request $request)
    {
        $productId = $request->input('product_id');
        $newIndex = $request->input('new_index');

        try {
            $product = Product::findOrFail($productId);

            // Mise à jour de l'ordre du produit
            $product->display_order = $newIndex;
            $product->save();

            return response()->json(
                [
                    'message' => 'Produit mis à jour avec succès !',
                    'item_order' => $product->display_order
                ]
            );
        } catch (\Exception $e) {
            // Gérer les erreurs éventuelles
            return response()->json(['message' => 'Une erreur est survenue lors de la mise à jour du produit.']);
        }
    }

    public function deleteProductImage($id)
    {
        $product = Product::find($id);

        if ($product->image) {
            $oldImagePath = 'images/' . session('restau_id') . '/' . $product->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $product->image = null;

        $product->save();

        return redirect('admin?task=products')
            ->with('success', 'L\'image de votre produit à été supprimé avec succès');
    }

    public function addVariant(Request $request)
    {

        $product = Product::find($request->product_id);

        $variant = new ProductVariant();

        $variant->name = $request->name;
        $variant->content = $request->content;
        $variant->product_id = $request->product_id;

        if ($request->price) {
            $variant->price = $request->price;
        } else {
            $variant->price = $product->price;
        }

        $variant->save();

        return redirect('admin?task=products')
            ->with('success', 'La variante à été ajouté avec succès');
    }

    public function updateVariant(Request $request)
    {
        $variant = ProductVariant::find($request->id);

        $variant->name = $request->name;
        $variant->content = $request->content;
        $variant->product_id = $request->product_id;

        if ($request->price) {
            $variant->price = $request->price;
        } else {
            $variant->price = $variant->product->price;
        }

        $variant->save();

        return redirect('admin?task=products')
            ->with('success', 'La variante à été modifié avec succès');
    }

    public function deleteVariant($id)
    {
        $variant = ProductVariant::find($id);

        $variant->delete();

        return redirect('admin?task=products')
            ->with('success', 'La variante à été supprimé avec succès');
    }
}
