<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('home', compact('categories', 'products'));
    }
    public function contact()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('contact', compact('categories', 'products'));
    }
    public function submitContactForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

    Mail::send('emails.contact', [
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'messageContent' => $request->message,
    ], function ($message) use ($request) {
        $message->to('sales@bazar-mart.in/')
                ->subject('Contact Form: ' . $request->subject)
                ->replyTo($request->email, $request->name);
    });

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
    public function termsAndConditions()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('termsandconditions', compact('categories', 'products'));
    }
    public function privacyPolicy()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('refundandreturnpolicy', compact('categories', 'products'));
    }
    public function aboutus()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('aboutus', compact('categories', 'products'));
    }

}
