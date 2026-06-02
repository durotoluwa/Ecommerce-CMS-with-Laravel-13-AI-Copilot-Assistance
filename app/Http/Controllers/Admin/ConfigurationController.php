<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\WebsiteConfig;
use App\Models\emailsetting;
use App\Models\Slider;
use App\Models\HomeCategorySection;

use Stevebauman\Purify\Facades\Purify;
use HTMLPurifier;
use HTMLPurifier_Config;
 

class ConfigurationController extends Controller
{


   
    
 
 


   // Cookie Settings

    public function cookiesPage()
    {
    $cokkiesconfig = getWebsiteConfig(); 
    return view('admin.configuration.cookie', compact('cokkiesconfig'));
    }
    
    
    public function updateCookies(Request $request)
    {
        $request->validate([
            'cookie_status' => 'nullable|string',
            'cookie_message' => 'nullable|string',
              'cookie_url' => 'nullable|string',
        ]);
        try{
        $config = getWebsiteConfig();
    
    $config->cookie_message = Purify::clean($request->input('cookie_message'));
    $config->cookie_status = Purify::clean($request->input('cookie_status'));
    $config->cookie_url = Purify::clean($request->input('cookie_url'));
    
        $config->save();
        return redirect()->back()->with('success', 'Cookie settings updated successfully!');
    } catch (\Exception $e) {
        Log::error('Cookies Update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
        
    }
    

     // Error page Settings
public function errorPage()
{
$config = getWebsiteConfig();
return view('admin.configuration.errorpage', compact('config'));
}

public function updateErrorPage(Request $request)
{
    $request->validate([
        'error_page' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    try {
        $config = getWebsiteConfig();

        if ($request->hasFile('error_page')) {
            $file     = $request->file('error_page');
            $filename = time().'_'.$file->getClientOriginalName();

            // Destination is public_html/website
            $destination = $_SERVER['DOCUMENT_ROOT'].'/website';
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            // Move file directly into public_html/website
            $file->move($destination, $filename);

            // Save relative path so you can use asset('website/...') in Blade
            $config->error_page = 'website/'.$filename;
        }

        $config->save();

        return redirect()->back()->with('success', 'Error page updated successfully!');
    } catch (\Exception $e) {
        \Log::error('ErrorPage Update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}






     // SEO page Settings
public function seoPage()
{
$config = getWebsiteConfig();
return view('admin.configuration.seopage', compact('config'));
}

public function updateseoPage(Request $request)
{
    $request->validate([
        'seo_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'description' => 'nullable|string',
        'keywords'    => 'nullable|string',
        'website_url' => 'nullable|string',
    ]);

    try {
        $config = getWebsiteConfig();

        // Clean text inputs
        $config->description = Purify::clean($request->input('description'));
        $config->keywords    = Purify::clean($request->input('keywords'));
        $config->website_url = Purify::clean($request->input('website_url'));

        // Handle SEO image upload
        if ($request->hasFile('seo_image')) {
            $file     = $request->file('seo_image');
            $filename = time().'_'.$file->getClientOriginalName();

            // Destination is public_html/website
            $destination = $_SERVER['DOCUMENT_ROOT'].'/website';
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            // Move file directly into public_html/website
            $file->move($destination, $filename);

            // Save relative path so you can use asset('website/...') in Blade
            $config->seo_image = 'website/'.$filename;
        }

        $config->save();

        return redirect()->back()->with('success', 'Main SEO updated successfully!');
    } catch (\Exception $e) {
        \Log::error('ErrorPage Update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}



// Breadcrumb  Settings

public function breadcrumbPage()
{
    $breadcrumbConfig = getWebsiteConfig();
    return view('admin.configuration.breadcrumb', compact('breadcrumbConfig'));
}

public function updateBreadcrumb(Request $request)
{
    $request->validate([
        'breadcrumb' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    try {
        $config = getWebsiteConfig();

        if ($request->hasFile('breadcrumb')) {
            $file     = $request->file('breadcrumb');
            $filename = time().'_'.$file->getClientOriginalName();

            // Destination is public_html/website
            $destination = $_SERVER['DOCUMENT_ROOT'].'/website';
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            // Move file directly into public_html/website
            $file->move($destination, $filename);

            // Save relative path so you can use asset('website/...') in Blade
            $config->breadcrumb = 'website/'.$filename;
        }

        $config->save();

        return redirect()->back()->with('success', 'Breadcrumb Image updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Breadcrumb Update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}




// Avatar  Settings

public function avatarPage()
{
    $avatarconfig = getWebsiteConfig();
    return view('admin.configuration.avatar', compact('avatarconfig'));
}

public function updateAvatar(Request $request)
{
    $request->validate([
        'default_avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    try {
        $config = getWebsiteConfig();

        if ($request->hasFile('default_avatar')) {
            $file     = $request->file('default_avatar');
            $filename = time().'_'.$file->getClientOriginalName();

            // Destination is public_html/website
            $destination = $_SERVER['DOCUMENT_ROOT'].'/website';
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            // Move file directly into public_html/website
            $file->move($destination, $filename);

            // Save relative path so you can use asset('website/...') in Blade
            $config->default_avatar = 'website/'.$filename;
        }

        $config->save();

        return redirect()->back()->with('success', 'Avatar Image updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Avatar Page Update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}


// Maintenance Page  Settings

public function maintenancePage()
{
    $mainconfig = getWebsiteConfig();
    return view('admin.configuration.maintenance', compact('mainconfig'));
}
public function updateMaintenance(Request $request)
{
    $request->validate([
        'maintenance_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'maintenance_text'  => 'nullable|string',
        'maintenance_status'=> 'nullable|string',
    ]);

    try {
        $config = getWebsiteConfig();

        if ($request->hasFile('maintenance_image')) {
            $file     = $request->file('maintenance_image');
            $filename = time().'_'.$file->getClientOriginalName();

            // Destination is public_html/website
            $destination = $_SERVER['DOCUMENT_ROOT'].'/website';
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            // Move file directly into public_html/website
            $file->move($destination, $filename);

            // Save relative path so you can use asset('website/...') in Blade
            $config->maintenance_image = 'website/'.$filename;
        }

        $config->maintenance_status = Purify::clean($request->input('maintenance_status'));
        $config->maintenance_text   = Purify::clean($request->input('maintenance_text'));

        $config->save();

        return redirect()->back()->with('success', 'Maintenance mode updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Maintenance Page Update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}


// Email Configuration Settings

public function emailPage()
{
  

     $emailConfig = getWebsiteConfig();
    return view('admin.email.configuration', compact('emailConfig'));
}

public function updateEmails(Request $request)
{
    $request->validate([
        'app_name' => 'nullable|string|max:100',
        'contact_email' => 'nullable|string|max:100',
        'mail_mailer' => 'nullable|string|max:100',
        'mail_host' => 'nullable|string|max:100',
        'mail_port' => 'nullable|integer|max:65535',
        'mail_username' => 'nullable|string|max:100',
        'mail_password' => 'nullable|string|max:100',
        'mail_encryption' => 'nullable|string|max:100', 
        'mail_from_address' => 'nullable|string|max:100',
        'mail_from_name' => 'nullable|string|max:100',
        'mail_encryption' => 'nullable|string|max:100',
        'mail_from_address' => 'nullable|string|max:100',
        'mail_from_name' => 'nullable|string|max:100',
        'tawkto' => 'nullable|string',
        
    ]);
    try{
    $id = $request->input('id');
    $config = emailsetting::findOrFail($id);
    $config->app_name = Purify::clean($request->input('app_name'));
    $config->contact_email = Purify::clean($request->input('contact_email'));
    $config->mail_mailer = Purify::clean($request->input('mail_mailer'));
    $config->mail_host = Purify::clean($request->input('mail_host'));
    $config->mail_port = Purify::clean($request->input('mail_port'));
    $config->mail_username = Purify::clean($request->input('mail_username'));
    $config->mail_password = Purify::clean($request->input('mail_password'));
    $config->mail_encryption = Purify::clean($request->input('mail_encryption'));
    $config->mail_from_address = Purify::clean($request->input('mail_from_address'));
    $config->mail_from_name = Purify::clean($request->input('mail_from_name'));
    $config->save();
    return redirect()->back()->with('success', 'Email SMTP updated successfully!');
} catch (\Exception $e) {
    Log::error('Email Setting Update failed: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Something went wrong.');
}

}


public function updateEmail(Request $request)
{
    $request->validate([
        'career_email' => 'nullable|string',
        'contact_email' => 'nullable|string',
        
    ]);
try{
$id = $request->input('id');
$config = getWebsiteConfig();
$config->career_email = Purify::clean($request->input('career_email'));
$config->contact_email = $request->input('contact_email');

$config->save();
return redirect()->back()->with('success', 'Email Settings updated successfully!');
} catch (\Exception $e) {
    Log::error('Tawto chat Update failed: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Something went wrong.');
}

}

// Tawkto Chat Settings

public function tawktoPage()
{
    $tawkconfig = getWebsiteConfig();
    return view('admin.configuration.tawkto', compact('tawkconfig'));
}

public function updateTawkto(Request $request)
{
    $request->validate([
        'tawkto_status' => 'nullable|string',
        'tawkto' => 'nullable|string',
        
    ]);
try{
$id = $request->input('id');
$config = getWebsiteConfig();
$config->tawkto_status = Purify::clean($request->input('tawkto_status'));
$config->tawkto = $request->input('tawkto');

$config->save();
return redirect()->back()->with('success', 'Tawk Chat updated successfully!');
} catch (\Exception $e) {
    Log::error('Tawto chat Update failed: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Something went wrong.');
}

}


// Website Logo Settings

public function websiteLogo()
{
    $logoconfig = getWebsiteConfig();
    return view('admin.configuration.websiteLogo', compact('logoconfig'));
}


 public function updateWebsiteLogo(Request $request, WebsiteConfig $websiteconfig)
{
    $request->validate([
        'main_logo'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'white_logo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'favicon'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'footer_logo'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'main_logosize'  => 'nullable|string|max:255',
        'white_logosize' => 'nullable|string|max:255',
    ]);

    try {
        $fields = [
            'main_logo'   => 'main_logo',
            'white_logo'  => 'white_logo',
            'favicon'     => 'favicon',
            'footer_logo' => 'footer_logo',
        ];

        foreach ($fields as $inputName => $attribute) {
            if ($request->hasFile($inputName)) {
                $file     = $request->file($inputName);
                $filename = time().'_'.$file->getClientOriginalName();

                // Destination is public_html/website
                $destination = $_SERVER['DOCUMENT_ROOT'].'/website';
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                // Move file directly into public_html/website
                $file->move($destination, $filename);

                // Save relative path so you can use asset('website/...') in Blade
                $websiteconfig->$attribute = 'website/'.$filename;
            }
        }

        // Update other attributes like logo sizes
        $websiteconfig->main_logosize  = $request->input('main_logosize');
        $websiteconfig->white_logosize = $request->input('white_logosize');

        $websiteconfig->save();

        return redirect()->back()->with('success', 'Website logos updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Website logo update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}






 


// Website Colour Settings

public function websiteColor()
{
    $colorconfig = getWebsiteConfig();
  $fonts = [
'Arial',
'Verdana',
'Trebuchet',
'Trebuchet Ms',
'Georgia',
'Times New Roman',
'Tahoma',
'Helvetica',
'Abel',
'Abril Fatface',
'Aclonica',
'Acme',
'Actor',
'Adamina',
'Advent Pro',
'Aguafina Script',
'Aladin',
'Aldrich',
'Alegreya',
'Alegreya SC',
'Alex Brush',
'Alfa Slab One',
'Alice',
'Alike',
'Alike Angular',
'Allan',
'Allerta',
'Allerta Stencil',
'Allura',
'Almarai',
'Almendra',
'Almendra SC',
'Amaranth',
'Amatic SC',
'Amethysta',
'Amiri',
'Andada',
'Andika',
'Angkor',
'Annie Use Your Telescope',
'Anonymous Pro',
'Antic',
'Antic Didone',
'Antic Slab',
'Anton',
'Arapey',
'Arbutus',
'Architects Daughter',
'Aref Ruqaa',
'Arimo',
'Arizonia',
'Armata',
'Artifika',
'Arvo',
'Asap',
'Asset',
'Astloch',
'Asul',
'Atomic Age',
'Aubrey',
'Audiowide',
'Average',
'Averia Gruesa Libre',
'Averia Libre',
'Averia Sans Libre',
'Averia Serif Libre',
'Bad Script',
'Balthazar',
'Bangers',
'Basic',
'Battambang',
'Baumans',
'Bayon',
'Belgrano',
'Belleza',
'Bentham',
'Berkshire Swash',
'Bevan',
'Bigshot One',
'Bilbo',
'Bilbo Swash Caps',
'Bitter',
'Black Ops One',
'Bokor',
'Bonbon',
'Boogaloo',
'Bowlby One',
'Bowlby One SC',
'Brawler',
'Bree Serif',
'Bubblegum Sans',
'Buda',
'Buenard',
'Butcherman',
'Butterfly Kids',
'Cabin',
'Cabin Condensed',
'Cabin Sketch',
'Caesar Dressing',
'Cagliostro',
'Cairo',
'Calligraffitti',
'Cambo',
'Candal',
'Cantarell',
'Cantata One',
'Cardo',
'Carme',
'Carter One',
'Caudex',
'Cedarville Cursive',
'Ceviche One',
'Changa',
'Changa One',
'Chango',
'Chau Philomene One',
'Chelsea Market',
'Chenla',
'Cherry Cream Soda',
'Chewy',
'Chicle',
'Chivo',
'Coda',
'Coda Caption',
'Codystar',
'Comfortaa',
'Coming Soon',
'Concert One',
'Condiment',
'Content',
'Contrail One',
'Convergence',
'Cookie',
'Copse',
'Corben',
'Cousine',
'Coustard',
'Covered By Your Grace',
'Crafty Girls',
'Creepster',
'Crete Round',
'Crimson Text',
'Crushed',
'Cuprum',
'Cutive',

'Damion',
'Dancing Script',
'Dangrek',
'Dawning of a New Day',
'Days One',
'Delius',
'Delius Swash Caps',
'Delius Unicase',
'Della Respira',
'Devonshire',
'Didact Gothic',
'Diplomata',
'Diplomata SC',
'Doppio One',
'Dorsa',
'Dosis',
'Dr Sugiyama',
'Droid Sans',
'Droid Sans Mono',
'Droid Serif',
'Duru Sans',
'Dynalight',

'EB Garamond',
'Eater',
'Economica',
'El Messiri',
'Electrolize',
'Emblema One',
'Emilys Candy',
'Engagement',
'Enriqueta',
'Epilogue',
'Erica One',
'Esteban',
'Euphoria Script',
'Ewert',
'Exo',
'Exo 2',
'Expletus Sans',

'Fanwood Text',
'Fascinate',
'Fascinate Inline',
'Federant',
'Federo',
'Felipa',
'Fjord One',
'Flamenco',
'Flavors',
'Fondamento',
'Fontdiner Swanky',
'Forum',
'Fjalla One',
'Francois One',
'Fredericka the Great',
'Fredoka One',
'Freehand',
'Fresca',
'Frijole',
'Fugaz One',
'GFS Didot',
'GFS Neohellenic',
'Galdeano',
'Gentium Basic',
'Gentium Book Basic',
'Geo',
'Geostar',
'Geostar Fill',
'Germania One',
'Gilda Display',
'Give You Glory',
'Glass Antiqua',
'Glegoo',
'Gloria Hallelujah',
'Goblin One',
'Gochi Hand',
'Gorditas',
'Goudy Bookletter 1911',
'Graduate',
'Gravitas One',
'Great Vibes',
'Gruppo',
'Gudea',

'Habibi',
'Hammersmith One',
'Handwin',
'Hanuman',
'Happy Monkey',
'Harmattan',
'Henny Penny',
'Herr Von Muellerhoff',
'Hind',
'Holtwood One SC',
'Homemade Apple',
'Homenaje',

'IBM Plex Sans',
'IBM Plex Sans Arabic',
'IM Fell DW Pica',
'IM Fell DW Pica SC',
'IM Fell Double Pica',
'IM Fell Double Pica SC',
'IM Fell English',
'IM Fell English SC',
'IM Fell French Canon',
'IM Fell French Canon SC',
'IM Fell Great Primer',
'IM Fell Great Primer SC',
'Iceberg',
'Iceland',
'Imprima',
'Inconsolata',
'Inder',
'Indie Flower',
'Inika',
'Inter',
'Irish Grover',
'Istok Web',
'Italiana',
'Italianno',

'Jim Nightshade',
'Jockey One',
'Jolly Lodger',
'Jomhuria',
'Josefin Sans',
'Josefin Slab',
'Jost',
'Judson',
'Junge',
'Jura',
'Just Another Hand',
'Just Me Again Down Here',

'Kameron',
'Karla',
'Katibeh',
'Kaushan Script',
'Kelly Slab',
'Kenia',
'Khmer',
'Knewave',
'Kotta One',
'Koulen',
'Kranky',
'Kreon',
'Kristi',
'Krona One',

'La Belle Aurore',
'Lalezar',
'Lancelot',
'Lateef',
'Lato',
'League Script',
'Leckerli One',
'Ledger',
'Lekton',
'Lemon',
'Lemonada',
'Libre Baskerville',
'Lilita One',
'Limelight',
'Linden Hill',
'Lobster',
'Lobster Two',
'Londrina Outline',
'Londrina Shadow',
'Londrina Sketch',
'Londrina Solid',
'Lora',
'Love Ya Like A Sister',
'Loved by the King',
'Lovers Quarrel',
'Luckiest Guy',
'Lusitana',
'Lustria',

'Outfit',
'Macondo',
'Macondo Swash Caps',
'Mada',
'Magra',
'Maiden Orange',
'Mako',
'Manrope',
'Marcellus',
'Marcellus SC',
'Marck Script',
'Marko One',
'Marmelad',
'Martel',
'Marvel',
'Mate',
'Mate SC',
'Maven Pro',
'Meddon',
'MedievalSharp',
'Medula One',
'Megrim',
'Merienda One',
'Merriweather',
'Metal',
'Metamorphous',
'Metrophobic',
'Michroma',
'Miltonian',
'Miltonian Tattoo',
'Miniver',
'Mirza',
'Miss Fajardose',
'Modern Antiqua',
'Molengo',
'Monofett',
'Monoton',
'Monsieur La Doulaise',
'Montaga',
'Montez',
'Montserrat',
'Montserrat Alternates',
'Montserrat Subrayada',
'Moul',
'Moulpali',
'Mountains of Christmas',
'Mr Bedfort',
'Mr Dafoe',
'Mr De Haviland',
'Mrs Saint Delafield',
'Mrs Sheppards',
'Muli',
'Mystery Quest',

'Neucha',
'Neuton',
'News Cycle',
'Niconne',
'Nixie One',
'Nobile',
'Nokora',
'Norican',
'Nosifer',
'Nothing You Could Do',
'Noticia Text',
'Noto Kufi Arabic',
'Noto Naskh Arabic',
'Noto Nastaliq Urdu',
'Noto Sans',
'Noto Sans Arabic',
'Noto Sans Japanese',
'Noto Sans Korean',
'Noto Sans Simplified Chinese',
'Noto Sans Traditional Chinese',

'Nova Cut',
'Nova Flat',
'Nova Mono',
'Nova Oval',
'Nova Round',
'Nova Script',
'Nova Slim',
'Nova Square',

'Numans',
'Nunito',
'Nunito Sans',

'Odor Mean Chey',
'Old Standard TT',
'Oldenburg',
'Oleo Script',
'Open Sans',
'Open Sans Condensed',
'Orbitron',
'Original Surfer',
'Oswald',
'Over the Rainbow',
'Overlock',
'Overlock SC',
'Ovo',
'Oxygen',

'Poppins',
'PT Mono',
'PT Sans',
'PT Sans Caption',
'PT Sans Narrow',
'PT Serif',
'PT Serif Caption',
'Pacifico',
'Parisienne',
'Passero One',
'Passion One',
'Patrick Hand',
'Patua One',
'Paytone One',
'Permanent Marker',
'Petrona',
'Philosopher',
'Piedra',
'Pinyon Script',
'Plaster',
'Play',
'Playball',
'Playfair Display',
'Plus Jakarta Sans',
'Podkova',
'Poiret One',
'Poller One',
'Poly',
'Pompiere',
'Pontano Sans',
'Port Lligat Sans',
'Port Lligat Slab',
'Prata',
'Preahvihear',
'Press Start 2P',
'Princess Sofia',
'Prociono',
'Prosto One',
'Puritan',

'Quantico',
'Quattrocento',
'Quattrocento Sans',
'Questrial',
'Quicksand',
'Qwigley',

'Radley',
'Rajdhani',
'Rakkas',
'Raleway',
'Rammetto One',
'Rancho',
'Rationale',
'Readex Pro',
'Red Hat Display',
'Reddit Sans',
'Reddit Sans Condensed',
'Redressed',
'Reem Kufi',
'Reenie Beanie',
'Revalia',
'Ribeye',
'Ribeye Marrow',
'Righteous',
'Roboto',
'Roboto Sans',
'Rochester',
'Rock Salt',
'Rokkitt',
'Ropa Sans',
'Rosario',
'Rosarivo',
'Rouge Script',
'Rubik',
'Ruda',
'Ruge Boogie',
'Ruluko',
'Rum Raisin',
'Ruslan Display',
'Russo One',
'Ruthie',

'Sacramento',
'Sail',
'Saira Condensed',
'Salsa',
'Sancreek',
'Sansita One',
'Sarina',
'Satisfy',
'Scheherazade',
'Schibsted Grotesk',
'Schoolbell',
'Seaweed Script',
'Sevillana',
'Seymour One',
'Shadows Into Light',
'Shadows Into Light Two',
'Shanti',
'Share',
'Shojumaru',
'Short Stack',
'Siemreap',
'Sigmar One',
'Signika',
'Signika Negative',
'Simonetta',
'Sirin Stencil',
'Six Caps',
'Slackey',
'Smokum',
'Smythe',
'Sniglet',
'Snippet',
'Sofia',
'Sofia Sans Condensed',
'Sonsie One',
'Sorts Mill Goudy',
'Special Elite',
'Spicy Rice',
'Spinnaker',
'Spirax',
'Squada One',
'Stardos Stencil',
'Stint Ultra Condensed',
'Stint Ultra Expanded',
'Stoke',
'Sue Ellen Francisco',
'Sunshiney',
'Supermercado One',
'Suwannaphum',
'Swanky and Moo Moo',
'Syncopate',

'Tajawal',
'Tangerine',
'Taprom',
'Teachers',
'Telex',
'Tenor Sans',
'The Girl Next Door',
'Tienne',
'Tinos',
'Titan One',
'Titillium Web',
'Trade Winds',
'Trocchi',
'Trochut',
'Trykker',
'Tulpen One',

'Ubuntu',
'Ubuntu Condensed',
'Ubuntu Mono',
'Ultra',
'Uncial Antiqua',
'UnifrakturCook',
'UnifrakturMaguntia',
'Unkempt',
'Unlock',
'Unna',

'VT323',
'Varela',
'Varela Round',
'Vast Shadow',
'Vibur',
'Vidaloka',
'Viga',
'Voces',
'Volkhov',
'Vollkorn',
'Voltaire',

'Waiting for the Sunrise',
'Wallpoet',
'Walter Turncoat',
'Wellfwint',
'Wire One',
'Wix Madefor Display',
'Work Sans',

'Yanone Kaffeesatz',
'Yellowtail',
'Yeseva One',
'Yesteryear',

'Zeyada',
'Fraunces',
        
    ];



    return view('admin.configuration.websitecolor', compact('colorconfig','fonts'));
}
public function updateWebsiteColor(Request $request)
{
    $request->validate([
        'primary_color' => 'nullable|string',
        'secondary_color' => 'nullable|string',
        'text_color' => 'nullable|string',
        'footer_bgcolor' => 'nullable|string',
        'footer_titlecolor' => 'nullable|string',
        'footer_textcolor' => 'nullable|string',
        'copywrite_bg' => 'nullable|string',
        'copywrite_text' => 'nullable|string',
    ]);
    try{
$id = $request->input('id');
$config = getWebsiteConfig();

$config->primary_color = Purify::clean($request->input('primary_color'));
$config->secondary_color = Purify::clean($request->input('secondary_color'));
$config->text_color = Purify::clean($request->input('text_color'));
$config->footer_bgcolor = Purify::clean($request->input('footer_bgcolor'));
$config->footer_titlecolor = Purify::clean($request->input('footer_titlecolor'));
$config->footer_textcolor = Purify::clean($request->input('footer_textcolor'));
$config->copywrite_bg = Purify::clean($request->input('copywrite_bg'));
$config->copywrite_textcolor = Purify::clean($request->input('copywrite_textcolor'));

$config->heading_font_style = Purify::clean($request->input('heading_font_style'));
$config->text_font = Purify::clean($request->input('text_font'));
$config->menu_font = Purify::clean($request->input('menu_font'));
$config->heading_weight = Purify::clean($request->input('heading_weight'));
$config->text_weight = Purify::clean($request->input('text_weight'));
$config->menu_weight = Purify::clean($request->input('menu_weight'));
$config->body_color = Purify::clean($request->input('body_color'));
$config->heading_colour = Purify::clean($request->input('heading_colour'));





$config->save();
return redirect()->back()->with('success', 'Website Color updated successfully!');
} catch (\Exception $e) {
    Log::error('Website Colour Update failed: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Something went wrong.');
}

}


// Contact Us Page Settings

public function contactPage()
{
    $contactconfig = getWebsiteConfig();
    return view('admin.configuration.contact', compact('contactconfig'));
}

public function updateContact(Request $request)
{
    $request->validate([

        'companyName' => 'nullable|string',
        'tagline' => 'nullable|string',
        'phone1' => 'nullable|string|max:24',
        'phone2' => 'nullable|string|max:24',
        'phone3' => 'nullable|string|max:24',
        'email1' => 'nullable|string|max:100',
        'email2' => 'nullable|string|max:100',
        'email3' => 'nullable|string|max:100',
        'address' => 'nullable|string|max:500',
        'facebook_link' => 'nullable|string',
        'x_link' => 'nullable|string',
        'instagram_link' => 'nullable|string',
        'linkedin_link' => 'nullable|string',
          'youtube_link' => 'nullable|string',
    ]);

    try {
    $id = $request->input('id');
    $config = getWebsiteConfig();
    
    $config->companyName = Purify::clean($request->input('companyName'));
    $config->tagline = Purify::clean($request->input('tagline'));
    $config->phone1 = Purify::clean($request->input('phone1'));
    $config->phone2 = Purify::clean($request->input('phone2'));
    $config->phone3 = Purify::clean($request->input('phone3'));
    $config->email1 = Purify::clean($request->input('email1'));
    $config->email2 = Purify::clean($request->input('email2'));
    $config->email3 = Purify::clean($request->input('email3'));
    $config->address = Purify::clean($request->input('address'));
   $config->google_map = $request->input('google_map');

    $config->facebook_link = Purify::clean($request->input('facebook_link'));
    $config->x_link = Purify::clean($request->input('x_link'));
    $config->instagram_link = Purify::clean($request->input('instagram_link'));
    $config->linkedin_link = Purify::clean($request->input('linkedin_link'));
        $config->youtube_link = Purify::clean($request->input('youtube_link'));

    $config->save();
    return redirect()->back()->with('success', 'Contact Information updated successfully!');
} catch (\Exception $e) {
    Log::error('Contact Update failed: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Something went wrong.');
}
}


// Footer Settings

public function footerPage()
{
    $footerconfig = getWebsiteConfig();
    return view('admin.configuration.footer', compact('footerconfig'));
}

public function updateFooter(Request $request)
{
    $request->validate([
        'footer_content' => 'nullable|string',
        'copywrite' => 'nullable|string',
    ]);
    

    try {
        $config = getWebsiteConfig();
        $config->footer_content = Purify::clean($request->input('footer_content'));
        $config->copywrite_text = Purify::clean($request->input('copywrite_text'));
      
        $config->save();

        return redirect()->back()->with('success', 'Footer Information updated successfully!');
    } catch (\Exception $e) {
        Log::error('Footer update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}


// Menu Code Settings

public function menuPage()
{
    $menuconfig = getWebsiteConfig();
    return view('admin.configuration.menu', compact('menuconfig'));
}

public function updateMenu2(Request $request)
{
    $request->validate([
        'menu_code' => 'nullable|string',
    ]);
    try{
    $id = $request->input('id');
    $config = getWebsiteConfig();
$config->menu_code = $request->input('menu_code');
    $config->save();
    return redirect()->back()->with('success', 'Menu Information updated successfully!');
} catch (\Exception $e) {
    Log::error('Menu update failed: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Something went wrong.');
}
}


public function updateMenu(Request $request)
{
    $request->validate([
        'menu_code' => 'nullable|string',
    ]);

    try {
        // Get the website configuration
        $id = $request->input('id');
        $config = getWebsiteConfig();

        // Create a custom configuration to allow <li>, <ul>, and other relevant tags
        $purifierConfig = HTMLPurifier_Config::createDefault();

        // Allow specific tags (e.g., ul, li, a, p, div)
        $purifierConfig->set('HTML.Allowed', 'ul,li,a,p,div,span,strong,b,i,em');

        // Create the purifier instance with the custom configuration
        $purifier = new HTMLPurifier($purifierConfig);
        
        // Sanitize the input HTML
        $cleanMenuCode = $purifier->purify($request->input('menu_code'));

        // Save the sanitized HTML content to the database
        $config->menu_code = $cleanMenuCode;
        $config->save();

        return redirect()->back()->with('success', 'Menu Information updated successfully!');
    } catch (\Exception $e) {
        Log::error('Menu update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}


// Terms and Conditions Settings

public function termsCondition()
{
     
    $termsconfig = getWebsiteConfig();
    return view('admin.pages.termsCondition', compact('termsconfig'));
}

public function updateCondition(Request $request)
{
    $request->validate([
        'terms_condition' => 'nullable|string',
    ]);
    try{
$id = $request->input('id');
$config = getWebsiteConfig();
$config->terms_condition = Purify::clean($request->input('terms_condition'));
$config->save();
return redirect()->back()->with('success', 'Terms and Conditions updated successfully!');
} catch (\Exception $e) {
    Log::error('Terms and Conditions update failed: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Something went wrong.');
}

}


// Privacy Policy Settings

public function privacyPolicy()
{
    $privacyconfig = getWebsiteConfig();
    return view('admin.pages.privacyPolicy', compact('privacyconfig'));
}

public function updatePrivacy(Request $request)
{

    $request->validate([
        'privacy_policy' => 'nullable|string',
    ]);
 try{
$id = $request->input('id');
$config = getWebsiteConfig();
$config->privacy_policy = Purify::clean($request->input('privacy_policy'));
$config->save();
return redirect()->back()->with('success', 'Privacy policy updated successfully!');
} catch (\Exception $e) {
    Log::error('Privacy Policy update failed: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Something went wrong.');
}

}

// Privacy Slider Settings

public function sliderPage()
    {
        $sliderConfig = Slider::findOrFail(1);
        return view('admin.slider.slider', compact('sliderConfig'));
    }


public function updateSlider(Request $request)
{
    $request->validate([
        'slider1_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'slider2_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'slider3_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'slider4_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    try {
        $config = Slider::findOrFail($request->input('id', 1)); // fallback to ID 1

        // Handle image uploads
        foreach (['slider1_image', 'slider2_image', 'slider3_image', 'slider4_image'] as $field) {
            if ($request->hasFile($field)) {
                $file     = $request->file($field);
                $filename = time().'_'.$file->getClientOriginalName();

                // Move file directly into public_html/slider
                $destination = $_SERVER['DOCUMENT_ROOT'].'/slider';
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $file->move($destination, $filename);

                // Save relative path for Blade asset()
                $config->$field = 'slider/'.$filename;
            }
        }

        // Define text fields for each slider
        $textFields = [
            'slider1_text', 'slider1_head1', 'slider1_head2', 'slider1_btn',
            'slider2_text', 'slider2_head1', 'slider2_head2', 'slider2_btn',
            'slider3_text', 'slider3_head1', 'slider3_head2', 'slider3_btn',
            'slider4_text', 'slider4_head1', 'slider4_head2', 'slider4_btn',
        ];

        // Clean and update text fields dynamically
        foreach ($textFields as $field) {
            if ($request->filled($field)) {
                $config->$field = Purify::clean($request->input($field));
            }
        }

        $config->save();

        return redirect()->back()->with('success', 'Slider updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Slider Update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}



public function editSettings()
{
    $fonts = [
        'Arial',
        'Verdana',
        'Trebuchet MS',
        'Georgia',
        'Times New Roman',
        'Tahoma',
        'Helvetica',
        'Nunito',
        'Poppins',
        'Roboto',
        'Open Sans',
        'Montserrat',
        'Playfair Display',
        'Lato',
        'Merriweather',
        'Oswald',
        'Raleway',
        'Quicksand',
        'Josefin Sans',
        
    ];

    return view('admin.configuration.websitecolor', compact('fonts'));
}

}
