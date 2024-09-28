<?php

namespace App\Services;

class ImageService
{
    public function uploadImage($model, $image, $collectionName)
    {
        if ($image) {
            $model->addMedia($image)->toMediaCollection($collectionName);
        }
    }
}

