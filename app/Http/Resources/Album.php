<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Artist as ArtistResource;
use App\Http\Resources\SongNoAlbum as SongResource;


class Album extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'year' => $this->year,
            'songs' => SongResource::collection($this->songs),
            'image' => $this->image,
            'artists' => ArtistResource::collection($this->artists),
        ];
    }
}
