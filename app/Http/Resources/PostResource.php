<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'image' => asset($this->image),
            'category_id' => $this->category_id,
            'created_at' => $this->created_at->format('y-m-d'),
            'title' => $this->title,
            'content' => $this->content,
            'smallDesc' => $this->smallDesc,
            'tags' => $this->tags,
            'blog' => $this->content . $this->smallDesc,
            'writer' => $this->whenLoaded('user'),
            'category' => CategoryResource::make($this->whenLoaded('category')),
        ];
    }
}
