-- Update product image URLs to use placeholder images
-- Run this after importing the seed data to use placeholder images

USE nike_clone;

-- Update product images with placeholder URLs
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=Air+Jordan+1' WHERE id = 1;
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=Air+Force+1' WHERE id = 2;
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=Dunk+Low' WHERE id = 3;
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=Air+Max+90' WHERE id = 4;
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=React+Infinity' WHERE id = 5;
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=Blazer+Mid' WHERE id = 6;
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=Air+Max+270' WHERE id = 7;
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=Air+Max+97' WHERE id = 8;
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=Cortez' WHERE id = 9;
UPDATE products SET image_url = 'https://via.placeholder.com/400x400/111111/FFFFFF?text=SB+Dunk' WHERE id = 10;

-- Update product_images with placeholder URLs
UPDATE product_images SET image_url = 'https://via.placeholder.com/500x500/111111/FFFFFF?text=Air+Jordan+1+View+1' WHERE product_id = 1 AND sort_order = 1;
UPDATE product_images SET image_url = 'https://via.placeholder.com/500x500/111111/FFFFFF?text=Air+Jordan+1+View+2' WHERE product_id = 1 AND sort_order = 2;
UPDATE product_images SET image_url = 'https://via.placeholder.com/500x500/111111/FFFFFF?text=Air+Jordan+1+View+3' WHERE product_id = 1 AND sort_order = 3;

UPDATE product_images SET image_url = 'https://via.placeholder.com/500x500/111111/FFFFFF?text=Air+Force+1+View+1' WHERE product_id = 2 AND sort_order = 1;
UPDATE product_images SET image_url = 'https://via.placeholder.com/500x500/111111/FFFFFF?text=Air+Force+1+View+2' WHERE product_id = 2 AND sort_order = 2;

UPDATE product_images SET image_url = 'https://via.placeholder.com/500x500/111111/FFFFFF?text=Dunk+Low+View+1' WHERE product_id = 3 AND sort_order = 1;
UPDATE product_images SET image_url = 'https://via.placeholder.com/500x500/111111/FFFFFF?text=Dunk+Low+View+2' WHERE product_id = 3 AND sort_order = 2;

UPDATE product_images SET image_url = 'https://via.placeholder.com/500x500/111111/FFFFFF?text=Air+Max+90+View+1' WHERE product_id = 4 AND sort_order = 1;
UPDATE product_images SET image_url = 'https://via.placeholder.com/500x500/111111/FFFFFF?text=Air+Max+90+View+2' WHERE product_id = 4 AND sort_order = 2;

-- Update category images
UPDATE categories SET image_url = 'https://via.placeholder.com/600x400/333333/FFFFFF?text=Mens+Shoes' WHERE slug = 'mens-shoes';
UPDATE categories SET image_url = 'https://via.placeholder.com/600x400/333333/FFFFFF?text=Womens+Shoes' WHERE slug = 'womens-shoes';
UPDATE categories SET image_url = 'https://via.placeholder.com/600x400/333333/FFFFFF?text=Kids+Shoes' WHERE slug = 'kids-shoes';
UPDATE categories SET image_url = 'https://via.placeholder.com/600x400/333333/FFFFFF?text=Mens+Clothing' WHERE slug = 'mens-clothing';
UPDATE categories SET image_url = 'https://via.placeholder.com/600x400/333333/FFFFFF?text=Womens+Clothing' WHERE slug = 'womens-clothing';
UPDATE categories SET image_url = 'https://via.placeholder.com/600x400/333333/FFFFFF?text=Basketball' WHERE slug = 'basketball';
UPDATE categories SET image_url = 'https://via.placeholder.com/600x400/333333/FFFFFF?text=Running' WHERE slug = 'running';
UPDATE categories SET image_url = 'https://via.placeholder.com/600x400/333333/FFFFFF?text=Lifestyle' WHERE slug = 'lifestyle';