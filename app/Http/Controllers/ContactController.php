<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|min:3',
            'message' => 'required|min:5',
        ]);

        try {
            // Attempt to save data
            Contact::create([
                'name' => $request->name,
                'message' => $request->message,
            ]);
            Log::info('Form submitted');

            return redirect('/contact')->with('success', true)->with('message', 'Message saved successfully!');
        } catch (Exception $e) {
            // Log the error
            Log::error('Database Error: ' . $e->getMessage());
    
            return redirect('/contact')->with('success', false)->with('message', 'Failed to save message.');
        }
    }

    public function index()
    {
        $messages = Contact::all();
        return view('contact', compact('messages'));
    }
}