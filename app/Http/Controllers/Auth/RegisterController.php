<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Restaurant;
use App\Models\Design;
use \Auth;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = RouteServiceProvider::LOGIN;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        Auth::logout();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'restoname' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'lat' => ['required', 'string', 'max:255'],
            'lon' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'restaurant_id' => 999,
            'role' => 0,
        ]);

        // Enregistrement dans la table 'restaurants'
        $restaurant = new Restaurant();
        $restaurant->name = $data['restoname']; // Nom du restaurant
        $restaurant->mobile = $data['mobile']; // Numéro de mobile
        $restaurant->address = $data['address']; // Adresse
        $restaurant->lat = $data['lat']; // Code postal
        $restaurant->lon = $data['lon']; // Ville
        $restaurant->admin_id = $user->id; // admin_id par défaut égal à l'id de l'utilisateur
        $restaurant->created_at = now(); // Date de création
        $restaurant->active = 1; // Valeur par défaut pour le champ 'active' est 1
        $restaurant->ref_client = uniqid(); // Génération d'une chaîne aléatoire unique

        $user->restaurant()->save($restaurant);

        $design = new Design();
        $design->restaurant_id = $restaurant->id;
        $design->save();



        $directoryPath = 'images/' . $restaurant->id . '';

        if (!File::isDirectory($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true, true);
        }

        $Newuser = User::findOrFail($user->id);
        $Newuser->restaurant_id = $restaurant->id;
        $Newuser->role = 'ROLE_USER';

        $Newuser->save();

        // dd($Newuser);

        if (isset($data['parrain_id'])) {
        	$parrain_id = $data['parrain_id'];
        	$this->redirectTo = 'https://monmenu.io/api/?create=a&username=' . $user->email . '&email=' . $user->email . '&password=' . $data["password"] . '&parrain_id='.$parrain_id.'';
        }else{
        	$this->redirectTo = 'https://monmenu.io/api/?create=a&username=' . $user->email . '&email=' . $user->email . '&password=' . $data["password"] . '';

        }




        Auth::logout();

        return $user;
    }
}
