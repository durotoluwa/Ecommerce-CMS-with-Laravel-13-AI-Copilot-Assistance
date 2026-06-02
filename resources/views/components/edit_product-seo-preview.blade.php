<div class="product-seo-preview border p-3 rounded" 
     style="max-width:600px; background:#fff; font-family:Arial, sans-serif;">
    <!-- URL -->
    <div class="mb-1" style="color:#006621; font-size:14px;">
        {{ url('/') }}/product-details/<span id="seo-preview-slug">{{ $product->slug }}</span>
    </div>

    <!-- Title -->
    <h3 id="seo-preview-title" style="color:#1a0dab; font-size:18px; margin:0; line-height:1.3;">
        {{ old('seo_title', $product->seo_title) ?: 'SEO Title Preview' }}
    </h3>

    <!-- Description -->
    <p id="seo-preview-description" style="color:#545454; font-size:14px; margin:0; line-height:1.4;">
        {{ old('seo_description', $product->seo_description) ?: 'SEO description preview will appear here.' }}
    </p>

    <!-- Keywords -->
    <small id="seo-preview-keywords" style="color:#70757a; font-size:12px;">
        {{ old('seo_keywords', $product->seo_keywords) ?: 'Keywords preview will appear here' }}
    </small>
</div>
