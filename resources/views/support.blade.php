<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - Share Idea's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        section {
            padding: 30px 0;
        }
        .support-section h2 {
            margin-bottom: 30px;
        }
        .contact-info ul, .social-links ul {
            list-style-type: none;
        }
        .contact-info li, .social-links li {
            margin: 10px 0;
        }
        .faq-item {
            margin-bottom: 20px;
        }
        .faq-item h5 {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container support-section">
    <h2 class="text-center">Support</h2>

    <!-- FAQ Section -->
    <section id="faq">
        <h3>Frequently Asked Questions</h3>
        <div class="faq-item">
            <h5>How do I submit an idea?</h5>
            <p>To submit an idea, simply log in to your account, click on the 'Submit Idea' button, and fill in the required details. Once submitted, your idea will be visible to other users for feedback.</p>
        </div>
        <div class="faq-item">
            <h5>How can I share multiple times idea's?</h5>
            <p>To share multiple time's idea's, go to your dashboard, login with your credentials again and share your idea's. Once submitted, your idea will be visible to other users next to your previous ideas for feedback.</p>
        </div>
        <div class="faq-item">
            <h5>How does the feedback and voting system work?</h5>
            <p>Users can give feedback on ideas by liking them or commenting on them. Likes increase the visibility of ideas, while comments allow users to provide more detailed feedback. Each idea can be liked by multiple users.</p>
        </div>
        <div class="faq-item">
            <h5>How do I report inappropriate content?</h5>
            <p>If you come across inappropriate content, reply to that content than our team will review the content and take appropriate action if necessary.</p>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact-us" class="contact-info">
        <h3>Contact Us</h3>
        <p>If you have any further questions or need assistance, don't hesitate to reach out to us. We are here to help!</p>
        <ul>
            <li><strong>Email:</strong> <a href="mailto:smca2221010@smsvaranasi.in">mca2221010@smsvaranasi.in</a></li>
            <li><strong>Phone:</strong>&nbsp;9810764235</li>
            {{-- <li><strong>Contact Form:</strong> <a href="contact-form.html">Fill out the contact form here</a></li> --}}
        </ul>
    </section>

    <!-- Troubleshooting Section -->
    <section id="troubleshooting">
        <h3>Troubleshooting</h3>
        <p>If you are encountering any issues with your account or submitting ideas, here are some common troubleshooting tips:</p>
        <ul>
            <li>If you are unable to log in, make sure you are using the correct credentials. If you've forgotten your password, contact to support team.</li>
            <li>If you can't submit an idea, ensure you are logged in to your account. If the problem persists, try clearing your browser cache or contacting us for assistance.</li>
            <li>For issues related to comments or likes, ensure that you are using a supported browser and try refreshing the page.</li>
        </ul>
    </section>

    <!-- Community Guidelines Section -->
    <section id="guidelines">
        <h3>Community Guidelines</h3>
        <p>We aim to provide a safe and constructive environment for sharing and discussing ideas. Please adhere to the following guidelines:</p>
        <ul>
            <li>Respect other users: Be polite, constructive, and respectful in your comments.</li>
            <li>Focus on ideas: Share ideas that are innovative, helpful, or thought-provoking.</li>
            <li>Keep it clean: Avoid offensive or inappropriate language and content.</li>
        </ul>
    </section>

    <!-- Social Media Links Section -->
    <section id="social-media" class="social-links">
        <h3>Follow Us</h3>
        <p>Stay updated on the latest news, features, and updates by following us on social media:</p>
        <ul>
            <li><a href="">Facebook</a></li>
            <li><a href="">Twitter</a></li>
            <li><a href="">Instagram</a></li>
        </ul>
    </section>

    <!-- Feedback Section -->
    <section id="feedback">
        <h3>Provide Feedback</h3>
        <p>Your feedback helps us improve the platform. You can give feedback to us on our dashbord.</p>
        {{-- <form action="submit-feedback.php" method="POST">
            <div class="mb-3">
                <label for="feedback-comments" class="form-label">Your Feedback:</label>
                <textarea id="feedback-comments" name="comments" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form> --}}
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
