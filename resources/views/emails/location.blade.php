<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بيانات الموقع</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 40px 0;
            background-color: #e0f7fa;
        }
        .email-wrapper {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            color: #34495e;
            font-size: 16px;
            line-height: 1.6;
        }
        .data-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            padding: 12px 20px;
            text-align: right;
            border: 1px solid #ddd;
        }
        .data-table th {
            background-color: #3498db;
            color: white;
        }
        .data-table td {
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #7f8c8d;
        }
        .footer a {
            color: #3498db;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
            text-align: center;
        }
        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-wrapper">
            <h1>بيانات الموقع</h1>
            <p>مرحبًا،</p>
            <p>إليك تفاصيل الموقع المحدثة:</p>

            <table class="data-table">
                <tr>
                    <th>خط العرض</th>
                    <td>{{ $latitude }}</td>
                </tr>
                <tr>
                    <th>خط الطول</th>
                    <td>{{ $longitude }}</td>
                </tr>
                <tr>
                    <th>عنوان IP</th>
                    <td>{{ $ip }}</td>
                </tr>
            </table>

            <p>إذا كانت لديك أي استفسارات أخرى، لا تتردد في الاتصال بنا.</p>

            <a href="https://example.com" class="button">مزيد من التفاصيل</a>

            <div class="footer">
                <p>شكرًا لك على استخدام خدمتنا.</p>
                <p>فريق الدعم | <a href="https://example.com">رابط الموقع</a></p>
            </div>
        </div>
    </div>
</body>
</html>
