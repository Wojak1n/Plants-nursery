<?php
require_once 'includes/functions.php';

$message = '';
$messageType = '';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? sanitizeInput($_POST['subject']) : '';
    $messageContent = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';
    
    // Validate inputs
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    if (empty($subject)) {
        $errors[] = 'Subject is required';
    }
    
    if (empty($messageContent)) {
        $errors[] = 'Message is required';
    }
    
    // If no errors, process the form (this is just a demo)
    if (empty($errors)) {
        // In a real application, you would send an email here
        // For this demo, we'll just show a success message
        $message = 'Thank you for your message! We will get back to you soon.';
        $messageType = 'success';
        
        // Reset form fields
        $name = $email = $subject = $messageContent = '';
    } else {
        $message = 'Please correct the following errors:<br>' . implode('<br>', $errors);
        $messageType = 'error';
    }
}

// Include header
include 'includes/header.php';
?>

<section class="bg-primary-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-serif font-bold text-gray-900 mb-4">Contact Us</h1>
        <p class="text-lg text-gray-600 max-w-3xl">Have questions about our plants or recipes? Need advice on plant care? We're here to help! Fill out the form below and we'll get back to you as soon as possible.</p>
    </div>
</section>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-16">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Send Us a Message</h2>
                
                <?php if (!empty($message)): ?>
                    <div class="mb-8 p-4 rounded-md <?= $messageType === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' ?>">
                        <?= $message ?>
                    </div>
                <?php endif; ?>
                
                <form action="contact.php" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
                        <input type="text" name="name" id="name" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                               required>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                               required>
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" name="subject" id="subject" value="<?= isset($subject) ? htmlspecialchars($subject) : '' ?>"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                               required>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
                        <textarea name="message" id="message" rows="6" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 custom-focus"
                                  required><?= isset($messageContent) ? htmlspecialchars($messageContent) : '' ?></textarea>
                    </div>
                    
                    <div>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="mt-12 lg:mt-0">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Visit Our Nursery</h2>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                    <img src="https://images.pexels.com/photos/632722/pexels-photo-632722.jpeg" alt="Green Haven Nursery" class="w-full h-64 object-cover">
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Green Haven Nursery</h3>
                        
                        <div class="space-y-4 text-gray-600">
                            <p>
                                <span class="font-medium">Address:</span><br>
                                123 Garden Road<br>
                                Plantsville, PN 12345
                            </p>
                            
                            <p>
                                <span class="font-medium">Phone:</span><br>
                                (555) 123-4567
                            </p>
                            
                            <p>
                                <span class="font-medium">Email:</span><br>
                                info@greenhaven.com
                            </p>
                            
                            <p>
                                <span class="font-medium">Hours:</span><br>
                                Monday - Friday: 9AM - 6PM<br>
                                Saturday: 9AM - 5PM<br>
                                Sunday: 10AM - 4PM
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-primary-50 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-gray-900">Do you offer plant delivery?</h4>
                            <p class="text-gray-600">Yes, we offer local delivery for orders over $50 within a 20-mile radius of our nursery.</p>
                        </div>
                        
                        <div>
                            <h4 class="font-medium text-gray-900">Can I return plants if they don't thrive?</h4>
                            <p class="text-gray-600">We offer a 30-day guarantee on most plants. Bring your receipt and we'll help you find a suitable replacement.</p>
                        </div>
                        
                        <div>
                            <h4 class="font-medium text-gray-900">Do you offer gardening workshops?</h4>
                            <p class="text-gray-600">Yes! We host monthly workshops on various gardening topics. Check our events page for the schedule.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>