-- Plants Nursery Database Setup
-- Complete database schema for deployment

-- Create database (uncomment if needed)
-- CREATE DATABASE IF NOT EXISTS plants_nursery;
-- USE plants_nursery;

-- Create users table for login system
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create plants table
CREATE TABLE IF NOT EXISTS plants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    scientific_name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL
);

-- Create recipes table
CREATE TABLE IF NOT EXISTS recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plant_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (plant_id) REFERENCES plants(id)
);

-- Insert sample plants
INSERT INTO plants (name, scientific_name, description, image) VALUES
('Aloe Vera', 'Aloe barbadensis miller', 'Aloe vera is a succulent plant species of the genus Aloe. It grows wild in tropical, semi-tropical, and arid climates around the world. It is cultivated for agricultural and medicinal uses.', NULL),
('Lavender', 'Lavandula', 'Lavender is a genus of 47 known species of flowering plants in the mint family, Lamiaceae. It is native to the Old World and is found in Cape Verde and the Canary Islands, and from Europe across to northern and eastern Africa, the Mediterranean, southwest Asia to India.', NULL),
('Mint', 'Mentha', 'Mint is a genus of plants in the family Lamiaceae. It is estimated that 13 to 24 species exist, but the exact distinction between species is unclear due to natural hybridization.', NULL),
('Basil', 'Ocimum basilicum', 'Basil, also called great basil, is a culinary herb of the family Lamiaceae. Basil is native to tropical regions from central Africa to Southeast Asia.', NULL),
('Rosemary', 'Rosmarinus officinalis', 'Rosemary is a woody, perennial herb with fragrant, evergreen, needle-like leaves and white, pink, purple, or blue flowers, native to the Mediterranean region.', NULL);

-- Insert sample recipes
INSERT INTO recipes (plant_id, title, ingredients, instructions, image) VALUES
(1, 'Aloe Vera Smoothie', '1 cup aloe vera gel\n1 banana\n1 cup spinach\n1 cup almond milk\n1 tablespoon honey\nIce cubes', '1. Wash the aloe vera leaf and carefully remove the gel.\n2. Add aloe vera gel, banana, spinach, almond milk, and honey to a blender.\n3. Blend until smooth.\n4. Add ice cubes and blend again.\n5. Serve immediately.', NULL),
(2, 'Lavender Lemonade', '1/4 cup dried lavender flowers\n1 cup sugar\n5 cups water\n1 1/2 cups freshly squeezed lemon juice\nLemon slices for garnish', '1. Bring 2 cups of water to a boil in a medium saucepan.\n2. Remove from heat and add lavender flowers. Cover and steep for 20 minutes.\n3. Strain the mixture through a fine-mesh sieve into a large pitcher.\n4. Add sugar and stir until dissolved.\n5. Add lemon juice and remaining water. Stir well.\n6. Refrigerate until chilled.\n7. Serve over ice with lemon slices.', NULL),
(3, 'Fresh Mint Tea', '2 tablespoons fresh mint leaves\n2 cups boiling water\n1 tablespoon honey (optional)\nLemon slices for garnish', '1. Place mint leaves in a teapot or heat-resistant pitcher.\n2. Pour boiling water over the mint leaves.\n3. Let steep for 5-7 minutes.\n4. Strain the tea into cups.\n5. Add honey if desired and garnish with lemon slices.\n6. Serve hot or let cool and serve over ice.', NULL),
(4, 'Basil Pesto Pasta', '2 cups fresh basil leaves\n3 cloves garlic\n1/4 cup pine nuts\n2/3 cup olive oil\n1/2 cup grated Parmesan cheese\n1 pound pasta\nSalt and pepper to taste', '1. Cook pasta according to package directions.\n2. In a food processor, combine basil, garlic, and pine nuts. Pulse until chopped.\n3. With processor running, slowly add olive oil until smooth.\n4. Add Parmesan cheese and pulse to combine.\n5. Season with salt and pepper.\n6. Toss with cooked pasta and serve immediately.', NULL),
(5, 'Rosemary Roasted Potatoes', '2 pounds small red potatoes, quartered\n3 tablespoons olive oil\n2 tablespoons fresh rosemary, chopped\n3 cloves garlic, minced\nSalt and pepper to taste', '1. Preheat oven to 425°F (220°C).\n2. In a large bowl, toss potatoes with olive oil, rosemary, garlic, salt, and pepper.\n3. Spread potatoes in a single layer on a baking sheet.\n4. Roast for 25-30 minutes, turning occasionally, until potatoes are golden brown and crisp.\n5. Serve hot.', NULL);

-- Create a test user for the login system
-- Password is 'password123' (hashed)
INSERT INTO users (name, email, password) VALUES 
('Test User', 'test@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Create admin table for admin login (if needed)
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (username: admin, password: admin)
INSERT INTO admin_users (username, password) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
