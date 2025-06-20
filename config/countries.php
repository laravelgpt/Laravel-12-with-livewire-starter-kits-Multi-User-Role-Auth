<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Country Codes Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains comprehensive country data including:
    | - Phone country codes and formats
    | - ISO country codes
    | - Flag emojis
    | - Regional groupings
    |
    */

    'codes' => [
        // North America
        ['code' => '+1', 'name' => 'United States', 'flag' => '🇺🇸', 'format' => '(555) 123-4567', 'iso' => 'US'],
        ['code' => '+1', 'name' => 'Canada', 'flag' => '🇨🇦', 'format' => '(555) 123-4567', 'iso' => 'CA'],
        ['code' => '+52', 'name' => 'Mexico', 'flag' => '🇲🇽', 'format' => '044 55 1234 5678', 'iso' => 'MX'],
        
        // Europe
        ['code' => '+44', 'name' => 'United Kingdom', 'flag' => '🇬🇧', 'format' => '07123 456789', 'iso' => 'GB'],
        ['code' => '+49', 'name' => 'Germany', 'flag' => '🇩🇪', 'format' => '0171 1234567', 'iso' => 'DE'],
        ['code' => '+33', 'name' => 'France', 'flag' => '🇫🇷', 'format' => '06 12 34 56 78', 'iso' => 'FR'],
        ['code' => '+39', 'name' => 'Italy', 'flag' => '🇮🇹', 'format' => '312 123 4567', 'iso' => 'IT'],
        ['code' => '+34', 'name' => 'Spain', 'flag' => '🇪🇸', 'format' => '612 345 678', 'iso' => 'ES'],
        ['code' => '+31', 'name' => 'Netherlands', 'flag' => '🇳🇱', 'format' => '06 12345678', 'iso' => 'NL'],
        ['code' => '+41', 'name' => 'Switzerland', 'flag' => '🇨🇭', 'format' => '076 123 45 67', 'iso' => 'CH'],
        ['code' => '+46', 'name' => 'Sweden', 'flag' => '🇸🇪', 'format' => '070-123 45 67', 'iso' => 'SE'],
        ['code' => '+47', 'name' => 'Norway', 'flag' => '🇳🇴', 'format' => '412 34 567', 'iso' => 'NO'],
        ['code' => '+45', 'name' => 'Denmark', 'flag' => '🇩🇰', 'format' => '12 34 56 78', 'iso' => 'DK'],
        ['code' => '+358', 'name' => 'Finland', 'flag' => '🇫🇮', 'format' => '040 123 4567', 'iso' => 'FI'],
        ['code' => '+43', 'name' => 'Austria', 'flag' => '🇦🇹', 'format' => '0664 123456', 'iso' => 'AT'],
        ['code' => '+48', 'name' => 'Poland', 'flag' => '🇵🇱', 'format' => '512 345 678', 'iso' => 'PL'],
        ['code' => '+420', 'name' => 'Czech Republic', 'flag' => '🇨🇿', 'format' => '601 234 567', 'iso' => 'CZ'],
        ['code' => '+36', 'name' => 'Hungary', 'flag' => '🇭🇺', 'format' => '06 20 123 4567', 'iso' => 'HU'],
        ['code' => '+30', 'name' => 'Greece', 'flag' => '🇬🇷', 'format' => '691 234 5678', 'iso' => 'GR'],
        ['code' => '+351', 'name' => 'Portugal', 'flag' => '🇵🇹', 'format' => '912 345 678', 'iso' => 'PT'],
        ['code' => '+353', 'name' => 'Ireland', 'flag' => '🇮🇪', 'format' => '087 123 4567', 'iso' => 'IE'],
        ['code' => '+32', 'name' => 'Belgium', 'flag' => '🇧🇪', 'format' => '0470 12 34 56', 'iso' => 'BE'],
        
        // Asia
        ['code' => '+91', 'name' => 'India', 'flag' => '🇮🇳', 'format' => '98765 43210', 'iso' => 'IN'],
        ['code' => '+86', 'name' => 'China', 'flag' => '🇨🇳', 'format' => '138 1234 5678', 'iso' => 'CN'],
        ['code' => '+81', 'name' => 'Japan', 'flag' => '🇯🇵', 'format' => '090-1234-5678', 'iso' => 'JP'],
        ['code' => '+82', 'name' => 'South Korea', 'flag' => '🇰🇷', 'format' => '010-1234-5678', 'iso' => 'KR'],
        ['code' => '+65', 'name' => 'Singapore', 'flag' => '🇸🇬', 'format' => '8123 4567', 'iso' => 'SG'],
        ['code' => '+60', 'name' => 'Malaysia', 'flag' => '🇲🇾', 'format' => '012-345 6789', 'iso' => 'MY'],
        ['code' => '+66', 'name' => 'Thailand', 'flag' => '🇹🇭', 'format' => '081 234 5678', 'iso' => 'TH'],
        ['code' => '+84', 'name' => 'Vietnam', 'flag' => '🇻🇳', 'format' => '090 123 4567', 'iso' => 'VN'],
        ['code' => '+63', 'name' => 'Philippines', 'flag' => '🇵🇭', 'format' => '0917 123 4567', 'iso' => 'PH'],
        ['code' => '+62', 'name' => 'Indonesia', 'flag' => '🇮🇩', 'format' => '0812-3456-7890', 'iso' => 'ID'],
        ['code' => '+852', 'name' => 'Hong Kong', 'flag' => '🇭🇰', 'format' => '5123 4567', 'iso' => 'HK'],
        ['code' => '+886', 'name' => 'Taiwan', 'flag' => '🇹🇼', 'format' => '0912 345 678', 'iso' => 'TW'],
        ['code' => '+971', 'name' => 'UAE', 'flag' => '🇦🇪', 'format' => '050 123 4567', 'iso' => 'AE'],
        ['code' => '+966', 'name' => 'Saudi Arabia', 'flag' => '🇸🇦', 'format' => '050 123 4567', 'iso' => 'SA'],
        ['code' => '+972', 'name' => 'Israel', 'flag' => '🇮🇱', 'format' => '050-123-4567', 'iso' => 'IL'],
        ['code' => '+90', 'name' => 'Turkey', 'flag' => '🇹🇷', 'format' => '0532 123 4567', 'iso' => 'TR'],
        ['code' => '+7', 'name' => 'Russia', 'flag' => '🇷🇺', 'format' => '912 345-67-89', 'iso' => 'RU'],
        ['code' => '+7', 'name' => 'Kazakhstan', 'flag' => '🇰🇿', 'format' => '701 234 5678', 'iso' => 'KZ'],
        
        // Oceania
        ['code' => '+61', 'name' => 'Australia', 'flag' => '🇦🇺', 'format' => '0412 345 678', 'iso' => 'AU'],
        ['code' => '+64', 'name' => 'New Zealand', 'flag' => '🇳🇿', 'format' => '021 123 4567', 'iso' => 'NZ'],
        
        // South America
        ['code' => '+55', 'name' => 'Brazil', 'flag' => '🇧🇷', 'format' => '11 98765-4321', 'iso' => 'BR'],
        ['code' => '+54', 'name' => 'Argentina', 'flag' => '🇦🇷', 'format' => '11 1234-5678', 'iso' => 'AR'],
        ['code' => '+57', 'name' => 'Colombia', 'flag' => '🇨🇴', 'format' => '300 123 4567', 'iso' => 'CO'],
        ['code' => '+51', 'name' => 'Peru', 'flag' => '🇵🇪', 'format' => '999 123 456', 'iso' => 'PE'],
        ['code' => '+56', 'name' => 'Chile', 'flag' => '🇨🇱', 'format' => '9 1234 5678', 'iso' => 'CL'],
        ['code' => '+58', 'name' => 'Venezuela', 'flag' => '🇻🇪', 'format' => '0412 123 4567', 'iso' => 'VE'],
        
        // Africa
        ['code' => '+27', 'name' => 'South Africa', 'flag' => '🇿🇦', 'format' => '071 123 4567', 'iso' => 'ZA'],
        ['code' => '+234', 'name' => 'Nigeria', 'flag' => '🇳🇬', 'format' => '0801 234 5678', 'iso' => 'NG'],
        ['code' => '+254', 'name' => 'Kenya', 'flag' => '🇰🇪', 'format' => '0712 345 678', 'iso' => 'KE'],
        ['code' => '+20', 'name' => 'Egypt', 'flag' => '🇪🇬', 'format' => '0100 123 4567', 'iso' => 'EG'],
        ['code' => '+212', 'name' => 'Morocco', 'flag' => '🇲🇦', 'format' => '0612-345678', 'iso' => 'MA'],
        ['code' => '+233', 'name' => 'Ghana', 'flag' => '🇬🇭', 'format' => '020 123 4567', 'iso' => 'GH'],
        ['code' => '+225', 'name' => 'Côte d\'Ivoire', 'flag' => '🇨🇮', 'format' => '01 23 45 67', 'iso' => 'CI'],
        ['code' => '+221', 'name' => 'Senegal', 'flag' => '🇸🇳', 'format' => '77 123 45 67', 'iso' => 'SN'],
        ['code' => '+216', 'name' => 'Tunisia', 'flag' => '🇹🇳', 'format' => '20 123 456', 'iso' => 'TN'],
        ['code' => '+213', 'name' => 'Algeria', 'flag' => '🇩🇿', 'format' => '0551 23 45 67', 'iso' => 'DZ'],
        ['code' => '+218', 'name' => 'Libya', 'flag' => '🇱🇾', 'format' => '091 234 5678', 'iso' => 'LY'],
        ['code' => '+249', 'name' => 'Sudan', 'flag' => '🇸🇩', 'format' => '91 234 5678', 'iso' => 'SD'],
        ['code' => '+251', 'name' => 'Ethiopia', 'flag' => '🇪🇹', 'format' => '091 123 4567', 'iso' => 'ET'],
        ['code' => '+255', 'name' => 'Tanzania', 'flag' => '🇹🇿', 'format' => '0712 345 678', 'iso' => 'TZ'],
        ['code' => '+256', 'name' => 'Uganda', 'flag' => '🇺🇬', 'format' => '0712 345 678', 'iso' => 'UG'],
        ['code' => '+260', 'name' => 'Zambia', 'flag' => '🇿🇲', 'format' => '095 123 4567', 'iso' => 'ZM'],
        ['code' => '+263', 'name' => 'Zimbabwe', 'flag' => '🇿🇼', 'format' => '071 234 5678', 'iso' => 'ZW'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Country Code
    |--------------------------------------------------------------------------
    |
    | The default country code to use when no country is selected.
    |
    */
    'default' => '+1',

    /*
    |--------------------------------------------------------------------------
    | Popular Countries (shown first in dropdown)
    |--------------------------------------------------------------------------
    |
    | List of country codes that should appear at the top of the dropdown.
    |
    */
    'popular' => [
        '+1',   // United States
        '+44',  // United Kingdom
        '+91',  // India
        '+86',  // China
        '+81',  // Japan
        '+49',  // Germany
        '+33',  // France
        '+39',  // Italy
        '+34',  // Spain
        '+31',  // Netherlands
        '+65',  // Singapore
        '+971', // UAE
        '+61',  // Australia
        '+55',  // Brazil
        '+27',  // South Africa
    ],

    /*
    |--------------------------------------------------------------------------
    | Regional Groupings
    |--------------------------------------------------------------------------
    |
    | Countries grouped by regions for better organization.
    |
    */
    'regions' => [
        'north_america' => ['US', 'CA', 'MX'],
        'europe' => ['GB', 'DE', 'FR', 'IT', 'ES', 'NL', 'CH', 'SE', 'NO', 'DK', 'FI', 'AT', 'PL', 'CZ', 'HU', 'GR', 'PT', 'IE', 'BE'],
        'asia' => ['IN', 'CN', 'JP', 'KR', 'SG', 'MY', 'TH', 'VN', 'PH', 'ID', 'HK', 'TW', 'AE', 'SA', 'IL', 'TR', 'RU', 'KZ'],
        'oceania' => ['AU', 'NZ'],
        'south_america' => ['BR', 'AR', 'CO', 'PE', 'CL', 'VE'],
        'africa' => ['ZA', 'NG', 'KE', 'EG', 'MA', 'GH', 'CI', 'SN', 'TN', 'DZ', 'LY', 'SD', 'ET', 'TZ', 'UG', 'ZM', 'ZW'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency Information
    |--------------------------------------------------------------------------
    |
    | Currency codes and symbols for each country.
    |
    */
    'currencies' => [
        'USD' => ['symbol' => '$', 'name' => 'US Dollar'],
        'EUR' => ['symbol' => '€', 'name' => 'Euro'],
        'GBP' => ['symbol' => '£', 'name' => 'British Pound'],
        'JPY' => ['symbol' => '¥', 'name' => 'Japanese Yen'],
        'CNY' => ['symbol' => '¥', 'name' => 'Chinese Yuan'],
        'INR' => ['symbol' => '₹', 'name' => 'Indian Rupee'],
        'CAD' => ['symbol' => 'C$', 'name' => 'Canadian Dollar'],
        'AUD' => ['symbol' => 'A$', 'name' => 'Australian Dollar'],
        'CHF' => ['symbol' => 'CHF', 'name' => 'Swiss Franc'],
        'SEK' => ['symbol' => 'kr', 'name' => 'Swedish Krona'],
        'NOK' => ['symbol' => 'kr', 'name' => 'Norwegian Krone'],
        'DKK' => ['symbol' => 'kr', 'name' => 'Danish Krone'],
        'PLN' => ['symbol' => 'zł', 'name' => 'Polish Złoty'],
        'CZK' => ['symbol' => 'Kč', 'name' => 'Czech Koruna'],
        'HUF' => ['symbol' => 'Ft', 'name' => 'Hungarian Forint'],
        'BRL' => ['symbol' => 'R$', 'name' => 'Brazilian Real'],
        'MXN' => ['symbol' => '$', 'name' => 'Mexican Peso'],
        'ARS' => ['symbol' => '$', 'name' => 'Argentine Peso'],
        'COP' => ['symbol' => '$', 'name' => 'Colombian Peso'],
        'PEN' => ['symbol' => 'S/', 'name' => 'Peruvian Sol'],
        'CLP' => ['symbol' => '$', 'name' => 'Chilean Peso'],
        'VES' => ['symbol' => 'Bs', 'name' => 'Venezuelan Bolívar'],
        'ZAR' => ['symbol' => 'R', 'name' => 'South African Rand'],
        'NGN' => ['symbol' => '₦', 'name' => 'Nigerian Naira'],
        'KES' => ['symbol' => 'KSh', 'name' => 'Kenyan Shilling'],
        'EGP' => ['symbol' => 'E£', 'name' => 'Egyptian Pound'],
        'MAD' => ['symbol' => 'MAD', 'name' => 'Moroccan Dirham'],
        'GHS' => ['symbol' => 'GH₵', 'name' => 'Ghanaian Cedi'],
        'XOF' => ['symbol' => 'CFA', 'name' => 'West African CFA Franc'],
        'TND' => ['symbol' => 'TND', 'name' => 'Tunisian Dinar'],
        'DZD' => ['symbol' => 'د.ج', 'name' => 'Algerian Dinar'],
        'LYD' => ['symbol' => 'ل.د', 'name' => 'Libyan Dinar'],
        'SDG' => ['symbol' => 'SDG', 'name' => 'Sudanese Pound'],
        'ETB' => ['symbol' => 'ETB', 'name' => 'Ethiopian Birr'],
        'TZS' => ['symbol' => 'TSh', 'name' => 'Tanzanian Shilling'],
        'UGX' => ['symbol' => 'USh', 'name' => 'Ugandan Shilling'],
        'ZMW' => ['symbol' => 'ZK', 'name' => 'Zambian Kwacha'],
        'ZWL' => ['symbol' => 'Z$', 'name' => 'Zimbabwean Dollar'],
        'KRW' => ['symbol' => '₩', 'name' => 'South Korean Won'],
        'SGD' => ['symbol' => 'S$', 'name' => 'Singapore Dollar'],
        'MYR' => ['symbol' => 'RM', 'name' => 'Malaysian Ringgit'],
        'THB' => ['symbol' => '฿', 'name' => 'Thai Baht'],
        'VND' => ['symbol' => '₫', 'name' => 'Vietnamese Dong'],
        'PHP' => ['symbol' => '₱', 'name' => 'Philippine Peso'],
        'IDR' => ['symbol' => 'Rp', 'name' => 'Indonesian Rupiah'],
        'HKD' => ['symbol' => 'HK$', 'name' => 'Hong Kong Dollar'],
        'TWD' => ['symbol' => 'NT$', 'name' => 'New Taiwan Dollar'],
        'AED' => ['symbol' => 'د.إ', 'name' => 'UAE Dirham'],
        'SAR' => ['symbol' => 'ر.س', 'name' => 'Saudi Riyal'],
        'ILS' => ['symbol' => '₪', 'name' => 'Israeli Shekel'],
        'TRY' => ['symbol' => '₺', 'name' => 'Turkish Lira'],
        'RUB' => ['symbol' => '₽', 'name' => 'Russian Ruble'],
        'KZT' => ['symbol' => '₸', 'name' => 'Kazakhstani Tenge'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Helper Methods Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for helper methods and utilities.
    |
    */
    'helpers' => [
        'format_phone' => true,
        'validate_phone' => true,
        'get_country_by_code' => true,
        'get_country_by_iso' => true,
        'get_currency_info' => true,
        'get_timezone_info' => true,
    ],
];
