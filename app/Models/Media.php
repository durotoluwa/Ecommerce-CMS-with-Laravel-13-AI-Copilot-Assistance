<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'file_name',
        'file_path',
        'mime_type',
        'uploaded_by',
    ];

    // If you want to cast file_path to always return a full URL
    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    // Relationship: who uploaded the file
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
