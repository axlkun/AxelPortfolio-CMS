<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Settings;
use App\Actions\UploadFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\UploadedFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveAboutRequest;
use App\Http\Resources\SettingsResource;
use App\Http\Requests\SaveContactRequest;

class SettingsController extends Controller
{
    //
    private $settings;

    public function __construct()
    {
        $this->settings = Settings::find(1) ?? new Settings();
    }

    public function create(Request $request){

        return Inertia::render('Settings/Create',[
            'settings' => new SettingsResource($this->settings)
        ]);
    }

    public function saveHero(Request $request){
        $request->validate([
            'description' => ['required' => 'string'],
            'photo' => ['nullable', 'image']
        ]);

        $data['description'] = $request->get('description');

        if($request->file('photo')){

            $this->settings->deletePhoto('data->photo');

            $imageName = (new UploadFile)
                ->setFile($request->file('photo'))
                ->setUploadPath($this->settings->uploadFolder())
                ->execute();

            $data['photo'] = $imageName;

        }

        $this->save($data);

        return redirect()->back();

    }

    public function saveAbout(SaveAboutRequest $request){
       

        $data['about_description'] = $request->get('about_description');

        if($request->file('about_photo')){

            $this->settings->deletePhoto('data->about_photo');

            $imageName = (new UploadFile)
                ->setFile($request->file('about_photo'))
                ->setUploadPath($this->settings->uploadFolder())
                ->execute();

            $data['about_photo'] = $imageName;

        }

        $this->save($data);

        return redirect()->back();

    }

    public function saveContact(SaveContactRequest $request){
       
        $data = $request->only(['email','phone','address','google_map_url']);

        if($request->file('contact_photo')){

            $this->settings->deletePhoto('data->contact_photo');

            $imageName = (new UploadFile)
                ->setFile($request->file('contact_photo'))
                ->setUploadPath($this->settings->uploadFolder())
                ->execute();

            $data['contact_photo'] = $imageName;

        }

        $this->save($data);

        return redirect()->back();

    }

    private function save( array $data): void{

        if($this->settings->data){
            $this->settings->data = array_merge($this->settings->data,$data);
            $this->settings->save();
        }else{
            $this->settings->data = $data;
            $this->settings->save();
        }

        
    }
}
