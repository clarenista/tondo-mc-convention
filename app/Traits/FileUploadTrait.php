<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadTrait
{

    public function uploadFile(Model $model, $table = 'url')
    {

        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $file_name = Str::slug(time() . "-" . $file->getClientOriginalName());
            $file->storeAs("{$model->type}/", $file_name);
            $model->update([
                $table => Storage::url("{$model->type}/{$file_name}"),
            ]);
        }
    }
}
