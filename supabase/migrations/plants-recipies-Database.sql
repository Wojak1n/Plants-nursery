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
('Mint', 'Mentha', 'Mint is a genus of plants in the family Lamiaceae. The exact distinction between species is unclear; it is estimated that 13 to 24 species exist. Hybridization occurs naturally where some species range overlap.', NULL),
('Basil', 'Ocimum basilicum', 'Basil is a culinary herb of the family Lamiaceae. It is also called great basil or Saint-Joseph''s-wort. Basil is native to tropical regions from central Africa to Southeast Asia.', NULL),
('Rosemary', 'Salvia rosmarinus', 'Rosemary is a woody, perennial herb with fragrant, evergreen, needle-like leaves and white, pink, purple, or blue flowers, native to the Mediterranean region.', NULL);

-- Insert sample recipes
INSERT INTO recipes (plant_id, title, ingredients, instructions, image) VALUES
(1, 'Aloe Vera Smoothie', '1 cup aloe vera gel\n1 banana\n1 cup spinach\n1 cup almond milk\n1 tablespoon honey\nIce cubes', '1. Wash the aloe vera leaf and carefully remove the gel.\n2. Add aloe vera gel, banana, spinach, almond milk, and honey to a blender.\n3. Blend until smooth.\n4. Add ice cubes and blend again.\n5. Serve immediately.', NULL),
(2, 'Lavender Lemonade', '1/4 cup dried lavender flowers\n1 cup sugar\n5 cups water\n1 1/2 cups freshly squeezed lemon juice\nLemon slices for garnish', '1. Bring 2 cups of water to a boil in a medium saucepan.\n2. Remove from heat and add lavender flowers. Cover and steep for 20 minutes.\n3. Strain the mixture through a fine-mesh sieve into a large pitcher.\n4. Add sugar and stir until dissolved.\n5. Add lemon juice and remaining water. Stir well.\n6. Refrigerate until chilled.\n7. Serve over ice with lemon slices.', NULL),
(3, 'Mint Chocolate Chip Smoothie', '1 cup fresh mint leaves\n1 frozen banana\n1 cup almond milk\n1 tablespoon cocoa powder\n1 tablespoon honey\n2 tablespoons mini chocolate chips\nIce cubes', '1. Add mint leaves, frozen banana, almond milk, cocoa powder, and honey to a blender.\n2. Blend until smooth.\n3. Add ice cubes and blend again.\n4. Stir in chocolate chips.\n5. Pour into a glass and enjoy!', NULL),
(4, 'Basil Pesto Pasta', '2 cups fresh basil leaves\n1/3 cup pine nuts\n2 garlic cloves\n1/2 cup extra-virgin olive oil\n1/2 cup grated Parmesan cheese\nSalt and pepper to taste\n8 oz pasta of your choice', '1. In a food processor, combine basil, pine nuts, and garlic. Pulse until coarsely chopped.\n2. With the processor running, slowly add olive oil in a steady stream.\n3. Add Parmesan cheese, salt, and pepper. Pulse until combined.\n4. Cook pasta according to package instructions. Drain, reserving 1/4 cup of pasta water.\n5. Toss pasta with pesto and add reserved pasta water as needed to loosen the sauce.\n6. Serve with additional Parmesan cheese if desired.', NULL),
(5, 'Rosemary Roasted Potatoes', '2 pounds small red potatoes, quartered\n3 tablespoons olive oil\n2 tablespoons fresh rosemary, chopped\n3 cloves garlic, minced\nSalt and pepper to taste', '1. Preheat oven to 425°F (220°C).\n2. In a large bowl, toss potatoes with olive oil, rosemary, garlic, salt, and pepper.\n3. Spread potatoes in a single layer on a baking sheet.\n4. Roast for 25-30 minutes, turning occasionally, until potatoes are golden brown and crisp.\n5. Serve hot.', NULL);