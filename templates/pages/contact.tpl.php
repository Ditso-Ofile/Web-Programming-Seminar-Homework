<?php 
$success = isset($sent_successfully) ? $sent_successfully : false; 
$err_list = isset($errors) ? $errors : [];
?>

<script type="text/javascript">
function validateContactForm() {
    var name = document.forms["contactForm"]["name"].value;
    var email = document.forms["contactForm"]["email"].value;
    var message = document.forms["contactForm"]["message"].value;

    if (name == "" || email == "" || message == "") {
        alert("All fields must be filled out using JavaScript validation.");
        return false;
    }
    return true;
}
</script>

<?php if ($success): ?>
    <div class="alert alert-success">
        <h2>Message Sent Successfully</h2>
        <p><strong>Name:</strong> <?= htmlspecialchars($_POST['name'] ?? '') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($_POST['email'] ?? '') ?></p>
        <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($_POST['message'] ?? '')) ?></p>
        <br>
        <a href="contact" class="btn btn-primary">Send another message</a>
    </div>
<?php else: ?>

    <?php if (!empty($err_list)): ?>
        <div class="alert alert-danger" style="color:red;">
            <?php foreach($err_list as $err) echo "<p>$err</p>"; ?>
        </div>
    <?php endif; ?>

    <h2>Contact Information</h2>
    <p>Manager: <strong>Aws and Ditso</strong></p>
    <p>E-mail: <strong>somebody@simplewebsite.com</strong></p>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m12!1m3!1d2725.203649492147!2d19.6669509!3d46.8960799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4743da7a6c479e1d%3A0xc8292b3f6dc69e7f!2sPallasz%20Ath%C3%A9n%C3%A9%20Egyetem%20GAMF%20Kar!5e0!3m2!1sen!2shu!4v1619524000000!5m2!1sen!2shu" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    <br><br>

    <h3>Send us a message</h3>
    <form name="contactForm" action="contact" method="post" onsubmit="return validateContactForm()">
        <p>Name:<br> <input type="text" name="name" class="form-control"></p>
        <p>Email:<br> <input type="text" name="email" class="form-control"></p>
        <p>Message:<br> <textarea name="message" rows="5" class="form-control"></textarea></p>
        <p><input type="submit" name="contact_submit" value="Send Message" class="btn btn-success"></p>
    </form>
<?php endif; ?>