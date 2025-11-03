<?php
// Telegram Bot Configuration
$botToken = 'YOUR_BOT_TOKEN_HERE';
$chatId = 'YOUR_CHAT_ID_HERE';

// Get data from GET request
if (isset($_GET['text'])) {
    $message = "New form submission:\n\n";
    $message .= htmlspecialchars($_GET['text'], ENT_QUOTES, 'UTF-8');
    
    
    // Send to Telegram
    $telegramUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $postData = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $telegramUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // Check if message was sent successfully
    if ($httpCode === 200) {
        echo "Message sent to Telegram successfully!";
    } else {
        echo "Failed to send message. Error: " . $response;
    }
} else {
    echo "No data received.";
}
?>