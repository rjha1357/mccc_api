<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'is_active' => $this->is_active,
            'is_delete' => $this->is_delete,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
