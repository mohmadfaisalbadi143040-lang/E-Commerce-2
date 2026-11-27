<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact — Nova Store</title>
    <meta name="description" content="Get in touch with Faisal Badi — Full Stack Web Developer. Available for website design, e-commerce, portfolio and full stack projects.">
    <link rel="stylesheet" href="Assets/css/style.css">
    <?php include 'header.php'; ?>
</head>

<body>

    <section id="page-header" class="contact-header">
        <h2>#Contact Us</h2>
    </section>

    <section id="contact">

        <div class="contact-info">

            <span>GET IN TOUCH</span>

            <h2>Let's Build Something Amazing Together</h2>

            <p>
                I am a Full Stack Web Developer passionate about creating modern,
                responsive and high-performance websites. If you're looking for a
                developer for your next project, feel free to contact me.
            </p>

            <div class="info-box">
                <i class="fa-solid fa-user"></i>
                <div>
                    <h4>Name</h4>
                    <p>Faisal Badi</p>
                </div>
            </div>

            <div class="info-box">
                <i class="fa-solid fa-location-dot"></i>
                <div>
                    <h4>Location</h4>
                    <p>Wankaner, Gujarat, India</p>
                </div>
            </div>

            <!-- <div class="info-box">
                <i class="fa-solid fa-phone"></i>
                <div>
                    <h4>Phone</h4>
                    <p>+91 1234567890</p>
                </div>
            </div> -->

            <div class="info-box">
                <i class="fa-solid fa-envelope"></i>
                <div>
                    <h4>Email</h4>
                    <p>badifaisal757@gmail.com</p>
                </div>
            </div>

            <div class="info-box">
                <i class="fa-solid fa-code"></i>
                <div>
                    <h4>Services</h4>
                    <p>Website Design, E-Commerce, Portfolio, Landing Page, Full Stack Development</p>
                </div>
            </div>

        </div>

        <div class="contact-form">
            <?php
            $success = '';
            $error   = '';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name    = htmlspecialchars(trim($_POST['name']    ?? ''));
                $email   = htmlspecialchars(trim($_POST['email']   ?? ''));
                $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
                $message = htmlspecialchars(trim($_POST['message'] ?? ''));

                if ($name && $email && $subject && $message) {
                    // Email sending would go here (mail() or PHPMailer)
                    $success = 'Thank you, ' . $name . '! Your message has been received. I\'ll get back to you soon.';
                } else {
                    $error = 'Please fill in all fields.';
                }
            }
            ?>

            <form action="contact.php" method="POST">

                <h2>Send Message</h2>

                <?php if ($success): ?>
                    <div style="background:#e8f5e9;color:#2e7d32;padding:14px 18px;border-radius:8px;margin-bottom:20px;font-weight:600;border:1px solid #a5d6a7;">
                        <i class="fas fa-check-circle"></i> <?= $success ?>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div style="background:#ffebee;color:#c62828;padding:14px 18px;border-radius:8px;margin-bottom:20px;font-weight:600;border:1px solid #ef9a9a;">
                        <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                    </div>
                <?php endif; ?>

                <input type="text"  name="name"    placeholder="Your Name"    required value="<?= htmlspecialchars($_POST['name']    ?? '') ?>">
                <input type="email" name="email"   placeholder="Your Email"   required value="<?= htmlspecialchars($_POST['email']   ?? '') ?>">
                <input type="text"  name="subject" placeholder="Subject"      required value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
                <textarea name="message" rows="6" placeholder="Tell me about your project..." required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>

                <button type="submit">
                    <i class="fas fa-paper-plane" style="margin-right:8px;"></i>Send Message
                </button>

            </form>
        </div>

    </section>

    <?php include 'footer.php'; ?>

</body>
</html>