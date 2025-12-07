-- Sample Products for Vanity System
USE vanity_db;

INSERT INTO products (sku, name, brand, description, price, stock, is_active, created_at, updated_at) VALUES
('SEP-001', 'Sephora Collection Matte Lipstick', 'Sephora', 'Long-lasting matte lipstick with rich color payoff', 599.00, 50, 1, NOW(), NOW()),
('SEP-002', 'Sephora Pro Eyeshadow Palette', 'Sephora', 'Professional 12-color eyeshadow palette', 1299.00, 30, 1, NOW(), NOW()),
('MAC-001', 'MAC Hydra Lipstick', 'MAC', 'Moisturizing lipstick with hydrating formula', 599.00, 45, 1, NOW(), NOW()),
('MAC-002', 'MAC Studio Fix Foundation', 'MAC', 'Full coverage foundation for all skin types', 1299.00, 25, 1, NOW(), NOW()),
('MAY-001', 'Maybelline Superstay Foundation', 'Maybelline', '24-hour wear foundation', 499.00, 60, 1, NOW(), NOW()),
('MAY-002', 'Maybelline Volum Express Mascara', 'Maybelline', 'Volume-boosting mascara', 299.00, 80, 1, NOW(), NOW()),
('OLAY-001', 'Olay Glow Serum', 'Olay', 'Brightening serum for radiant skin', 899.00, 40, 1, NOW(), NOW()),
('OLAY-002', 'Olay Regenerist Moisturizer', 'Olay', 'Anti-aging daily moisturizer', 799.00, 35, 1, NOW(), NOW()),
('LOR-001', 'L\'Oréal Radiance Foundation', 'L\'Oréal', 'Luminous foundation for glowing skin', 749.00, 55, 1, NOW(), NOW()),
('LOR-002', 'L\'Oréal True Match Concealer', 'L\'Oréal', 'Precise coverage concealer', 399.00, 70, 1, NOW(), NOW());


