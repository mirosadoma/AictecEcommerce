<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\SiteSocialsResources;
use App\Models\Settings\SiteSocial;

class SiteSettingsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $site_socials = SiteSocial::all();
        $data = [
            'email'             => (string) $this->email,
            'phone'             => (string) $this->phone,
            'tax'               => (float) $this->tax,
            'delivery_charge'   => (float) $this->delivery_charge,
            'logo'              => (string) $this->logo_path,
            'icon'              => (string) $this->icon_path,
            'footer_logo'       => (string) $this->footer_logo_path,
            'socials'           => (array) $site_socials->count() ? SiteSocialsResources::collection($site_socials) : [],
        ];
        return $data;
    }
}
