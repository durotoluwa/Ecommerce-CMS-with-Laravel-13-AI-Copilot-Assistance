<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCategorySection extends Model
{
use HasFactory;
protected $table = 'home_category_section';
    protected $fillable = [
        'selection',
        'autoplay',
        'autoplaytimeout',
        'responsive992',
        'responsive576',
        'status',
        'secbannerimg1',
'secbannerimg2',
'secbannertext1',
'secbannertext2',
'secbannerlink1',
'secbannerlink2',
'boxicon1',
'boxicon2',
'boxicon3',
'boxicon4',
'boxheading1',
'boxheading2',
'boxheading3',
'boxheading4',
'boxtext1',
'boxtext2',
'boxtext3',
'boxtext4',
'actionboxstatus', 
'productsectionone_heading',
'productsectionone_selection',
'productsectionone_link',
'productsectionone_status',
'productsectionone_category',

'cardbox1image',
'carbox1heading1',
'carbox1heading2',
'carbox1linktitle',
'carbox1link',

'cardbox2image',
'carbox2heading1',
'carbox2heading2',
'carbox2linktitle',
'carbox2link',



'cardbox3image',
'carbox3heading1',
'carbox3heading2',
'carbox3linktitle',
'carbox3link',
'carboxstatus',

'producttab1_title',
'producttab1_category',
'producttab1_seletion',
'producttab1_shoplink',

'producttab2_title',
'producttab2_category',
'producttab2_seletion',
'producttab2_shoplink',

'producttab3_title',
'producttab3_category',
'producttab3_seletion',
'producttab3_shoplink',

'producttab4_title',
'producttab4_category',
'producttab4_seletion',
'producttab4_shoplink',

'producttab5_title',
'producttab5_category',
'producttab5_seletion',
'producttab5_shoplink',

'producttab6_title',
'producttab6_category',
'producttab6_seletion',
'producttab6_shoplink',
'producttab_status',
'producttab_section_title',

'header_bg_color',
'header_text_color',
'header_font_size',
'header_status',

'iconbox_icon_color',
'iconbox_heading_color',
'iconbox_text_color',
'iconbox_icon_size',
'iconbox_heading_size',
'iconbox_text_size',

'sectionbanner_heading_color',
'sectionbanner_heading_size',
'sectionbanner_heading_font',

'testimony_autoplay',
'testimony_autoplaytimeout',
'testimony_responsive992',
'testimony_responsive576',
'testimony_status',
'testimony_heading',


'blog_autoplay',
'blog_autoplaytimeout',
'blog_responsive992',
'blog_responsive576',
'blog_status',
'blog_heading',





    ];
}
