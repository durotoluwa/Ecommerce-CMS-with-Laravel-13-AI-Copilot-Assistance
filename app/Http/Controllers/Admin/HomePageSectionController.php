<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;
use HTMLPurifier;
use HTMLPurifier_Config;
use App\Models\HomeCategorySection;
use App\Models\ProductCategory;

class HomePageSectionController extends Controller
{

 

      public function SectionBanner()
    {
 $colorconfig = getHomeSection();


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

        $section = HomeCategorySection::first();
        return view('admin.homepage.sectionbanner', compact('section','colorconfig','fonts'));
    }

    

 public function updateSectionBanner(Request $request, $id)
{
    $request->validate([
        'secbannertext1' => 'nullable|string|max:500',
        'secbannertext2' => 'nullable|string|max:500',
        'secbannerlink1' => 'nullable|string',
        'secbannerlink2' => 'nullable|string',
        'secbannerimg1'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'secbannerimg2'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    try {
        // Fetch the record
        $websiteconfig = HomeCategorySection::findOrFail($id);

        $fields = [
            'secbannerimg1' => 'secbannerimg1',
            'secbannerimg2' => 'secbannerimg2',
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

        // Update text fields
        $websiteconfig->secbannertext1 = $request->input('secbannertext1');
        $websiteconfig->secbannertext2 = $request->input('secbannertext2');
         $websiteconfig->secbannerlink1 = $request->input('secbannerlink1');
        $websiteconfig->secbannerlink2 = $request->input('secbannerlink2');

        $websiteconfig->sectionbanner_heading_color = $request->input('sectionbanner_heading_color');
        $websiteconfig->sectionbanner_heading_size = $request->input('sectionbanner_heading_size');
        $websiteconfig->sectionbanner_heading_font = $request->input('sectionbanner_heading_font');

        $websiteconfig->save();

        return redirect()->back()->with('success', 'Section Banner updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Section Banner update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}




   public function HeadertopSection()
    {
        $section = HomeCategorySection::first();
        return view('admin.homepage.header_top', compact('section'));
    }

    
    

public function updateHeadertopSection(Request $request, $id)
{
    $section = HomeCategorySection::findOrFail($id);

    $section->update([
        'header_bg_color'  => $request->header_bg_color,
        'header_text_color'   => $request->header_text_color,
        'header_font_size' => $request->header_font_size,
        'header_status' => $request->has('header_status') ? 1 : 0,
    ]);

    return redirect()->back()->with('success', 'Section updated successfully!');
}


   public function CategorySection()
    {
        $section = HomeCategorySection::first();
        return view('admin.homepage.categorysection', compact('section'));
    }

    
    

public function updatecategorySection(Request $request, $id)
{
    $section = HomeCategorySection::findOrFail($id);

    $section->update([
        'selection'        => $request->selection,
        'autoplay'        => $request->autoplay,
        'autoplaytimeout' => $request->autoplaytimeout,
        'responsive992'   => $request->responsive992,
        'responsive576'   => $request->responsive576,
        'status'          => $request->has('status') ? 1 : 0,
    ]);

    return redirect()->back()->with('success', 'Section updated successfully!');
}



   public function testimonySection()
    {
        $section = HomeCategorySection::first();
        return view('admin.homepage.testimonysection', compact('section'));
    }

    
    

public function updatetestimonySection(Request $request, $id)
{
    $section = HomeCategorySection::findOrFail($id);

    $section->update([
        'testimony_autoplay' => $request->testimony_autoplay,
        'testimony_autoplaytimeout' => $request->testimony_autoplaytimeout,
        'testimony_responsive992' => $request->testimony_responsive992,
        'testimony_responsive576' => $request->testimony_responsive576,
        'testimony_heading' => $request->testimony_heading,
        'testimony_status' => $request->has('testimony_status') ? 1 : 0,
    ]);

    return redirect()->back()->with('success', 'Section updated successfully!');
}



  public function blogSection()
    {
        $section = HomeCategorySection::first();
        return view('admin.homepage.blogsection', compact('section'));
    }

    
    

public function updateblogSection(Request $request, $id)
{
    $section = HomeCategorySection::findOrFail($id);

    $section->update([
        'blog_autoplay' => $request->blog_autoplay,
        'blog_autoplaytimeout' => $request->blog_autoplaytimeout,
        'blog_responsive992' => $request->blog_responsive992,
        'blog_responsive576' => $request->blog_responsive576,
        'blog_heading' => $request->blog_heading,
        'blog_status' => $request->has('blog_status') ? 1 : 0,
    ]);

    return redirect()->back()->with('success', 'Section updated successfully!');
}




      public function Actionbox()
    {
        $section = HomeCategorySection::first();
        return view('admin.homepage.actionbox', compact('section'));
    }

    public function updateActionbox(Request $request, $id)
{
    $section = HomeCategorySection::findOrFail($id);

$section->update([
    'boxicon1'    => $request->boxicon1,
    'boxicon2'    => $request->boxicon2,
    'boxicon3'    => $request->boxicon3,
    'boxicon4'    => $request->boxicon4,

    'boxheading1' => $request->boxheading1,
    'boxheading2' => $request->boxheading2,
    'boxheading3' => $request->boxheading3,
    'boxheading4' => $request->boxheading4,

    'boxtext1'    => $request->boxtext1,
    'boxtext2'    => $request->boxtext2,
    'boxtext3'    => $request->boxtext3,
    'boxtext4'    => $request->boxtext4,
  'actionboxstatus' => $request->has('actionboxstatus') ? 1 : 0,
   'iconbox_icon_color'    => $request->iconbox_icon_color,
    'iconbox_heading_color'    => $request->iconbox_heading_color,
    'iconbox_text_color'    => $request->iconbox_text_color,
    'iconbox_icon_size'    => $request->iconbox_icon_size,
    'iconbox_heading_size'    => $request->iconbox_heading_size,
    'iconbox_text_size'    => $request->iconbox_text_size,

    
 
]);
return redirect()->back()->with('success', 'Action Box Section updated successfully!');
}




public function productSectionOne()
{
    $section    = HomeCategorySection::first();
    $categories = ProductCategory::all();

    return view('admin.homepage.product_section_one', compact('section', 'categories'));
}



        public function updateProductsecone(Request $request, $id)
{
    $section = HomeCategorySection::findOrFail($id);

$section->update([
    'productsectionone_heading'    => $request->productsectionone_heading,
    'productsectionone_selection'    => $request->productsectionone_selection,
    'productsectionone_link'    => $request->productsectionone_link,
 'productsectionone_category'    => $request->productsectionone_category,
    
  
  'productsectionone_status' => $request->has('productsectionone_status') ? 1 : 0,

    
 
]);
return redirect()->back()->with('success', 'Product Section one updated successfully!');
}


public function cardboxPage()
{
    $section    = HomeCategorySection::first();
    $categories = ProductCategory::all();

    return view('admin.homepage.sectionbanner2', compact('section', 'categories'));
}



public function updateCardBoxes(Request $request, $id)
{
    $request->validate([
        // Cardbox 1
        'cardbox1image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'carbox1heading1'   => 'nullable|string|max:255',
        'carbox1heading2'   => 'nullable|string|max:255',
        'carbox1linktitle'  => 'nullable|string|max:255',
        'carbox1link'       => 'nullable|string|max:500',

        // Cardbox 2
        'cardbox2image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'carbox2heading1'   => 'nullable|string|max:255',
        'carbox2heading2'   => 'nullable|string|max:255',
        'carbox2linktitle'  => 'nullable|string|max:255',
        'carbox2link'       => 'nullable|string|max:500',

        // Cardbox 3
        'cardbox3image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'carbox3heading1'   => 'nullable|string|max:255',
        'carbox3heading2'   => 'nullable|string|max:255',
        'carbox3linktitle'  => 'nullable|string|max:255',
        'carbox3link'       => 'nullable|string|max:500',
        'carboxstatus'      => 'nullable|boolean',
    ]);

    try {
        $websiteconfig = HomeCategorySection::findOrFail($id);

        // Handle images
        $imageFields = [
            'cardbox1image' => 'cardbox1image',
            'cardbox2image' => 'cardbox2image',
            'cardbox3image' => 'cardbox3image',
        ];

        foreach ($imageFields as $inputName => $attribute) {
            if ($request->hasFile($inputName)) {
                $file     = $request->file($inputName);
                $filename = time().'_'.$file->getClientOriginalName();

                $destination = $_SERVER['DOCUMENT_ROOT'].'/website';
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $file->move($destination, $filename);

                $websiteconfig->$attribute = 'website/'.$filename;
            }
        }

        // Update text/link fields
        $websiteconfig->carbox1heading1  = $request->input('carbox1heading1');
        $websiteconfig->carbox1heading2  = $request->input('carbox1heading2');
        $websiteconfig->carbox1linktitle = $request->input('carbox1linktitle');
        $websiteconfig->carbox1link      = $request->input('carbox1link');

        $websiteconfig->carbox2heading1  = $request->input('carbox2heading1');
        $websiteconfig->carbox2heading2  = $request->input('carbox2heading2');
        $websiteconfig->carbox2linktitle = $request->input('carbox2linktitle');
        $websiteconfig->carbox2link      = $request->input('carbox2link');

        $websiteconfig->carbox3heading1  = $request->input('carbox3heading1');
        $websiteconfig->carbox3heading2  = $request->input('carbox3heading2');
        $websiteconfig->carbox3linktitle = $request->input('carbox3linktitle');
        $websiteconfig->carbox3link      = $request->input('carbox3link');
        $websiteconfig->carboxstatus     = $request->input('carboxstatus');

        $websiteconfig->save();

        return redirect()->back()->with('success', 'Card boxes updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Card boxes update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}



public function productTabPage()
{
    $section    = HomeCategorySection::first();
    $categories = ProductCategory::all();

    return view('admin.homepage.producttab', compact('section', 'categories'));
}



public function updateProductTabs(Request $request, $id)
{
    $request->validate([
        // Tab 1
        'producttab1_title'    => 'nullable|string|max:255',
        'producttab1_category' => 'nullable|string|max:255',
        'producttab1_seletion' => 'nullable|string|max:255',
        'producttab1_shoplink' => 'nullable|string|max:500',

        // Tab 2
        'producttab2_title'    => 'nullable|string|max:255',
        'producttab2_category' => 'nullable|string|max:255',
        'producttab2_seletion' => 'nullable|string|max:255',
        'producttab2_shoplink' => 'nullable|string|max:500',

        // Tab 3
        'producttab3_title'    => 'nullable|string|max:255',
        'producttab3_category' => 'nullable|string|max:255',
        'producttab3_seletion' => 'nullable|string|max:255',
        'producttab3_shoplink' => 'nullable|string|max:500',

        // Tab 4
        'producttab4_title'    => 'nullable|string|max:255',
        'producttab4_category' => 'nullable|string|max:255',
        'producttab4_seletion' => 'nullable|string|max:255',
        'producttab4_shoplink' => 'nullable|string|max:500',

        // Tab 5
        'producttab5_title'    => 'nullable|string|max:255',
        'producttab5_category' => 'nullable|string|max:255',
        'producttab5_seletion' => 'nullable|string|max:255',
        'producttab5_shoplink' => 'nullable|string|max:500',

        // Tab 6
        'producttab6_title'    => 'nullable|string|max:255',
        'producttab6_category' => 'nullable|string|max:255',
        'producttab6_seletion' => 'nullable|string|max:255',
        'producttab6_shoplink' => 'nullable|string|max:500',
'producttab_section_title' => 'nullable|string|max:500',
        

        // Status
        'producttab_status'    => 'nullable|boolean',
    ]);

    try {
        $websiteconfig = HomeCategorySection::findOrFail($id);

        // Update all tab fields
        for ($i = 1; $i <= 6; $i++) {
            $websiteconfig->{"producttab{$i}_title"}    = $request->input("producttab{$i}_title");
            $websiteconfig->{"producttab{$i}_category"} = $request->input("producttab{$i}_category");
            $websiteconfig->{"producttab{$i}_seletion"} = $request->input("producttab{$i}_seletion");
            $websiteconfig->{"producttab{$i}_shoplink"} = $request->input("producttab{$i}_shoplink");
        }

        $websiteconfig->producttab_status = $request->input('producttab_status');
 $websiteconfig->producttab_section_title = $request->input('producttab_section_title');
        

        $websiteconfig->save();

        return redirect()->back()->with('success', 'Product tabs updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Product tabs update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}


}
