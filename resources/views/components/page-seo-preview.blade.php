<div class="seo-preview border p-3 rounded" style="max-width:600px; background:#fff;">

    <div class="mb-2 text-success" style="font-size:14px;">
        {{ url('/') }}/pages/{{ $slug ?? 'your-slug' }}
    </div>


    <h3 style="color:#1a0dab; font-size:18px; margin:0;">
        {{ $title ?? 'SEO Title Preview' }}
    </h3>


    <p style="color:#4d5156; font-size:14px; margin:0;">
        {{ $description ?? 'SEO description preview will appear here. Keep it between 
        150–160 characters for best results.' }}
    </p>

    @if(!empty($keywords))
    <small style="color:#70757a; font-size:12px;">
        Keywords: {{ $keywords }}
    </small>

    
    @endif
</div>
