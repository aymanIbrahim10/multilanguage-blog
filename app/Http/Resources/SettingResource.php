<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'title' => $this->title,
            'desc' => $this->describtion,
            'email' => $this->email,
            'logo' => asset($this->logo),
            'favicon' => asset($this->favicon),
            'facebook-url' => $this->facebook,
            'instagram' => $this->instagram,
            'created' => $this->created_at->format('y-d-m'),

        ];
    }
}
