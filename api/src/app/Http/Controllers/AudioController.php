<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AudioRepository;
use App\Models\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AudioController extends Controller
{

    protected $audioRepository;
    public function __construct(AudioRepository $audioRepository)
    {
        $this->audioRepository = $audioRepository;
    }

    // for demonstration reasons I will only validate this one file type
    protected $allowedFileTypes = [
        "audio/x-wav"
    ];

    public function create()
    {
        $validate = Validator::make(request()->all(), $this->createValidations());

        if ($validate->fails()) {
            return response()->json([
                "status" => false,
                "message" => "missing fields",
                "fields" => $validate->errors()
            ]);
        }

        $audioFile = request()->file('audio');

        if (!in_array($audioFile->getMimeType(), $this->allowedFileTypes)) {
            return response()->json(["status" => false, "message" => "this file type is not allowed"]);
        }

        $create = $this->audioRepository->create(request()->email, request()->file('audio'));

        if ($create["status"]) {
            return response()->json(["status" => true, "message" => "Your audio will be processed shortly!"]);
        }

        return response()->json(["status" => false, "message" => "Something went wrong. Sorry!"]);
    }

    protected function createValidations()
    {

        return [
            "email" => "required|email",
            "audio" => "required|file|max:5000" // checks if file is not more than 5 mb
        ];
    }
}
