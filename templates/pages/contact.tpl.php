<script type="text/javascript">

function validateContactForm() {
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();
    var message = document.getElementById("message").value.trim();
    var errorMessages = [];

    
    if (name === "") {
        errorMessages.push("- Name field cannot be empty.");
    } else if (name.length < 5) {
        errorMessages.push("- Name must be at least 5 characters.");
    }

    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (email === "") {
        errorMessages.push("- Email field cannot be empty.");
    } else if (!emailPattern.test(email)) {
        errorMessages.push("- Please enter a valid email address.");
    }

    if (message === "") {
        errorMessages.push("- Message field cannot be empty.");
    }

    
    if (errorMessages.length > 0) {
        alert("Please fix the following errors before submitting:\n\n" + errorMessages.join("\n"));
        return false;
    }
    
    return true;
}
</script>

<article class="pizza-card">

    <?php if ($sent_successfully): ?>
        
        <div class="text-center py-5">
            <h2 class="text-success mb-4">Message Sent Successfully!</h2>
            <p class="lead text-muted mb-4">Thank you for reaching out to Net Pizzeria. Here is a copy of what you sent us:</p>
            
            <div class="card shadow-sm mx-auto text-start" style="max-width: 500px;">
                <div class="card-body bg-light rounded">
                    <p class="mb-2"><strong>Sender Name:</strong> <?= htmlspecialchars($_POST['name'] ?? '') ?></p>
                    <p class="mb-2"><strong>Sender Email:</strong> <?= htmlspecialchars($_POST['email'] ?? '') ?></p>
                    <hr>
                    <p class="mb-0"><strong>Message:</strong></p>
                    <p class="mt-2 text-dark p-3 bg-white border rounded"><?= nl2br(htmlspecialchars($_POST['message'] ?? '')) ?></p>
                </div>
            </div>
            
            <a href="contact" class="btn btn-danger mt-4 fw-bold">Return to Contact Page</a>
        </div>

    <?php else: ?>
        
        <header class="mb-4 text-center border-bottom pb-3">
            <h2 class="section-title fs-2">Contact Net Pizzeria</h2>
            <p class="text-muted">Manager: <strong>Aws and Ditso</strong> | Email: <a href="mailto:somebody@simplewebsite.com" class="text-danger text-decoration-none">somebody@simplewebsite.com</a></p>
        </header>

        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger shadow-sm">
                <h5 class="alert-heading">Server Validation Failed:</h5>
                <ul class="mb-0 mt-2">
                    <?php foreach($errors as $err) echo "<li>$err</li>"; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <form name="contactForm" action="contact" method="post" onsubmit="return validateContactForm()">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Name (minimum 5 characters):</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" value="<?= htmlspecialchars($_POST['name'] ?? $default_name) ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">E-mail (required):</label>
                        
                        <input type="text" id="email" name="email" class="form-control" placeholder="your.email@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>
                    
                    <div class="mb-4">
                        <label for="message" class="form-label fw-bold">Message (required):</label>
                        <textarea id="message" name="message" rows="5" class="form-control" placeholder="Write your message here..."><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="submit" name="contact_submit" value="Send Message" class="btn btn-success fw-bold text-uppercase px-4 py-2 shadow-sm">
                    </div>
                    
                </form>
            </div>
        </div>
    <?php endif; ?>
</article>