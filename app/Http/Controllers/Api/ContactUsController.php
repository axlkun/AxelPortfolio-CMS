<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Mail\SentContactUsMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function store(Request $request){
        
        $data = $request->validate([
            'name' => ['required','string','max:100'],
            'email' => ['required','string','email','max:100'],
            'phone' => ['required','string','max:20'],
            'message' => ['required','string','max:500']
        ]);

        Mail::to('contact@axelcruz.com')->send(new SentContactUsMail($data));

        return response()->json([
            'message' => "Your message has been sent succesfully."
        ]);
    }
}
