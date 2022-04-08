<?php

namespace App\Transformers;

class NoticeTransformer
{
    /**
     * Receive the array to transform.
     */
    public static function transform($notices)
    {
        $response = [];
        foreach ($notices as $notice) {
            $response[] = [
                'id' => $notice->id,
                'name' => $notice->name,
                'description' => $notice->description,
                'category' => $notice->category->name
            ];
        }
        return $response;
    }
}
