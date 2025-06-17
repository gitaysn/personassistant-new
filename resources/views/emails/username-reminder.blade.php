<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengingat Username</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2f855a;">Halo {{ $user->name ?? 'Pengguna' }},</h2>
        <p>Berikut adalah username yang terdaftar dengan email ini:</p>
        <p><strong>Username Anda:</strong> {{ $user->username }}</p>
        <br>
        <p>Jika Anda tidak meminta informasi ini, abaikan email ini.</p>
        <p>Terima kasih.</p>
        <hr>
        <p style="font-size: 12px; color: #888;">Email ini dikirim secara otomatis oleh sistem kami.</p>
    </div>
</body>
</html>
