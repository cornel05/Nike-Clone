-- Nike Clone Seed Data
-- Sample data for development and testing

USE nike_clone;

-- Insert categories
INSERT INTO categories (name, slug, description, image_url) VALUES
('Men\'s Shoes', 'mens-shoes', 'Athletic and lifestyle shoes for men', '/assets/images/categories/mens-shoes.jpg'),
('Women\'s Shoes', 'womens-shoes', 'Athletic and lifestyle shoes for women', '/assets/images/categories/womens-shoes.jpg'),
('Kids\' Shoes', 'kids-shoes', 'Athletic and lifestyle shoes for kids', '/assets/images/categories/kids-shoes.jpg'),
('Men\'s Clothing', 'mens-clothing', 'Athletic and lifestyle clothing for men', '/assets/images/categories/mens-clothing.jpg'),
('Women\'s Clothing', 'womens-clothing', 'Athletic and lifestyle clothing for women', '/assets/images/categories/womens-clothing.jpg'),
('Basketball', 'basketball', 'Basketball shoes and gear', '/assets/images/categories/basketball.jpg'),
('Running', 'running', 'Running shoes and gear', '/assets/images/categories/running.jpg'),
('Lifestyle', 'lifestyle', 'Casual lifestyle products', '/assets/images/categories/lifestyle.jpg');

-- Insert sizes
INSERT INTO sizes (name, sort_order) VALUES
('3.5', 1), ('4', 2), ('4.5', 3), ('5', 4), ('5.5', 5), ('6', 6), ('6.5', 7), ('7', 8), ('7.5', 9), ('8', 10),
('8.5', 11), ('9', 12), ('9.5', 13), ('10', 14), ('10.5', 15), ('11', 16), ('11.5', 17), ('12', 18), ('12.5', 19), ('13', 20),
('13.5', 21), ('14', 22), ('15', 23), ('16', 24), ('17', 25), ('18', 26);

-- Insert sample products
INSERT INTO products (name, slug, description, price, image_url, category_id, featured, status) VALUES
('Air Jordan 1 Retro High OG', 'air-jordan-1-retro-high-og', 'The Air Jordan 1 Retro High OG remakes the classic with premium materials and iconic design details.', 170.00, '/assets/images/products/aj1-retro-high.jpg', 6, 1, 'active'),
('Nike Air Force 1 \'07', 'nike-air-force-1-07', 'The radiance lives on in the Nike Air Force 1 \'07, the basketball original that puts a fresh spin on what you know best.', 90.00, '/assets/images/products/af1-07.jpg', 1, 1, 'active'),
('Nike Dunk Low', 'nike-dunk-low', 'Created for the hardwood but taken to the streets, the basketball icon returns with perfectly aged details.', 100.00, '/assets/images/products/dunk-low.jpg', 1, 1, 'active'),
('Nike Air Max 90', 'nike-air-max-90', 'Nothing as fly, nothing as comfortable, nothing as proven. The Nike Air Max 90 stays true to its OG running roots.', 120.00, '/assets/images/products/air-max-90.jpg', 7, 1, 'active'),
('Nike React Infinity Run Flyknit 3', 'nike-react-infinity-run-flyknit-3', 'A comfortable ride that\'s designed to help keep you running. More foam, better traction and durable design.', 160.00, '/assets/images/products/react-infinity.jpg', 7, 0, 'active'),
('Nike Blazer Mid \'77 Vintage', 'nike-blazer-mid-77-vintage', 'In the \'70s, Nike was the new shoe on the block. So new in fact, we were still a running company.', 100.00, '/assets/images/products/blazer-mid.jpg', 8, 1, 'active'),
('Nike Air Max 270', 'nike-air-max-270', 'Nike\'s first lifestyle Air Max brings you style, comfort and big attitude in the Nike Air Max 270.', 150.00, '/assets/images/products/air-max-270.jpg', 2, 1, 'active'),
('Nike Air Max 97', 'nike-air-max-97', 'Featuring the original ripple design inspired by Japanese bullet trains, the Nike Air Max 97 lets you push your style full-speed ahead.', 170.00, '/assets/images/products/air-max-97.jpg', 2, 0, 'active'),
('Nike Cortez', 'nike-cortez', 'The Nike Cortez was Bill Bowerman\'s first masterpiece. This is the shoe that put Nike on the map.', 70.00, '/assets/images/products/cortez.jpg', 8, 0, 'active'),
('Nike SB Dunk Low', 'nike-sb-dunk-low', 'The Nike SB Dunk Low Pro has been redesigned specifically for skateboarding.', 95.00, '/assets/images/products/sb-dunk-low.jpg', 1, 0, 'active');

-- Insert product images
INSERT INTO product_images (product_id, image_url, alt_text, sort_order) VALUES
(1, '/assets/images/products/aj1-retro-high-1.jpg', 'Air Jordan 1 Retro High OG - Main', 1),
(1, '/assets/images/products/aj1-retro-high-2.jpg', 'Air Jordan 1 Retro High OG - Side', 2),
(1, '/assets/images/products/aj1-retro-high-3.jpg', 'Air Jordan 1 Retro High OG - Back', 3),
(2, '/assets/images/products/af1-07-1.jpg', 'Nike Air Force 1 07 - Main', 1),
(2, '/assets/images/products/af1-07-2.jpg', 'Nike Air Force 1 07 - Side', 2),
(3, '/assets/images/products/dunk-low-1.jpg', 'Nike Dunk Low - Main', 1),
(3, '/assets/images/products/dunk-low-2.jpg', 'Nike Dunk Low - Side', 2),
(4, '/assets/images/products/air-max-90-1.jpg', 'Nike Air Max 90 - Main', 1),
(4, '/assets/images/products/air-max-90-2.jpg', 'Nike Air Max 90 - Side', 2);

-- Insert product sizes (sample inventory)
INSERT INTO product_sizes (product_id, size_id, stock) VALUES
-- Air Jordan 1 sizes
(1, 8, 5), (1, 9, 3), (1, 10, 7), (1, 11, 2), (1, 12, 4),
-- Air Force 1 sizes
(2, 7, 10), (2, 8, 8), (2, 9, 12), (2, 10, 15), (2, 11, 6), (2, 12, 3),
-- Dunk Low sizes
(3, 8, 8), (3, 9, 5), (3, 10, 10), (3, 11, 7), (3, 12, 2),
-- Air Max 90 sizes
(4, 7, 6), (4, 8, 9), (4, 9, 11), (4, 10, 8), (4, 11, 4);

-- Insert sample users
INSERT INTO users (name, email, password, phone) VALUES
('John Doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1-555-123-4567'), -- password
('Jane Smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1-555-987-6543'), -- password
('Mike Johnson', 'mike@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1-555-456-7890'); -- password

-- Insert sample stores
INSERT INTO stores (name, address, city, state, country, postal_code, phone, email, latitude, longitude, hours) VALUES
('Nike Times Square', '1535 Broadway', 'New York', 'NY', 'USA', '10036', '+1-212-541-6453', 'timessquare@nike.com', 40.7580, -73.9855, 'Mon-Sat: 10AM-10PM, Sun: 11AM-8PM'),
('Nike Chicago', '669 N Michigan Ave', 'Chicago', 'IL', 'USA', '60611', '+1-312-642-6363', 'chicago@nike.com', 41.8947, -87.6244, 'Mon-Sat: 10AM-9PM, Sun: 11AM-7PM'),
('Nike Los Angeles', '8500 Beverly Blvd', 'Los Angeles', 'CA', 'USA', '90048', '+1-323-966-5453', 'losangeles@nike.com', 34.0759, -118.3775, 'Mon-Sat: 10AM-9PM, Sun: 11AM-7PM'),
('Nike Miami', '1035 Lincoln Rd', 'Miami Beach', 'FL', 'USA', '33139', '+1-305-532-4171', 'miami@nike.com', 25.7907, -80.1378, 'Mon-Thu: 10AM-10PM, Fri-Sat: 10AM-11PM, Sun: 11AM-9PM'),
('Nike San Francisco', '278 Post St', 'San Francisco', 'CA', 'USA', '94108', '+1-415-392-4453', 'sanfrancisco@nike.com', 37.7879, -122.4075, 'Mon-Sat: 10AM-9PM, Sun: 11AM-7PM');

-- Insert store availability
INSERT INTO store_availability (store_id, product_id, stock) VALUES
-- Times Square
(1, 1, 25), (1, 2, 40), (1, 3, 30), (1, 4, 35), (1, 5, 20),
-- Chicago
(2, 1, 15), (2, 2, 35), (2, 3, 25), (2, 4, 30), (2, 6, 22),
-- Los Angeles
(3, 1, 30), (3, 2, 45), (3, 3, 35), (3, 7, 28), (3, 8, 18),
-- Miami
(4, 2, 25), (4, 3, 20), (4, 6, 30), (4, 7, 35), (4, 9, 15),
-- San Francisco
(5, 1, 20), (5, 4, 25), (5, 5, 30), (5, 8, 20), (5, 10, 12);

-- Insert sample launches
INSERT INTO launches (title, description, product_id, launch_date, launch_type, price, status) VALUES
('Air Jordan 1 "Chicago" Restock', 'The iconic Chicago colorway returns with premium leather and classic construction.', 1, DATE_ADD(NOW(), INTERVAL 7 DAY), 'fcfs', 170.00, 'upcoming'),
('Nike Dunk Low "Panda" Drop', 'Clean black and white colorway that goes with everything.', 3, DATE_ADD(NOW(), INTERVAL 3 DAY), 'draw', 100.00, 'upcoming'),
('Air Max 90 "Infrared" Launch', 'The OG colorway that started it all, celebrating 30+ years of Air Max.', 4, DATE_ADD(NOW(), INTERVAL 14 DAY), 'leo', 120.00, 'upcoming'),
('Nike Air Force 1 "Triple White"', 'Classic all-white colorway, perfect for any occasion.', 2, DATE_SUB(NOW(), INTERVAL 2 DAY), 'fcfs', 90.00, 'closed'),
('Blazer Mid "Vintage Navy"', 'Retro basketball style with modern comfort.', 6, DATE_SUB(NOW(), INTERVAL 7 DAY), 'draw', 100.00, 'closed');

-- Insert sample launch notifications
INSERT INTO launch_notifications (launch_id, user_id, notified) VALUES
(1, 1, 0), (1, 2, 0), (2, 1, 0), (2, 3, 0), (3, 2, 0);

-- Insert sample launch entries
INSERT INTO launch_entries (launch_id, user_id, size_id, status) VALUES
(4, 1, 10, 'not_selected'), (4, 2, 9, 'selected'), (4, 3, 11, 'not_selected'),
(5, 1, 10, 'selected'), (5, 2, 10, 'not_selected');