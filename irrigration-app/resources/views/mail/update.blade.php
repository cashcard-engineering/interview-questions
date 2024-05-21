<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Schedule Updated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .content {
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Schedule Updated</h2>
        </div>
        <div class="content">
            <p>Dear Admin,</p>
            <p>A schedule for Zone {{$data->name}} has been updated.</p>
        </div>
    </div>
</body>
</html>
