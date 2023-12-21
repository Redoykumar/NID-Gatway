<?php

namespace App\Http\Controllers;

use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class NidController extends Controller
{
    public function getNidInfo(Request $request)
    {

        $validateUser = Validator::make(
            $request->all(),
            [
                'nid17Digit' => ['required_without:nid10Digit', 'regex:/^\d{17}$/'],
                'nid10Digit' => ['required_without:nid17Digit', 'regex:/^\d{10}$/'],
                'dateOfBirth' => 'required|date'
            ],

            [
                'nid17Digit.required_without' => 'At least one of :attribute or :other is required.',
                'nid17Digit.regex' => 'The :attribute must be exactly 17 digits.',
                'nid10Digit.required_without' => 'At least one of :attribute or :other is required.',
                'nid10Digit.regex' => 'The :attribute must be exactly 10 digits.',
            ],

        );

        $faker = Faker::create();
        $info = [
            "nationalId" => isset($request->nid17Digit) ? $request->nid17Digit : $request->nid10Digit,
            "name" => "আলম",
            "nameEn" => fake()->name(),
            "father" => "মান্নান",
            "mother" => "নাহার",
            "spouse" => "নাহার",
            "dateOfBirth" => fake()->date(),
            "permanentAddress" => [
                "division" => "রংপুর",
                "district" => "দিনাজপুর",
                "rmo" => "2",
                "upozila" => "সির",
                "postOffice" => "দিনাজপুর",
                "postalCode" => "5200",
                "additionalMouzaOrMoholla" => "এ",
                "additionalVillageOrRoad" => "ব্ল ক নং",
                "homeOrHoldingNo" => "এ",
                "region" => "রংপুর"
            ],
            "presentAddress" => [
                "division" => "রংপুর",
                "district" => "দিনাজপুর",
                "rmo" => "2",
                "upozila" => "সির",
                "postOffice" => "দিনাজপুর",
                "postalCode" => "5200",
                "additionalMouzaOrMoholla" => "এ",
                "additionalVillageOrRoad" => "ব্ল ক নং",
                "homeOrHoldingNo" => "এ",
                "region" => "রংপুর"
            ],
            "photo" => "https://www.gravatar.com/avatar/" . md5($faker->email) . "?d=https://via.placeholder.com/150",
        ];


        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }


        return response()->json([
            'status' => 'OK',
            'statusCode' => false,
            'message' => 'Get NID Successfully',
            'data' => $info
        ], 200);
    }
}
