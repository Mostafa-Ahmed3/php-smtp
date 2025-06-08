<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact Us – Dress Alterations</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
  <div id="header-placeholder"></div>

  <main>
    <section class="contact-form">
      <h1 class="page-title">Contact Us</h1>

      <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p style="color: green;">Thank you! Your message has been sent.</p>
      <?php elseif (isset($_GET['error'])): ?>
        <p style="color: red;">Oops! Something went wrong. Please try again.</p>
      <?php endif; ?>

      <form action="send.php" method="POST">
        <label for="first-name">First Name *</label>
        <input id="first-name" name="first_name" required />

        <label for="last-name">Last Name</label>
        <input id="last-name" name="last_name" />

        <label for="email">Email *</label>
        <input id="email" type="email" name="email" required />

        <label for="message">Message *</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Submit</button>
      </form>
    </section>

    <section class="location">
      <h2>Our Location</h2>
      <div class="map-container">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d400354.7193095415!2d-121.44485290000001!3d38.377413049999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31ac9d49d51ab5f%3A0x9bcb03f452ca28d9!2sDress%20Alterations!5e0!3m2!1sen!2seg!4v1749090542610!5m2!1sen!2seg"
          width="100%" height="400" style="border:0;" allowfullscreen loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </section>
  </main>

  <div id="footer-placeholder"></div>

  <script>
    fetch("header.html")
      .then(r => r.text())
      .then(html => {
        document.getElementById("header-placeholder").innerHTML = html;
        const page = "contact";
        document.querySelector(`nav a[data-page="${page}"]`)?.classList.add("active");
      });

    fetch("footer.html")
      .then(r => r.text())
      .then(html => {
        document.getElementById("footer-placeholder").innerHTML = html;
      });
  </script>
</body>
</html>