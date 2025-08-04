<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Assignment Reminder</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="background-color: #ffffff; border-radius: 8px; padding: 20px; max-width: 600px; margin: 0 auto;">
        <h2 style="color: #333333;">📌 Assignment Reminder</h2>

        <p>Hi, Karyawan atas nama <strong>{{ $employee }}</strong>, Request assignment untuk project</p>
        <p>Berikut adalah detail assignmentnya :</p>

        <ul style="line-height: 1.6; color: #333333;">
            <li><strong>Purpose:</strong> {{ $purpose }}</li>
            <li><strong>Tanggal:</strong> {{ $date }}</li>
            <li><strong>Jam:</strong> {{ $time }}</li>
            <li><strong>Requestor:</strong> {{ $requestor }}</li>
            <li><strong>Company:</strong> {{ $company }}</li>
            <li><strong>Type Meeting:</strong> {{ $meeting_type }}</li>
        </ul>

        <p>
            Klik tombol di bawah ini untuk <strong>konfirmasi assignment</strong>:
        </p>

        <p style="text-align: center; margin-top: 20px;">
            <a href="{{ $confirmUrl }}" 
               style="display: inline-block; background-color: #4CAF50; color: white; padding: 12px 24px; text-decoration: none; font-size: 16px; border-radius: 5px;">
                ✅ Approve Konfirmasi
            </a>
        </p>

        <p style="margin-top: 30px; color: #777777; font-size: 12px;">
            *Jika Anda tidak merasa melakukan request ini, abaikan email ini.
        </p>
    </div>
</body>
</html>
