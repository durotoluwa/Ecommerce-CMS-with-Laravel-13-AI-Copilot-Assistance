<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteConfig extends Model
{
    use HasFactory;
    protected $table = 'websiteconfig'; 
    protected $fillable = [
        'companyName',
        'tagline',
        'cookie_message',
        'cookie_status',
        'cookie_url',
        'error_page',
        'breadcrumb',
        'default_avatar',
        'maintenance_status',
        'maintenance_image',
        'maintenance_text',
        'tawkto_status',
        'tawkto',
        'main_logo',
        'white_logo',
        'favicon',
        'footer_logo',
        'primary_color',
        'secondary_color',
        'text_color',
        'footer_bgcolor',
        'footer_titlecolor',
        'footer_textcolor',
        'copywrite_bg',
        'copywrite_textcolor',
        'copywrite_text',
        'terms_condition',
        'privacy_policy',
        'phone1',
        'phone2',
        'phone3',
        'email1',
        'email2',
        'email3',
        'address',
        'google_map',
        'facebook_link',
        'x_link',
        'instagram_link',
        'linkedin_link',
        'youtube_link',
        'footer_content',
        'copywrite',
        'menu_code',
        'description',
        'keywords',
        'website_url',
        'seo_image', 
        'main_logosize',
        'white_logosize',  
        'sizelogo',
        'career_email',
        'contact_email',
        'heading_font_style',
        'text_font',
        'menu_font',
        'heading_weight',
        'text_weight',
        'menu_weight',
        'body_color',
        'heading_colour'
    ];
}
