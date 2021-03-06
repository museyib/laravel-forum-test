<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store()
    {
        $data = \request()->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        Mail::to('museyib.e@gmail.com')->send(new ContactFormMail($data));

        return redirect('contact')->with('message', 'Thanks for your message.');
    }
}
