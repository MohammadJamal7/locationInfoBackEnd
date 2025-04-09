<!-- resources/views/emails/location_email.blade.php -->

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معلومات الموقع</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            margin: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: auto;
            text-align: center;
        }
        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }
        .data-list {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
            display: inline-block;
            text-align: left;
        }
        .data-list li {
            font-size: 18px;
            margin: 10px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>معلومات الموقع</h1>
        <p>مرحبًا</p>
        <p>لقد تم استلام معلومات موقع جديد</p>
        <ul class="data-list">
            <li><strong>العنوان:</strong> {{ $address }}</li>
            <li><strong>الايبي:</strong> {{ $ip }}</li
                <a href=""></a>
        </ul>
        <p>شكرًا لك!</p>
        <div class="footer">
            <p>هذا البريد الإلكتروني تم إرساله تلقائيًا. يرجى عدم الرد.</p>
        </div>
    </div>
</body>
</html>