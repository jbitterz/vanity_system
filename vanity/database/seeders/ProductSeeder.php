<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // MAC Products
            ['sku' => 'MAC-001', 'name' => 'Studio Fix Fluid SPF 15 24HR Matte Foundation', 'brand' => 'MAC', 'category' => 'Face', 'description' => 'Long-lasting matte foundation', 'price' => 1299.00, 'stock' => 50],
            ['sku' => 'MAC-002', 'name' => 'Studio Radiance Serum-Powered Foundation', 'brand' => 'MAC', 'category' => 'Face', 'description' => 'Radiant foundation with serum', 'price' => 1299.00, 'stock' => 45],
            ['sku' => 'MAC-003', 'name' => 'Ruby Woo Lipstick', 'brand' => 'MAC', 'category' => 'Lips', 'description' => 'Classic red lipstick', 'price' => 599.00, 'stock' => 60],
            ['sku' => 'MAC-004', 'name' => 'M·A·CStack Lash Mascara', 'brand' => 'MAC', 'category' => 'Eyes', 'description' => 'Volumizing mascara', 'price' => 499.00, 'stock' => 70],
            ['sku' => 'MAC-005', 'name' => 'Prep + Prime Skin', 'brand' => 'MAC', 'category' => 'Face', 'description' => 'Face primer', 'price' => 799.00, 'stock' => 40],

            // L'Oréal Products
            ['sku' => 'LOR-001', 'name' => 'Infallible 32HR Matte Cover Foundation', 'brand' => 'Loreal', 'category' => 'Face', 'description' => '32HR matte foundation', 'price' => 499.00, 'stock' => 50],
            ['sku' => 'LOR-002', 'name' => 'Voluminous Lash Paradise Mascara', 'brand' => 'Loreal', 'category' => 'Eyes', 'description' => 'Volume mascara', 'price' => 299.00, 'stock' => 65],
            ['sku' => 'LOR-003', 'name' => 'True Match Super-Blendable Foundation', 'brand' => 'Loreal', 'category' => 'Face', 'description' => 'Blendable foundation', 'price' => 499.00, 'stock' => 45],
            ['sku' => 'LOR-004', 'name' => 'Revitalift Triple Action Day Cream', 'brand' => 'Loreal', 'category' => 'Skin', 'description' => 'Anti-aging day cream', 'price' => 799.00, 'stock' => 30],
            ['sku' => 'LOR-005', 'name' => 'EverPure Color Protect Shampoo', 'brand' => 'Loreal', 'category' => 'Skin', 'description' => 'Color protect shampoo', 'price' => 399.00, 'stock' => 40],

            // Olay Products
            ['sku' => 'OLAY-001', 'name' => 'Olay Regenerist Micro-Sculpting Cream', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Anti-aging moisturizer', 'price' => 899.00, 'stock' => 35],
            ['sku' => 'OLAY-002', 'name' => 'Olay Vitamin C Brightening Serum', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Brightening serum', 'price' => 799.00, 'stock' => 25],
            ['sku' => 'OLAY-003', 'name' => 'Olay Gentle Cleansing Melts', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Gentle cleansing melts', 'price' => 399.00, 'stock' => 50],
            ['sku' => 'OLAY-004', 'name' => 'Olay Ultra Moisture Body Wash', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Hydrating body wash', 'price' => 399.00, 'stock' => 45],
            ['sku' => 'OLAY-005', 'name' => 'Olay Total Effects Day Cream SPF 15', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'SPF day cream', 'price' => 699.00, 'stock' => 30],

            // Sephora Products
            ['sku' => 'SEP-001', 'name' => 'Sephora Collection Matte Lipstick', 'brand' => 'Sephora', 'category' => 'Lips', 'description' => 'Long-lasting matte lipstick', 'price' => 599.00, 'stock' => 50],
            ['sku' => 'SEP-002', 'name' => 'Sephora Pro Eyeshadow Palette', 'brand' => 'Sephora', 'category' => 'Eyes', 'description' => 'Professional 12-color eyeshadow palette', 'price' => 1299.00, 'stock' => 30],
            ['sku' => 'SEP-003', 'name' => 'Glow Perfection Foundation', 'brand' => 'Sephora', 'category' => 'Face', 'description' => 'Luminous foundation', 'price' => 1299.00, 'stock' => 25],
            ['sku' => 'SEP-004', 'name' => 'Super Glow Toner', 'brand' => 'Sephora', 'category' => 'Skin', 'description' => 'Brightening toner', 'price' => 599.00, 'stock' => 40],
            ['sku' => 'SEP-005', 'name' => 'Starter Brushes Set', 'brand' => 'Sephora', 'category' => 'Tools', 'description' => 'Essential makeup brushes', 'price' => 899.00, 'stock' => 35],

            // Maybelline Products
            ['sku' => 'MAY-001', 'name' => 'Maybelline Super Stay Foundation', 'brand' => 'Maybelline', 'category' => 'Face', 'description' => '24-hour wear foundation', 'price' => 499.00, 'stock' => 50],
            ['sku' => 'MAY-002', 'name' => 'Maybelline Lash Sensational Mascara', 'brand' => 'Maybelline', 'category' => 'Eyes', 'description' => 'Lengthening mascara', 'price' => 299.00, 'stock' => 70],
            ['sku' => 'MAY-003', 'name' => 'Maybelline Fit Me Blush', 'brand' => 'Maybelline', 'category' => 'Face', 'description' => 'Natural blush', 'price' => 399.00, 'stock' => 45],
            ['sku' => 'MAY-004', 'name' => 'Maybelline Baby Lips Balm', 'brand' => 'Maybelline', 'category' => 'Lips', 'description' => 'Moisturizing lip balm', 'price' => 199.00, 'stock' => 60],
            ['sku' => 'MAY-005', 'name' => 'Maybelline Master Chrome Highlighter', 'brand' => 'Maybelline', 'category' => 'Face', 'description' => 'Metallic highlighter', 'price' => 499.00, 'stock' => 40],

            // Additional MAC Products
            ['sku' => 'MAC-006', 'name' => 'Studio Fix 24-Hour Smooth Wear Concealer', 'brand' => 'MAC', 'category' => 'Face', 'description' => 'Long-wear concealer', 'price' => 699.00, 'stock' => 55],
            ['sku' => 'MAC-007', 'name' => 'M·A·CXIMAL SLEEK SATIN LIPSTICK', 'brand' => 'MAC', 'category' => 'Lips', 'description' => 'Satin lipstick', 'price' => 599.00, 'stock' => 40],
            ['sku' => 'MAC-008', 'name' => 'Eye Shadow Glitter', 'brand' => 'MAC', 'category' => 'Eyes', 'description' => 'Glitter eyeshadow', 'price' => 399.00, 'stock' => 35],
            ['sku' => 'MAC-009', 'name' => 'Hyper Real Fresh Canvas Cleansing Oil', 'brand' => 'MAC', 'category' => 'Skin', 'description' => 'Cleansing oil', 'price' => 799.00, 'stock' => 30],
            ['sku' => 'MAC-010', 'name' => 'M·A·C Of All Trades Brush Kit', 'brand' => 'MAC', 'category' => 'Tools', 'description' => 'Brush kit', 'price' => 1299.00, 'stock' => 20],

            // Additional L'Oréal Products
            ['sku' => 'LOR-006', 'name' => 'Infallible Matte Resistance 16HR Liquid Lipstick', 'brand' => 'Loreal', 'category' => 'Lips', 'description' => 'Liquid lipstick', 'price' => 499.00, 'stock' => 45],
            ['sku' => 'LOR-007', 'name' => 'Voluminous Panorama Waterproof Mascara', 'brand' => 'Loreal', 'category' => 'Eyes', 'description' => 'Waterproof mascara', 'price' => 349.00, 'stock' => 60],
            ['sku' => 'LOR-008', 'name' => 'Infallible 24HR Fresh Wear Powder Foundation', 'brand' => 'Loreal', 'category' => 'Face', 'description' => 'Powder foundation', 'price' => 499.00, 'stock' => 40],
            ['sku' => 'LOR-009', 'name' => 'Glycolic Bright Glowing Daily Cleanser', 'brand' => 'Loreal', 'category' => 'Skin', 'description' => 'Daily cleanser', 'price' => 599.00, 'stock' => 35],
            ['sku' => 'LOR-010', 'name' => 'Excellence Crème Triple Care Hair Color', 'brand' => 'Loreal', 'category' => 'Skin', 'description' => 'Hair color', 'price' => 299.00, 'stock' => 25],

            // Additional Olay Products
            ['sku' => 'OLAY-006', 'name' => 'Olay Regenerist Whip SPF 25', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'SPF moisturizer', 'price' => 899.00, 'stock' => 40],
            ['sku' => 'OLAY-007', 'name' => 'Olay Vitamin C Brightening Facial Moisturizer SPF 30', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Brightening moisturizer', 'price' => 799.00, 'stock' => 30],
            ['sku' => 'OLAY-008', 'name' => 'Olay Super Serum Body Wash', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Serum body wash', 'price' => 499.00, 'stock' => 50],
            ['sku' => 'OLAY-009', 'name' => 'Olay Day & Night Restoring Body Lotion', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Restoring body lotion', 'price' => 699.00, 'stock' => 45],
            ['sku' => 'OLAY-010', 'name' => 'Olay Collagen Peptide MAX Moisturizing Cream', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Collagen cream', 'price' => 999.00, 'stock' => 25],

            // Additional Sephora Products
            ['sku' => 'SEP-006', 'name' => 'Totally Juicy Lip Tint', 'brand' => 'Sephora', 'category' => 'Lips', 'description' => 'Juicy lip tint', 'price' => 499.00, 'stock' => 55],
            ['sku' => 'SEP-007', 'name' => 'Colorful Blush', 'brand' => 'Sephora', 'category' => 'Face', 'description' => 'Colorful blush', 'price' => 599.00, 'stock' => 40],
            ['sku' => 'SEP-008', 'name' => 'Clarifying Toner With 5% Niacinamide', 'brand' => 'Sephora', 'category' => 'Skin', 'description' => 'Clarifying toner', 'price' => 699.00, 'stock' => 35],
            ['sku' => 'SEP-009', 'name' => 'Oil Infusion Hydrating Lip Oil', 'brand' => 'Sephora', 'category' => 'Lips', 'description' => 'Hydrating lip oil', 'price' => 399.00, 'stock' => 50],
            ['sku' => 'SEP-010', 'name' => 'Essential Eye Brush Kit', 'brand' => 'Sephora', 'category' => 'Tools', 'description' => 'Eye brush kit', 'price' => 799.00, 'stock' => 30],

            // Additional Maybelline Products
            ['sku' => 'MAY-006', 'name' => 'Instant Age Rewind Perfector', 'brand' => 'Maybelline', 'category' => 'Face', 'description' => 'Instant perfector', 'price' => 599.00, 'stock' => 45],
            ['sku' => 'MAY-007', 'name' => 'Lash Sensational Sky High Mascara', 'brand' => 'Maybelline', 'category' => 'Eyes', 'description' => 'Sky high mascara', 'price' => 349.00, 'stock' => 65],
            ['sku' => 'MAY-008', 'name' => 'Color Sensational Ultimatte Slim Lipstick', 'brand' => 'Maybelline', 'category' => 'Lips', 'description' => 'Ultimatte lipstick', 'price' => 399.00, 'stock' => 55],
            ['sku' => 'MAY-009', 'name' => 'Facestudio Master Chrome Metallic Highlighter', 'brand' => 'Maybelline', 'category' => 'Face', 'description' => 'Metallic highlighter', 'price' => 499.00, 'stock' => 40],
            ['sku' => 'MAY-010', 'name' => 'Baby Lips Glow Balm', 'brand' => 'Maybelline', 'category' => 'Lips', 'description' => 'Glow lip balm', 'price' => 249.00, 'stock' => 70],

            // Additional MAC Products (11-15)
            ['sku' => 'MAC-011', 'name' => 'Retro Matte Lipstick', 'brand' => 'MAC', 'category' => 'Lips', 'description' => 'Classic matte lipstick', 'price' => 599.00, 'stock' => 50],
            ['sku' => 'MAC-012', 'name' => 'Strobe Cream', 'brand' => 'MAC', 'category' => 'Face', 'description' => 'Luminizing moisturizer', 'price' => 899.00, 'stock' => 40],
            ['sku' => 'MAC-013', 'name' => 'Technakohl Liner', 'brand' => 'MAC', 'category' => 'Eyes', 'description' => 'Gel eyeliner', 'price' => 499.00, 'stock' => 60],
            ['sku' => 'MAC-014', 'name' => 'Fix+ Primer', 'brand' => 'MAC', 'category' => 'Face', 'description' => 'Pore minimizing primer', 'price' => 799.00, 'stock' => 45],
            ['sku' => 'MAC-015', 'name' => 'Brow Set', 'brand' => 'MAC', 'category' => 'Eyes', 'description' => 'Clear brow gel', 'price' => 399.00, 'stock' => 70],

            // Additional L'Oréal Products (11-15)
            ['sku' => 'LOR-011', 'name' => 'Paradise Mascara', 'brand' => 'Loreal', 'category' => 'Eyes', 'description' => 'Voluminous mascara', 'price' => 299.00, 'stock' => 65],
            ['sku' => 'LOR-012', 'name' => 'True Match Lumi Cushion', 'brand' => 'Loreal', 'category' => 'Face', 'description' => 'Cushion foundation', 'price' => 599.00, 'stock' => 40],
            ['sku' => 'LOR-013', 'name' => 'Revitalift Laser Renew', 'brand' => 'Loreal', 'category' => 'Skin', 'description' => 'Anti-aging serum', 'price' => 999.00, 'stock' => 25],
            ['sku' => 'LOR-014', 'name' => 'Elvive Dream Lengths', 'brand' => 'Loreal', 'category' => 'Skin', 'description' => 'Hair treatment', 'price' => 499.00, 'stock' => 35],
            ['sku' => 'LOR-015', 'name' => 'Color Riche Matte Lipstick', 'brand' => 'Loreal', 'category' => 'Lips', 'description' => 'Matte lipstick', 'price' => 399.00, 'stock' => 55],

            // Additional Olay Products (11-15)
            ['sku' => 'OLAY-011', 'name' => 'Pore Minimizer Primer', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Pore minimizing primer', 'price' => 699.00, 'stock' => 40],
            ['sku' => 'OLAY-012', 'name' => 'Eyes Ultimate Eye Cream', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Eye cream', 'price' => 799.00, 'stock' => 30],
            ['sku' => 'OLAY-013', 'name' => 'Fresh Effects Cleanser', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Daily cleanser', 'price' => 399.00, 'stock' => 50],
            ['sku' => 'OLAY-014', 'name' => 'Body Butter', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Moisturizing body butter', 'price' => 599.00, 'stock' => 45],
            ['sku' => 'OLAY-015', 'name' => 'Age Defying Classic Face Moisturizer', 'brand' => 'Olay', 'category' => 'Skin', 'description' => 'Anti-aging moisturizer', 'price' => 899.00, 'stock' => 35],

            // Additional Sephora Products (11-15)
            ['sku' => 'SEP-011', 'name' => 'Baked Blush', 'brand' => 'Sephora', 'category' => 'Face', 'description' => 'Baked blush', 'price' => 699.00, 'stock' => 40],
            ['sku' => 'SEP-012', 'name' => 'Lip Balm', 'brand' => 'Sephora', 'category' => 'Lips', 'description' => 'Hydrating lip balm', 'price' => 299.00, 'stock' => 60],
            ['sku' => 'SEP-013', 'name' => 'Eye Primer', 'brand' => 'Sephora', 'category' => 'Eyes', 'description' => 'Long-lasting eye primer', 'price' => 499.00, 'stock' => 50],
            ['sku' => 'SEP-014', 'name' => 'Face Mask', 'brand' => 'Sephora', 'category' => 'Skin', 'description' => 'Hydrating face mask', 'price' => 599.00, 'stock' => 35],
            ['sku' => 'SEP-015', 'name' => 'Bronzer', 'brand' => 'Sephora', 'category' => 'Face', 'description' => 'Natural bronzer', 'price' => 799.00, 'stock' => 45],

            // Additional Maybelline Products (11-15)
            ['sku' => 'MAY-011', 'name' => 'Dream Bouncy Blush', 'brand' => 'Maybelline', 'category' => 'Face', 'description' => 'Bouncy blush', 'price' => 399.00, 'stock' => 50],
            ['sku' => 'MAY-012', 'name' => 'Tattoo Liner', 'brand' => 'Maybelline', 'category' => 'Eyes', 'description' => 'Waterproof eyeliner', 'price' => 349.00, 'stock' => 55],
            ['sku' => 'MAY-013', 'name' => 'Brow Drama Mascara', 'brand' => 'Maybelline', 'category' => 'Eyes', 'description' => 'Brow mascara', 'price' => 299.00, 'stock' => 60],
            ['sku' => 'MAY-014', 'name' => 'Instant Anti-Age Eraser', 'brand' => 'Maybelline', 'category' => 'Face', 'description' => 'Concealer', 'price' => 499.00, 'stock' => 45],
            ['sku' => 'MAY-015', 'name' => 'Color Sensational Creamy Matte Lipstick', 'brand' => 'Maybelline', 'category' => 'Lips', 'description' => 'Creamy matte lipstick', 'price' => 399.00, 'stock' => 50],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['sku' => $product['sku']],
                array_merge($product, ['image_url' => null, 'is_active' => true])
            );
        }
    }
}
