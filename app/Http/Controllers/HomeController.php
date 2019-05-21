<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Constraint\Exception;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages/home');
    }

    public function image()
    {
        return view('pages/image');
    }

    public function getZipCode(Request $request)
    {
        \Log::debug($request->all());

        $zipcodes = json_decode(config('postalcode'), true);

        foreach ($zipcodes as $key => $zip) {
            try {
                if ($zip["pc"] === $request->zipcode) {
                    return response()->json($zip["value"]);
                }
            } catch (Exception $e) {
                \Log::error($e);
            }
        }
        return response()->json(false);
    }

    public function postContact(ContactRequest $request)
    {
        \Log::info("veio");

        try {
            Mail::to(env("EMAIL_TO_CONTACT"))->send(new Contact($request));
        } catch (Exception $e) {
            \Log::error($e);
            return response("Ein Fehler ist aufgetreten", 500);
            return false;
        }
        return response("E-Mail erfolgreich gesendet!", 200);
    }
}
