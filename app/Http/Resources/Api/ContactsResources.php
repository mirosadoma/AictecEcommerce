<?php

namespace App\Components\ContactUs\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ContactsResources extends JsonResource
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
            'id'                => (int) $this->id,
            'name'              => (string) $this->name ?? '',
            'phone'             => (string) $this->phone ?? '',
            'message'           => (string) $this->message ?? '',
            'created_date'      => (string) $this->created_at ? $this->created_at->toDateString() : "",
            'created_time'      => (string) $this->created_at ? $this->created_at->toTimeString() : "",
            'reply'             => (string) $this->reply ?? '',
            'reply_date'        => (!is_null($this->reply_date)) ? Carbon::parse($this->reply_date)->toDateString() : "",
            'reply_time'        => (!is_null($this->reply_date)) ? Carbon::parse($this->reply_date)->toTimeString() : "",
        ];
    }
}
