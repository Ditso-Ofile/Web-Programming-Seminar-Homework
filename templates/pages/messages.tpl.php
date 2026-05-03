<article class="pizza-card">
    <header class="mb-4">
        <h2 class="section-title fs-2">Inbox: Customer Messages</h2>
        <p class="text-muted">Here are the latest messages from the contact form, sorted by newest first.</p>
    </header>

    <?php if (isset($db_error)) { ?>
        
        <div class="alert alert-danger shadow-sm border-danger" role="alert">
            <strong>Error:</strong> <?= $db_error ?>
        </div>
    <?php } elseif (!empty($messages_data)) { ?>
        
        
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover mb-0">
                <thead style="background-color: #264653; color: #f1faee;">
                    <tr>
                        <th scope="col" style="width: 20%;">Date & Time</th>
                        <th scope="col" style="width: 20%;">Sender</th>
                        <th scope="col" style="width: 20%;">Email</th>
                        <th scope="col" style="width: 40%;">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages_data as $msg) { 
                        
                        
                        $senderName = trim($msg['sender_name']);
                        if (empty($senderName) || strtolower($senderName) == 'guest') {
                            $displayName = '<em class="text-secondary">Guest</em>';
                        } else {
                            $displayName = htmlspecialchars($senderName);
                        }
                    ?>
                        <tr>
                            <td class="align-middle"><?= htmlspecialchars($msg['created_at']) ?></td>
                            <td class="align-middle fw-bold"><?= $displayName ?></td>
                            <td class="align-middle">
                                <a href="mailto:<?= htmlspecialchars($msg['email']) ?>" class="text-decoration-none text-danger">
                                    <?= htmlspecialchars($msg['email']) ?>
                                </a>
                            </td>
                            <td class="align-middle"><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    <?php } else { ?>
        
        <div class="alert alert-info shadow-sm border-info" role="alert">
            No messages have been received yet.
        </div>
    <?php } ?>
</article>