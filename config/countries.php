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

        // Additional countries
        ['code' => '+93', 'name' => 'Afghanistan', 'flag' => '🇦🇫', 'format' => '070 123 4567', 'iso' => 'AF'],
        ['code' => '+355', 'name' => 'Albania', 'flag' => '🇦🇱', 'format' => '066 123 4567', 'iso' => 'AL'],
        ['code' => '+213', 'name' => 'Algeria', 'flag' => '🇩🇿', 'format' => '0551 23 45 67', 'iso' => 'DZ'],
        ['code' => '+376', 'name' => 'Andorra', 'flag' => '🇦🇩', 'format' => '312 345', 'iso' => 'AD'],
        ['code' => '+244', 'name' => 'Angola', 'flag' => '🇦🇴', 'format' => '923 123 456', 'iso' => 'AO'],
        ['code' => '+1264', 'name' => 'Anguilla', 'flag' => '🇦🇮', 'format' => '(264) 235-1234', 'iso' => 'AI'],
        ['code' => '+1268', 'name' => 'Antigua and Barbuda', 'flag' => '🇦🇬', 'format' => '(268) 464-1234', 'iso' => 'AG'],
        ['code' => '+54', 'name' => 'Argentina', 'flag' => '🇦🇷', 'format' => '11 1234-5678', 'iso' => 'AR'],
        ['code' => '+374', 'name' => 'Armenia', 'flag' => '🇦🇲', 'format' => '077 123456', 'iso' => 'AM'],
        ['code' => '+297', 'name' => 'Aruba', 'flag' => '🇦🇼', 'format' => '560 1234', 'iso' => 'AW'],
        ['code' => '+61', 'name' => 'Australia', 'flag' => '🇦🇺', 'format' => '0412 345 678', 'iso' => 'AU'],
        ['code' => '+43', 'name' => 'Austria', 'flag' => '🇦🇹', 'format' => '0664 123456', 'iso' => 'AT'],
        ['code' => '+994', 'name' => 'Azerbaijan', 'flag' => '🇦🇿', 'format' => '040 123 45 67', 'iso' => 'AZ'],
        ['code' => '+1242', 'name' => 'Bahamas', 'flag' => '🇧🇸', 'format' => '(242) 359-1234', 'iso' => 'BS'],
        ['code' => '+973', 'name' => 'Bahrain', 'flag' => '🇧🇭', 'format' => '3600 1234', 'iso' => 'BH'],
        ['code' => '+880', 'name' => 'Bangladesh', 'flag' => '🇧🇩', 'format' => '018 12345678', 'iso' => 'BD'],
        ['code' => '+1246', 'name' => 'Barbados', 'flag' => '🇧🇧', 'format' => '(246) 250-1234', 'iso' => 'BB'],
        ['code' => '+375', 'name' => 'Belarus', 'flag' => '🇧🇾', 'format' => '029 1234567', 'iso' => 'BY'],
        ['code' => '+32', 'name' => 'Belgium', 'flag' => '🇧🇪', 'format' => '0470 12 34 56', 'iso' => 'BE'],
        ['code' => '+501', 'name' => 'Belize', 'flag' => '🇧🇿', 'format' => '622-1234', 'iso' => 'BZ'],
        ['code' => '+229', 'name' => 'Benin', 'flag' => '🇧🇯', 'format' => '90 01 23 45', 'iso' => 'BJ'],
        ['code' => '+1441', 'name' => 'Bermuda', 'flag' => '🇧🇲', 'format' => '(441) 370-1234', 'iso' => 'BM'],
        ['code' => '+975', 'name' => 'Bhutan', 'flag' => '🇧🇹', 'format' => '17 123 456', 'iso' => 'BT'],
        ['code' => '+591', 'name' => 'Bolivia', 'flag' => '🇧🇴', 'format' => '71234567', 'iso' => 'BO'],
        ['code' => '+387', 'name' => 'Bosnia and Herzegovina', 'flag' => '🇧🇦', 'format' => '061 123 456', 'iso' => 'BA'],
        ['code' => '+267', 'name' => 'Botswana', 'flag' => '🇧🇼', 'format' => '71 123 456', 'iso' => 'BW'],
        ['code' => '+55', 'name' => 'Brazil', 'flag' => '🇧🇷', 'format' => '11 98765-4321', 'iso' => 'BR'],
        ['code' => '+246', 'name' => 'British Indian Ocean Territory', 'flag' => '🇮🇴', 'format' => '380 1234', 'iso' => 'IO'],
        ['code' => '+673', 'name' => 'Brunei', 'flag' => '🇧🇳', 'format' => '712 3456', 'iso' => 'BN'],
        ['code' => '+359', 'name' => 'Bulgaria', 'flag' => '🇧🇬', 'format' => '087 123 4567', 'iso' => 'BG'],
        ['code' => '+226', 'name' => 'Burkina Faso', 'flag' => '🇧🇫', 'format' => '70 12 34 56', 'iso' => 'BF'],
        ['code' => '+257', 'name' => 'Burundi', 'flag' => '🇧🇮', 'format' => '79 56 12 34', 'iso' => 'BI'],
        ['code' => '+855', 'name' => 'Cambodia', 'flag' => '🇰🇭', 'format' => '012 345 678', 'iso' => 'KH'],
        ['code' => '+237', 'name' => 'Cameroon', 'flag' => '🇨🇲', 'format' => '6 71 23 45 67', 'iso' => 'CM'],
        ['code' => '+1', 'name' => 'Canada', 'flag' => '🇨🇦', 'format' => '(555) 123-4567', 'iso' => 'CA'],
        ['code' => '+238', 'name' => 'Cape Verde', 'flag' => '🇨🇻', 'format' => '991 12 34', 'iso' => 'CV'],
        ['code' => '+1345', 'name' => 'Cayman Islands', 'flag' => '🇰🇾', 'format' => '(345) 323-1234', 'iso' => 'KY'],
        ['code' => '+236', 'name' => 'Central African Republic', 'flag' => '🇨🇫', 'format' => '70 01 23 45', 'iso' => 'CF'],
        ['code' => '+235', 'name' => 'Chad', 'flag' => '🇹🇩', 'format' => '63 01 23 45', 'iso' => 'TD'],
        ['code' => '+56', 'name' => 'Chile', 'flag' => '🇨🇱', 'format' => '9 1234 5678', 'iso' => 'CL'],
        ['code' => '+86', 'name' => 'China', 'flag' => '🇨🇳', 'format' => '138 1234 5678', 'iso' => 'CN'],
        ['code' => '+61', 'name' => 'Christmas Island', 'flag' => '🇨🇽', 'format' => '0412 345 678', 'iso' => 'CX'],
        ['code' => '+61', 'name' => 'Cocos (Keeling) Islands', 'flag' => '🇨🇨', 'format' => '0412 345 678', 'iso' => 'CC'],
        ['code' => '+57', 'name' => 'Colombia', 'flag' => '🇨🇴', 'format' => '300 123 4567', 'iso' => 'CO'],
        ['code' => '+269', 'name' => 'Comoros', 'flag' => '🇰🇲', 'format' => '321 23 45', 'iso' => 'KM'],
        ['code' => '+242', 'name' => 'Congo', 'flag' => '🇨🇬', 'format' => '06 123 4567', 'iso' => 'CG'],
        ['code' => '+243', 'name' => 'Congo (DRC)', 'flag' => '🇨🇩', 'format' => '0991 234 567', 'iso' => 'CD'],
        ['code' => '+682', 'name' => 'Cook Islands', 'flag' => '🇨🇰', 'format' => '71 234', 'iso' => 'CK'],
        ['code' => '+506', 'name' => 'Costa Rica', 'flag' => '🇨🇷', 'format' => '8312 3456', 'iso' => 'CR'],
        ['code' => '+225', 'name' => 'Côte d\'Ivoire', 'flag' => '🇨🇮', 'format' => '01 23 45 67', 'iso' => 'CI'],
        ['code' => '+385', 'name' => 'Croatia', 'flag' => '🇭🇷', 'format' => '091 234 5678', 'iso' => 'HR'],
        ['code' => '+53', 'name' => 'Cuba', 'flag' => '🇨🇺', 'format' => '05 1234567', 'iso' => 'CU'],
        ['code' => '+357', 'name' => 'Cyprus', 'flag' => '🇨🇾', 'format' => '96 123456', 'iso' => 'CY'],
        ['code' => '+420', 'name' => 'Czech Republic', 'flag' => '🇨🇿', 'format' => '601 234 567', 'iso' => 'CZ'],
        ['code' => '+45', 'name' => 'Denmark', 'flag' => '🇩🇰', 'format' => '12 34 56 78', 'iso' => 'DK'],
        ['code' => '+253', 'name' => 'Djibouti', 'flag' => '🇩🇯', 'format' => '77 123456', 'iso' => 'DJ'],
        ['code' => '+1767', 'name' => 'Dominica', 'flag' => '🇩🇲', 'format' => '(767) 225-1234', 'iso' => 'DM'],
        ['code' => '+1', 'name' => 'Dominican Republic', 'flag' => '🇩🇴', 'format' => '(809) 234-5678', 'iso' => 'DO'],
        ['code' => '+593', 'name' => 'Ecuador', 'flag' => '🇪🇨', 'format' => '099 123 4567', 'iso' => 'EC'],
        ['code' => '+20', 'name' => 'Egypt', 'flag' => '🇪🇬', 'format' => '0100 123 4567', 'iso' => 'EG'],
        ['code' => '+503', 'name' => 'El Salvador', 'flag' => '🇸🇻', 'format' => '7012 3456', 'iso' => 'SV'],
        ['code' => '+240', 'name' => 'Equatorial Guinea', 'flag' => '🇬🇶', 'format' => '222 123 456', 'iso' => 'GQ'],
        ['code' => '+291', 'name' => 'Eritrea', 'flag' => '🇪🇷', 'format' => '07 123 456', 'iso' => 'ER'],
        ['code' => '+372', 'name' => 'Estonia', 'flag' => '🇪🇪', 'format' => '5123 4567', 'iso' => 'EE'],
        ['code' => '+251', 'name' => 'Ethiopia', 'flag' => '🇪🇹', 'format' => '091 123 4567', 'iso' => 'ET'],
        ['code' => '+500', 'name' => 'Falkland Islands', 'flag' => '🇫🇰', 'format' => '51234', 'iso' => 'FK'],
        ['code' => '+298', 'name' => 'Faroe Islands', 'flag' => '🇫🇴', 'format' => '211234', 'iso' => 'FO'],
        ['code' => '+679', 'name' => 'Fiji', 'flag' => '🇫🇯', 'format' => '701 2345', 'iso' => 'FJ'],
        ['code' => '+358', 'name' => 'Finland', 'flag' => '🇫🇮', 'format' => '040 123 4567', 'iso' => 'FI'],
        ['code' => '+33', 'name' => 'France', 'flag' => '🇫🇷', 'format' => '06 12 34 56 78', 'iso' => 'FR'],
        ['code' => '+594', 'name' => 'French Guiana', 'flag' => '🇬🇫', 'format' => '0694 20 12 34', 'iso' => 'GF'],
        ['code' => '+689', 'name' => 'French Polynesia', 'flag' => '🇵🇫', 'format' => '87 12 34 56', 'iso' => 'PF'],
        ['code' => '+241', 'name' => 'Gabon', 'flag' => '🇬🇦', 'format' => '06 03 12 34', 'iso' => 'GA'],
        ['code' => '+220', 'name' => 'Gambia', 'flag' => '🇬🇲', 'format' => '301 2345', 'iso' => 'GM'],
        ['code' => '+995', 'name' => 'Georgia', 'flag' => '🇬🇪', 'format' => '555 12 34 56', 'iso' => 'GE'],
        ['code' => '+49', 'name' => 'Germany', 'flag' => '🇩🇪', 'format' => '0171 1234567', 'iso' => 'DE'],
        ['code' => '+233', 'name' => 'Ghana', 'flag' => '🇬🇭', 'format' => '020 123 4567', 'iso' => 'GH'],
        ['code' => '+350', 'name' => 'Gibraltar', 'flag' => '🇬🇮', 'format' => '57123456', 'iso' => 'GI'],
        ['code' => '+30', 'name' => 'Greece', 'flag' => '🇬🇷', 'format' => '691 234 5678', 'iso' => 'GR'],
        ['code' => '+299', 'name' => 'Greenland', 'flag' => '🇬🇱', 'format' => '22 12 34', 'iso' => 'GL'],
        ['code' => '+1473', 'name' => 'Grenada', 'flag' => '🇬🇩', 'format' => '(473) 403-1234', 'iso' => 'GD'],
        ['code' => '+590', 'name' => 'Guadeloupe', 'flag' => '🇬🇵', 'format' => '0690 30 12 34', 'iso' => 'GP'],
        ['code' => '+1671', 'name' => 'Guam', 'flag' => '🇬🇺', 'format' => '(671) 300-1234', 'iso' => 'GU'],
        ['code' => '+502', 'name' => 'Guatemala', 'flag' => '🇬🇹', 'format' => '5123 4567', 'iso' => 'GT'],
        ['code' => '+44', 'name' => 'Guernsey', 'flag' => '🇬🇬', 'format' => '07781 123456', 'iso' => 'GG'],
        ['code' => '+224', 'name' => 'Guinea', 'flag' => '🇬🇳', 'format' => '601 12 34 56', 'iso' => 'GN'],
        ['code' => '+245', 'name' => 'Guinea-Bissau', 'flag' => '🇬🇼', 'format' => '955 012 345', 'iso' => 'GW'],
        ['code' => '+592', 'name' => 'Guyana', 'flag' => '🇬🇾', 'format' => '609 1234', 'iso' => 'GY'],
        ['code' => '+509', 'name' => 'Haiti', 'flag' => '🇭🇹', 'format' => '34 10 1234', 'iso' => 'HT'],
        ['code' => '+504', 'name' => 'Honduras', 'flag' => '🇭🇳', 'format' => '9123-4567', 'iso' => 'HN'],
        ['code' => '+852', 'name' => 'Hong Kong', 'flag' => '🇭🇰', 'format' => '5123 4567', 'iso' => 'HK'],
        ['code' => '+36', 'name' => 'Hungary', 'flag' => '🇭🇺', 'format' => '06 20 123 4567', 'iso' => 'HU'],
        ['code' => '+354', 'name' => 'Iceland', 'flag' => '🇮🇸', 'format' => '611 1234', 'iso' => 'IS'],
        ['code' => '+91', 'name' => 'India', 'flag' => '🇮🇳', 'format' => '98765 43210', 'iso' => 'IN'],
        ['code' => '+62', 'name' => 'Indonesia', 'flag' => '🇮🇩', 'format' => '0812-3456-7890', 'iso' => 'ID'],
        ['code' => '+98', 'name' => 'Iran', 'flag' => '🇮🇷', 'format' => '0912 345 6789', 'iso' => 'IR'],
        ['code' => '+964', 'name' => 'Iraq', 'flag' => '🇮🇶', 'format' => '0790 123 4567', 'iso' => 'IQ'],
        ['code' => '+353', 'name' => 'Ireland', 'flag' => '🇮🇪', 'format' => '087 123 4567', 'iso' => 'IE'],
        ['code' => '+44', 'name' => 'Isle of Man', 'flag' => '🇮🇲', 'format' => '07924 123456', 'iso' => 'IM'],
        ['code' => '+972', 'name' => 'Israel', 'flag' => '🇮🇱', 'format' => '050-123-4567', 'iso' => 'IL'],
        ['code' => '+39', 'name' => 'Italy', 'flag' => '🇮🇹', 'format' => '312 123 4567', 'iso' => 'IT'],
        ['code' => '+1876', 'name' => 'Jamaica', 'flag' => '🇯🇲', 'format' => '(876) 210-1234', 'iso' => 'JM'],
        ['code' => '+81', 'name' => 'Japan', 'flag' => '🇯🇵', 'format' => '090-1234-5678', 'iso' => 'JP'],
        ['code' => '+44', 'name' => 'Jersey', 'flag' => '🇯🇪', 'format' => '07797 123456', 'iso' => 'JE'],
        ['code' => '+962', 'name' => 'Jordan', 'flag' => '🇯🇴', 'format' => '079 123 4567', 'iso' => 'JO'],
        ['code' => '+7', 'name' => 'Kazakhstan', 'flag' => '🇰🇿', 'format' => '701 234 5678', 'iso' => 'KZ'],
        ['code' => '+254', 'name' => 'Kenya', 'flag' => '🇰🇪', 'format' => '0712 345 678', 'iso' => 'KE'],
        ['code' => '+686', 'name' => 'Kiribati', 'flag' => '🇰🇮', 'format' => '72012345', 'iso' => 'KI'],
        ['code' => '+965', 'name' => 'Kuwait', 'flag' => '🇰🇼', 'format' => '500 12345', 'iso' => 'KW'],
        ['code' => '+996', 'name' => 'Kyrgyzstan', 'flag' => '🇰🇬', 'format' => '0700 123 456', 'iso' => 'KG'],
        ['code' => '+856', 'name' => 'Laos', 'flag' => '🇱🇦', 'format' => '020 23 123 456', 'iso' => 'LA'],
        ['code' => '+371', 'name' => 'Latvia', 'flag' => '🇱🇻', 'format' => '21 234 567', 'iso' => 'LV'],
        ['code' => '+961', 'name' => 'Lebanon', 'flag' => '🇱🇧', 'format' => '03 123 456', 'iso' => 'LB'],
        ['code' => '+266', 'name' => 'Lesotho', 'flag' => '🇱🇸', 'format' => '5012 3456', 'iso' => 'LS'],
        ['code' => '+231', 'name' => 'Liberia', 'flag' => '🇱🇷', 'format' => '077 012 3456', 'iso' => 'LR'],
        ['code' => '+218', 'name' => 'Libya', 'flag' => '🇱🇾', 'format' => '091 234 5678', 'iso' => 'LY'],
        ['code' => '+423', 'name' => 'Liechtenstein', 'flag' => '🇱🇮', 'format' => '660 1234', 'iso' => 'LI'],
        ['code' => '+370', 'name' => 'Lithuania', 'flag' => '🇱🇹', 'format' => '612 34567', 'iso' => 'LT'],
        ['code' => '+352', 'name' => 'Luxembourg', 'flag' => '🇱🇺', 'format' => '621 123 456', 'iso' => 'LU'],
        ['code' => '+853', 'name' => 'Macau', 'flag' => '🇲🇴', 'format' => '6612 3456', 'iso' => 'MO'],
        ['code' => '+389', 'name' => 'North Macedonia', 'flag' => '🇲🇰', 'format' => '070 123 456', 'iso' => 'MK'],
        ['code' => '+261', 'name' => 'Madagascar', 'flag' => '🇲🇬', 'format' => '032 12 345 67', 'iso' => 'MG'],
        ['code' => '+265', 'name' => 'Malawi', 'flag' => '🇲🇼', 'format' => '0991 23 45 67', 'iso' => 'MW'],
        ['code' => '+60', 'name' => 'Malaysia', 'flag' => '🇲🇾', 'format' => '012-345 6789', 'iso' => 'MY'],
        ['code' => '+960', 'name' => 'Maldives', 'flag' => '🇲🇻', 'format' => '771-2345', 'iso' => 'MV'],
        ['code' => '+223', 'name' => 'Mali', 'flag' => '🇲🇱', 'format' => '65 01 23 45', 'iso' => 'ML'],
        ['code' => '+356', 'name' => 'Malta', 'flag' => '🇲🇹', 'format' => '9923 4567', 'iso' => 'MT'],
        ['code' => '+692', 'name' => 'Marshall Islands', 'flag' => '🇲🇭', 'format' => '235-1234', 'iso' => 'MH'],
        ['code' => '+596', 'name' => 'Martinique', 'flag' => '🇲🇶', 'format' => '0696 20 12 34', 'iso' => 'MQ'],
        ['code' => '+222', 'name' => 'Mauritania', 'flag' => '🇲🇷', 'format' => '22 12 34 56', 'iso' => 'MR'],
        ['code' => '+230', 'name' => 'Mauritius', 'flag' => '🇲🇺', 'format' => '5251 2345', 'iso' => 'MU'],
        ['code' => '+262', 'name' => 'Mayotte', 'flag' => '🇾🇹', 'format' => '0639 12 34 56', 'iso' => 'YT'],
        ['code' => '+52', 'name' => 'Mexico', 'flag' => '🇲🇽', 'format' => '044 55 1234 5678', 'iso' => 'MX'],
        ['code' => '+691', 'name' => 'Micronesia', 'flag' => '🇫🇲', 'format' => '350 1234', 'iso' => 'FM'],
        ['code' => '+373', 'name' => 'Moldova', 'flag' => '🇲🇩', 'format' => '0621 12 345', 'iso' => 'MD'],
        ['code' => '+377', 'name' => 'Monaco', 'flag' => '🇲🇨', 'format' => '06 12 34 56 78', 'iso' => 'MC'],
        ['code' => '+976', 'name' => 'Mongolia', 'flag' => '🇲🇳', 'format' => '8812 3456', 'iso' => 'MN'],
        ['code' => '+382', 'name' => 'Montenegro', 'flag' => '🇲🇪', 'format' => '067 123 456', 'iso' => 'ME'],
        ['code' => '+1664', 'name' => 'Montserrat', 'flag' => '🇲🇸', 'format' => '(664) 492-1234', 'iso' => 'MS'],
        ['code' => '+212', 'name' => 'Morocco', 'flag' => '🇲🇦', 'format' => '0612-345678', 'iso' => 'MA'],
        ['code' => '+258', 'name' => 'Mozambique', 'flag' => '🇲🇿', 'format' => '82 123 4567', 'iso' => 'MZ'],
        ['code' => '+95', 'name' => 'Myanmar (Burma)', 'flag' => '🇲🇲', 'format' => '09 123 456789', 'iso' => 'MM'],
        ['code' => '+264', 'name' => 'Namibia', 'flag' => '🇳🇦', 'format' => '081 123 4567', 'iso' => 'NA'],
        ['code' => '+674', 'name' => 'Nauru', 'flag' => '🇳🇷', 'format' => '555 1234', 'iso' => 'NR'],
        ['code' => '+977', 'name' => 'Nepal', 'flag' => '🇳🇵', 'format' => '984-1234567', 'iso' => 'NP'],
        ['code' => '+31', 'name' => 'Netherlands', 'flag' => '🇳🇱', 'format' => '06 12345678', 'iso' => 'NL'],
        ['code' => '+687', 'name' => 'New Caledonia', 'flag' => '🇳🇨', 'format' => '75.12.34', 'iso' => 'NC'],
        ['code' => '+64', 'name' => 'New Zealand', 'flag' => '🇳🇿', 'format' => '021 123 4567', 'iso' => 'NZ'],
        ['code' => '+505', 'name' => 'Nicaragua', 'flag' => '🇳🇮', 'format' => '8123 4567', 'iso' => 'NI'],
        ['code' => '+227', 'name' => 'Niger', 'flag' => '🇳🇪', 'format' => '93 12 34 56', 'iso' => 'NE'],
        ['code' => '+234', 'name' => 'Nigeria', 'flag' => '🇳🇬', 'format' => '0801 234 5678', 'iso' => 'NG'],
        ['code' => '+683', 'name' => 'Niue', 'flag' => '🇳🇺', 'format' => '888 4012', 'iso' => 'NU'],
        ['code' => '+672', 'name' => 'Norfolk Island', 'flag' => '🇳🇫', 'format' => '3 81234', 'iso' => 'NF'],
        ['code' => '+850', 'name' => 'North Korea', 'flag' => '🇰🇵', 'format' => '0192 123 4567', 'iso' => 'KP'],
        ['code' => '+47', 'name' => 'Norway', 'flag' => '🇳🇴', 'format' => '412 34 567', 'iso' => 'NO'],
        ['code' => '+968', 'name' => 'Oman', 'flag' => '🇴🇲', 'format' => '9212 3456', 'iso' => 'OM'],
        ['code' => '+92', 'name' => 'Pakistan', 'flag' => '🇵🇰', 'format' => '0301 2345678', 'iso' => 'PK'],
        ['code' => '+680', 'name' => 'Palau', 'flag' => '🇵🇼', 'format' => '620 1234', 'iso' => 'PW'],
        ['code' => '+970', 'name' => 'Palestine', 'flag' => '🇵🇸', 'format' => '0599 123 456', 'iso' => 'PS'],
        ['code' => '+507', 'name' => 'Panama', 'flag' => '🇵🇦', 'format' => '6123-4567', 'iso' => 'PA'],
        ['code' => '+675', 'name' => 'Papua New Guinea', 'flag' => '🇵🇬', 'format' => '7012 3456', 'iso' => 'PG'],
        ['code' => '+595', 'name' => 'Paraguay', 'flag' => '🇵🇾', 'format' => '0981 123456', 'iso' => 'PY'],
        ['code' => '+51', 'name' => 'Peru', 'flag' => '🇵🇪', 'format' => '999 123 456', 'iso' => 'PE'],
        ['code' => '+63', 'name' => 'Philippines', 'flag' => '🇵🇭', 'format' => '0917 123 4567', 'iso' => 'PH'],
        ['code' => '+48', 'name' => 'Poland', 'flag' => '🇵🇱', 'format' => '512 345 678', 'iso' => 'PL'],
        ['code' => '+351', 'name' => 'Portugal', 'flag' => '🇵🇹', 'format' => '912 345 678', 'iso' => 'PT'],
        ['code' => '+1', 'name' => 'Puerto Rico', 'flag' => '🇵🇷', 'format' => '(787) 234-5678', 'iso' => 'PR'],
        ['code' => '+974', 'name' => 'Qatar', 'flag' => '🇶🇦', 'format' => '3312 3456', 'iso' => 'QA'],
        ['code' => '+262', 'name' => 'Réunion', 'flag' => '🇷🇪', 'format' => '0692 12 34 56', 'iso' => 'RE'],
        ['code' => '+40', 'name' => 'Romania', 'flag' => '🇷🇴', 'format' => '0712 345 678', 'iso' => 'RO'],
        ['code' => '+7', 'name' => 'Russia', 'flag' => '🇷🇺', 'format' => '912 345-67-89', 'iso' => 'RU'],
        ['code' => '+250', 'name' => 'Rwanda', 'flag' => '🇷🇼', 'format' => '0720 123 456', 'iso' => 'RW'],
        ['code' => '+590', 'name' => 'Saint Barthélemy', 'flag' => '🇧🇱', 'format' => '0690 27 12 34', 'iso' => 'BL'],
        ['code' => '+290', 'name' => 'Saint Helena', 'flag' => '🇸🇭', 'format' => '51234', 'iso' => 'SH'],
        ['code' => '+1869', 'name' => 'Saint Kitts and Nevis', 'flag' => '🇰🇳', 'format' => '(869) 765-1234', 'iso' => 'KN'],
        ['code' => '+1758', 'name' => 'Saint Lucia', 'flag' => '🇱🇨', 'format' => '(758) 284-1234', 'iso' => 'LC'],
        ['code' => '+590', 'name' => 'Saint Martin', 'flag' => '🇲🇫', 'format' => '0690 12 34 56', 'iso' => 'MF'],
        ['code' => '+508', 'name' => 'Saint Pierre and Miquelon', 'flag' => '🇵🇲', 'format' => '055 12 34', 'iso' => 'PM'],
        ['code' => '+1784', 'name' => 'Saint Vincent and the Grenadines', 'flag' => '🇻🇨', 'format' => '(784) 430-1234', 'iso' => 'VC'],
        ['code' => '+685', 'name' => 'Samoa', 'flag' => '🇼🇸', 'format' => '72 12345', 'iso' => 'WS'],
        ['code' => '+378', 'name' => 'San Marino', 'flag' => '🇸🇲', 'format' => '0549 123456', 'iso' => 'SM'],
        ['code' => '+239', 'name' => 'São Tomé and Príncipe', 'flag' => '🇸🇹', 'format' => '981 2345', 'iso' => 'ST'],
        ['code' => '+966', 'name' => 'Saudi Arabia', 'flag' => '🇸🇦', 'format' => '050 123 4567', 'iso' => 'SA'],
        ['code' => '+221', 'name' => 'Senegal', 'flag' => '🇸🇳', 'format' => '77 123 45 67', 'iso' => 'SN'],
        ['code' => '+381', 'name' => 'Serbia', 'flag' => '🇷🇸', 'format' => '060 1234567', 'iso' => 'RS'],
        ['code' => '+248', 'name' => 'Seychelles', 'flag' => '🇸🇨', 'format' => '2 510 123', 'iso' => 'SC'],
        ['code' => '+232', 'name' => 'Sierra Leone', 'flag' => '🇸🇱', 'format' => '025 123456', 'iso' => 'SL'],
        ['code' => '+65', 'name' => 'Singapore', 'flag' => '🇸🇬', 'format' => '8123 4567', 'iso' => 'SG'],
        ['code' => '+1721', 'name' => 'Sint Maarten', 'flag' => '🇸🇽', 'format' => '(721) 520-1234', 'iso' => 'SX'],
        ['code' => '+421', 'name' => 'Slovakia', 'flag' => '🇸🇰', 'format' => '0912 123 456', 'iso' => 'SK'],
        ['code' => '+386', 'name' => 'Slovenia', 'flag' => '🇸🇮', 'format' => '031 234 567', 'iso' => 'SI'],
        ['code' => '+677', 'name' => 'Solomon Islands', 'flag' => '🇸🇧', 'format' => '74 12345', 'iso' => 'SB'],
        ['code' => '+252', 'name' => 'Somalia', 'flag' => '🇸🇴', 'format' => '7 123456', 'iso' => 'SO'],
        ['code' => '+27', 'name' => 'South Africa', 'flag' => '🇿🇦', 'format' => '071 123 4567', 'iso' => 'ZA'],
        ['code' => '+82', 'name' => 'South Korea', 'flag' => '🇰🇷', 'format' => '010-1234-5678', 'iso' => 'KR'],
        ['code' => '+211', 'name' => 'South Sudan', 'flag' => '🇸🇸', 'format' => '0977 123 456', 'iso' => 'SS'],
        ['code' => '+34', 'name' => 'Spain', 'flag' => '🇪🇸', 'format' => '612 345 678', 'iso' => 'ES'],
        ['code' => '+94', 'name' => 'Sri Lanka', 'flag' => '🇱🇰', 'format' => '071 234 5678', 'iso' => 'LK'],
        ['code' => '+249', 'name' => 'Sudan', 'flag' => '🇸🇩', 'format' => '91 234 5678', 'iso' => 'SD'],
        ['code' => '+597', 'name' => 'Suriname', 'flag' => '🇸🇷', 'format' => '741-2345', 'iso' => 'SR'],
        ['code' => '+268', 'name' => 'Eswatini', 'flag' => '🇸🇿', 'format' => '7612 3456', 'iso' => 'SZ'],
        ['code' => '+46', 'name' => 'Sweden', 'flag' => '🇸🇪', 'format' => '070-123 45 67', 'iso' => 'SE'],
        ['code' => '+41', 'name' => 'Switzerland', 'flag' => '🇨🇭', 'format' => '076 123 45 67', 'iso' => 'CH'],
        ['code' => '+963', 'name' => 'Syria', 'flag' => '🇸🇾', 'format' => '0944 567 890', 'iso' => 'SY'],
        ['code' => '+886', 'name' => 'Taiwan', 'flag' => '🇹🇼', 'format' => '0912 345 678', 'iso' => 'TW'],
        ['code' => '+992', 'name' => 'Tajikistan', 'flag' => '🇹🇯', 'format' => '917 12 3456', 'iso' => 'TJ'],
        ['code' => '+255', 'name' => 'Tanzania', 'flag' => '🇹🇿', 'format' => '0712 345 678', 'iso' => 'TZ'],
        ['code' => '+66', 'name' => 'Thailand', 'flag' => '🇹🇭', 'format' => '081 234 5678', 'iso' => 'TH'],
        ['code' => '+670', 'name' => 'Timor-Leste', 'flag' => '🇹🇱', 'format' => '7721 2345', 'iso' => 'TL'],
        ['code' => '+228', 'name' => 'Togo', 'flag' => '🇹🇬', 'format' => '90 11 23 45', 'iso' => 'TG'],
        ['code' => '+690', 'name' => 'Tokelau', 'flag' => '🇹🇰', 'format' => '3123', 'iso' => 'TK'],
        ['code' => '+676', 'name' => 'Tonga', 'flag' => '🇹🇴', 'format' => '771 5123', 'iso' => 'TO'],
        ['code' => '+1868', 'name' => 'Trinidad and Tobago', 'flag' => '🇹🇹', 'format' => '(868) 291-1234', 'iso' => 'TT'],
        ['code' => '+216', 'name' => 'Tunisia', 'flag' => '🇹🇳', 'format' => '20 123 456', 'iso' => 'TN'],
        ['code' => '+90', 'name' => 'Turkey', 'flag' => '🇹🇷', 'format' => '0532 123 4567', 'iso' => 'TR'],
        ['code' => '+993', 'name' => 'Turkmenistan', 'flag' => '🇹🇲', 'format' => '65 123456', 'iso' => 'TM'],
        ['code' => '+1649', 'name' => 'Turks and Caicos Islands', 'flag' => '🇹🇨', 'format' => '(649) 231-1234', 'iso' => 'TC'],
        ['code' => '+688', 'name' => 'Tuvalu', 'flag' => '🇹🇻', 'format' => '901234', 'iso' => 'TV'],
        ['code' => '+256', 'name' => 'Uganda', 'flag' => '🇺🇬', 'format' => '0712 345 678', 'iso' => 'UG'],
        ['code' => '+380', 'name' => 'Ukraine', 'flag' => '🇺🇦', 'format' => '050 123 4567', 'iso' => 'UA'],
        ['code' => '+971', 'name' => 'United Arab Emirates', 'flag' => '🇦🇪', 'format' => '050 123 4567', 'iso' => 'AE'],
        ['code' => '+44', 'name' => 'United Kingdom', 'flag' => '🇬🇧', 'format' => '07123 456789', 'iso' => 'GB'],
        ['code' => '+1', 'name' => 'United States', 'flag' => '🇺🇸', 'format' => '(555) 123-4567', 'iso' => 'US'],
        ['code' => '+598', 'name' => 'Uruguay', 'flag' => '🇺🇾', 'format' => '099 123 456', 'iso' => 'UY'],
        ['code' => '+998', 'name' => 'Uzbekistan', 'flag' => '🇺🇿', 'format' => '8 91 234 56 78', 'iso' => 'UZ'],
        ['code' => '+678', 'name' => 'Vanuatu', 'flag' => '🇻🇺', 'format' => '591 2345', 'iso' => 'VU'],
        ['code' => '+379', 'name' => 'Vatican City', 'flag' => '🇻🇦', 'format' => '312 345 678', 'iso' => 'VA'],
        ['code' => '+58', 'name' => 'Venezuela', 'flag' => '🇻🇪', 'format' => '0412 123 4567', 'iso' => 'VE'],
        ['code' => '+84', 'name' => 'Vietnam', 'flag' => '🇻🇳', 'format' => '090 123 4567', 'iso' => 'VN'],
        ['code' => '+681', 'name' => 'Wallis and Futuna', 'flag' => '🇼🇫', 'format' => '50 12 34', 'iso' => 'WF'],
        ['code' => '+967', 'name' => 'Yemen', 'flag' => '🇾🇪', 'format' => '0712 345 678', 'iso' => 'YE'],
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
