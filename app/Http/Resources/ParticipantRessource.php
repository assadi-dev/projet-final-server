<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "email" => $this->resource->email,
            "token" => $this->resource->token,
            "survey_id" => $this->resource->survey->id,
            "survey" => $this->resource->survey->title,
            "created_at" => $this->resource->created_at
        ];
    }
}
