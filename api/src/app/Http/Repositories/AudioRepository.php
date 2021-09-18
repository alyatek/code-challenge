<?php

namespace App\Http\Repositories;

use App\Models\Audio;
use Illuminate\Support\Facades\Storage;

class AudioRepository
{
    protected $audio;

    public function __construct(Audio $audio)
    {
        $this->audio = $audio;
    }

    /**
     * Reusable function so we can use it in differente sections of the app if needed
     * to store audio
     *
     * @param [type] $email
     * @param [type] $audioFile
     * @return void
     */
    public function create($email, $audioFile): ?array
    {
        $audioContent = file_get_contents($audioFile->getRealPath());
        $audioHash = md5($audioContent);

        // first i try to store the file
        // if fails it does not continue and errors out
        // observations: I also would validate for file duplications in case it was trying to insert the same audio more than once
        try {
            Storage::disk('local')->put('audios/' . $audioHash . ".wav", $audioContent);
        } catch (\Throwable $e) {
            return null;
        }

        // if stores then i proceed to store in the database the information
        $create = $this->audio;

        $create->audio_hash = $audioHash;
        $create->email = $email;

        $create->save();

        return ["status" => true, "created" => $create];
    }
}
