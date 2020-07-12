<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Pertanyaan;
use Image;

class ProfilController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        // dd($user);
        $countpertanyaan = count($user->pertanyaan);
        $countjawaban = count($user->jawaban);
        $pertanyaan = pertanyaan::all();
        // dd($countjawaban);

        return view ('auth.account', compact('user', 'countpertanyaan', 'countjawaban', 'pertanyaan'));
    }

    public function post(Request $request)
    {
        $data =$request->all();
        $user_id = \Auth::user()->id;

        // $this->validate($request, [
        //     'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        // ]);

        if($request->hasFile('image')){
            $image_temp = $request->file('image');
            if($image_temp->isValid()){

                $extension = $image_temp->getClientOriginalExtension();
                $fileName = rand(111,99999).'.'.$extension;
                $photo_path = 'images/profile/'.$fileName;

                //Resize images
                Image::make($image_temp)->resize(350,330)->save($photo_path);
            }
        }elseif(!empty($data['current_image'])){
            $fileName = $data['current_image'];
        }else {
            $fileName = '';
        }
        \DB::table('users')->where(['id'=>$user_id])->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => $data['password'],
            'foto' => $fileName,
        ]);

        return redirect()->back()->with('status', 'Profil berhasil diupdate');
    }
}
