<?php
namespace AliExpressSDK;

/**
 * Class Categories
 * @package AliExpressSDK
 */
class Categories
{
    private $categories = [
        3 => 'Apparel & Accessories',
        34 => 'Automobiles & Motorcycles',
        1501 => 'Baby Products',
        66 => 'Beauty & Health',
        7 => 'Computer & Networking',
        13 => 'Construction & Real Estate',
        44 => 'Consumer Electronics',
        100008578 => 'Customized Products',
        5 => 'Electrical Equipment & Supplies',
        502 => 'Electronic Components & Supplies',
        2 => 'Food',
        1503 => 'Furniture',
        200003655 => 'Hair & Accessories',
        42 => 'Hardware',
        15 => 'Home & Garden',
        6 => 'Home Appliances',
        200003590 => 'Industry & Business',
        36 => 'Jewelry & Watch',
        39 => 'Lights & Lighting',
        1524 => 'Luggage & Bags',
        21 => 'Office & School Supplies',
        509 => 'Phones & Telecommunications',
        30 => 'Security & Protection',
        322 => 'Shoes',
        200001075 => 'Special Category',
        18 => 'Sports & Entertainment',
        1420 => 'Tools',
        26 => 'Toys & Hobbies',
        1511 => 'Watches'
    ];

    private $allowedCurrencies = [
        'USD',
        'RUB',
        'GBP',
        'BRL',
        'CAD',
        'AUD',
        'EUR',
        'INR',
        'UAH',
        'JPY',
        'MXN',
        'IDR',
        'TRY',
        'SEK'
    ];

    private $allowedLanguages = [
        'en',
        'pt',
        'ru',
        'es',
        'fr',
        'id',
        'it',
        'nl',
        'tr',
        'vi',
        'th',
        'de',
        'ko',
        'ja',
        'ar',
        'pl',
        'he'
    ];

    private $sortBy = [
        'orignalPriceUp',
        'orignalPriceDown',
        'sellerRateDown',
        'commissionRateUp',
        'commissionRateDown',
        'volumeDown',
        'validTimeUp',
        'validTimeDown'
    ];
}