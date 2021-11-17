<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index() {
        $posts = Post::all();
        return view('guest.home', compact('posts'));
    }

    public function contact() {
        return view('guest.contacts');
    }
    
    public function handleContactForm(Request $request){
        // salviamo a db i dati inseriti nel form di contatto
        $form_data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();
        // inviamo la mail all'admin del sito, passando il nuovo oggetto Lead
        Mail::to('info@boolpress.com')->send(new SendNewMail($new_lead));
        return redirect()->route('contacts.thank-you');
    }

    public function thankYou() {
        return view('guest.thank-you');
    }

}
