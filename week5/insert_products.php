<?php
include "db.php";

$sql = "
INSERT INTO products (name, price, category, image) VALUES

('Birkin Style Luxury Bag', 8500, 'luxury', 'birkin.jpg'),
('Premium Structured Handbag', 6200, 'luxury', 'structured.jpg'),
('Elegant Leather Tote Bag', 5000, 'luxury', 'elegant.jpg'),

('Coach Inspired Tabby Bag', 3200, 'coach', 'coach_tabby.jpg'),
('Coach teri Bag', 2800, 'coach', 'coach_teri.jpg'),
('Coach Everyday Tote', 3500, 'coach', 'coach_tote.jpg'),

('Cute Fashion Handbag', 1500, 'affordable', cute_bag.jpg'),
('Mini Stylish Crossbody', 1200, 'affordable', 'crossbody.jpg'),
('Trendy Party Bag', 1800, 'affordable', 'party_bag.jpg'),

('School Backpack Black', 2000, 'school', 'school_black.jpg'),
('Pink School Backpack', 2200, 'school', 'school_pink.jpg'),
('Laptop School Bag', 2500, 'school', 'school_laptop.jpg')
";

if ($conn->query($sql)) {
    echo "Products inserted successfully 💖👜";
} else {
    echo "Error: " . $conn->error;
}
?>