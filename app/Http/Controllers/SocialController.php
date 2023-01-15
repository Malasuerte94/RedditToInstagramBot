<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use Exception;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
     
            if($isUser){
                FacadesAuth::login($isUser);
                return redirect('/dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123')
                ]);
    
                FacadesAuth::login($createUser);
                return redirect('/dashboard');
            }
    
        } catch (Exception $exception) {
            dd('We have a problem...' . $exception);
        }
    }
}