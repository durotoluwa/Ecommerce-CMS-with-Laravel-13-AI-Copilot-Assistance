<?php

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Models\WebsiteConfig;
use App\Models\about_section;
use App\Models\service_section;
use App\Models\middle_banner;
use App\Models\working_process;
use App\Models\testominal_section;
use App\Models\aboutus;
use App\Models\property_section;
use App\Models\why_choose_section;
use App\Models\contact_section;
use App\Models\blog_section;
use App\Models\Menu;
use App\Models\Testimony;
use App\Models\HomeCategorySection;


if (!function_exists('uploadImageToDirectory')) {
    /**
     * Uploads an image to the specified public directory.
     *
     * @param UploadedFile $image
     * @param string $directory  Directory inside the public folder
     * @return string  Relative path to the uploaded image
     *
     * @throws \Exception
     */
    function uploadImageToDirectory(UploadedFile $image, string $directory): string
    {
        try {
            if (!$image->isValid()) {
                throw new \Exception('Invalid image file.');
            }

            $filename = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path($directory);

            if (!file_exists($destinationPath)) {
                if (!mkdir($destinationPath, 0755, true) && !is_dir($destinationPath)) {
                    throw new \Exception("Failed to create upload directory: $destinationPath");
                }
            }

            $image->move($destinationPath, $filename);

            return $directory . '/' . $filename;

        } catch (\Exception $e) {
            throw new \Exception('Image upload failed: ' . $e->getMessage());
        }
    }
}

if (! function_exists('getProductTags')) {
    function getProductTags($productId) {
        $product = \App\Models\Product::with('tags')->find($productId);
        return $product ? $product->tags : collect();
    }
}

if (! function_exists('getTagBySlug')) {
    function getTagBySlug($slug) {
        return \App\Models\Tag::where('slug', $slug)->first();
    }
}






// Usage-specific wrappers (optional, for semantic clarity)
if (!function_exists('uploadImage')) {
    function uploadImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'website');
    }
}

if (!function_exists('uploadServiceImage')) {
    function uploadServiceImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'service');
    }
}

if (!function_exists('uploadPageImage')) {
    function uploadPageImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'page');
    }
}

if (!function_exists('uploadPartnerImage')) {
    function uploadPartnerImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'partner_logo');
    }
}

if (!function_exists('uploadSlider')) {
    function uploadSlider(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'slider');
    }
}

if (!function_exists('uploadCareerImage')) {
    function uploadCareerImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'career');
    }
}

if (!function_exists('uploadIndustryImage')) {
    function uploadIndustryImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'industry');
    }
}

if (!function_exists('uploadTestimonialImage')) {
    function uploadTestimonialImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'testimonia');
    }
}
if (!function_exists('uploadTeamImage')) {
    function uploadTeamImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'team');
    }
}

if (!function_exists('uploadProjectImage')) {
    function uploadProjectImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'project');
    }
}

if (!function_exists('uploadBlogImage')) {
    function uploadBlogImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'blog');
    }
}
if (!function_exists('uploadProfileImage')) {
    function uploadProfileImage(UploadedFile $image): string
    {
        return uploadImageToDirectory($image, 'user');
    }
}



// Site content access helpers
if (!function_exists('getWebsiteConfig')) {
    function getWebsiteConfig()
    {
        return WebsiteConfig::firstOrFail();
    }
}





if (!function_exists('getHomeSection')) {
    function getHomeSection()
    {
        return HomeCategorySection::firstOrFail();
    }
}

if (!function_exists('getWorkingProcess')) {
    function getWorkingProcess()
    {
        return working_process::firstOrFail();
    }
}

if (!function_exists('getaboutussec')) {
    function getaboutussec()
    {
        return about_section::firstOrFail();
    }
}

if (!function_exists('getmiddlessec')) {
    function getmiddlessec()
    {
        return middle_banner::firstOrFail();
    }
}

if (!function_exists('getservicesec')) {
    function getservicesec()
    {
        return service_section::firstOrFail();
    }
}




if (!function_exists('gettestsec')) {
    function gettestsec()
    {
        return testominal_section::firstOrFail();
    }
}

if (!function_exists('getpropertysec')) {
    function getpropertysec()
    {
        return property_section::firstOrFail();
    }
}

if (!function_exists('getwhychoosesec')) {
    function getwhychoosesec()
    {
        return why_choose_section::firstOrFail();
    }
}

if (!function_exists('getcontactsec')) {
    function getcontactsec()
    {
        return contact_section::firstOrFail();
    }
}

 

if (!function_exists('getblogsec')) {
    function getblogsec()
    {
        return blog_section::firstOrFail();
    }
}

 function getblogsec() { return Cache::remember('blogsec', 60, function () { return blog_section::first(); }); }


//function getcontactsec() { return Cache::remember('contactsec', 60, function () { return contact_section::first(); }); }



//function getwhychoosesec() { return Cache::remember('whychoosesec', 60, function () { return why_choose_section::first(); }); }
 
 

if (!function_exists('getAboutUs')) {
    function getAboutUs()
    {
        return aboutus::firstOrFail();
    }
}

// Sentence limiter helper
if (!function_exists('limit_sentences')) {
    /**
     * Limit text to a maximum number of sentences.
     *
     * @param string $text
     * @param int $limit
     * @return string
     */
    function limit_sentences(string $text, int $limit = 42): string
    {
        $sentences = preg_split('/(?<=[.?!])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

        if (!$sentences) {
            return $text;
        }

        $limited = array_slice($sentences, 0, $limit);

        return implode(' ', $limited);
    }
}

// User avatar URL resolver
if (!function_exists('user_avatar_url')) {
    function user_avatar_url($user)
    {
        if ($user->profile_image) {
            return asset($user->profile_image);
        }

        $default = WebsiteConfig::first()?->default_avatar;

        return $default ? asset('/' . $default) : asset('images/favicon.png');
    }
}

if (!function_exists('saveUploadedFiles')) {
function saveUploadedFiles(\Illuminate\Http\Request $request, array $fields, $model, string $subfolder)
{
    foreach ($fields as $inputName => $attribute) {
        if ($request->hasFile($inputName)) {
            $file     = $request->file($inputName);
            $filename = time().'_'.$file->getClientOriginalName();

            // Destination path inside public/
            $destination = public_path($subfolder);
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            // Move file
            $file->move($destination, $filename);

            // Save relative path (works with asset())
            $model->$attribute = $subfolder.'/'.$filename;
        }
    }
}


function getMenus()
{
    return Menu::whereNull('parent_id')
        ->with('children.children')
        ->orderBy('sort_order')
        ->get();
}



function renderMenuOptions($menus, $level = 0)
{
    $html = '';

    foreach ($menus as $menu) {

        $prefix = str_repeat('— ', $level);

        $html .= '<option value="' . $menu->id . '">';
        $html .= $prefix . $menu->title;
        $html .= '</option>';

        if ($menu->children->count()) {

            $html .= renderMenuOptions(
                $menu->children,
                $level + 1
            );
        }
    }

    return $html;
}





function menuUrl($menu)
{
    switch ($menu->type) {

      case 'page':
    $page = \App\Models\Page::find($menu->reference_id);

    return $page
        ? route('page.show', $page->slug)
        : '#'; // fallback if not found


        case 'category':
            return route(
                'category.show',
                $menu->reference_id
            );

      case 'product_category':
    $category = \App\Models\ProductCategory::find($menu->reference_id);

    return $category
        ? route('product-category.index', $category->slug)
        : '#'; // fallback if not found


         case 'brand':
    $brand = \App\Models\StoreBrand::find($menu->reference_id);

    return $brand
        ? route('brand.index', $brand->slug)
        : '#'; // fallback if not found

        case 'brand_category':
    [$brandId, $categoryId] = explode('-', $menu->reference_id);

    $brand = \App\Models\StoreBrand::find($brandId);
    $category = \App\Models\ProductCategory::find($categoryId);

    return ($brand && $category)
        ? route('brand.category', [$brand->slug, $category->slug])
        : '#';


            case 'product':

            return url(
                '/product/' . $menu->reference_id
            );

        case 'blog_category':
            return route(
                'blog.category',
                $menu->reference_id
            );

        default:
            return $menu->url ?? '#';
    }
}


}
