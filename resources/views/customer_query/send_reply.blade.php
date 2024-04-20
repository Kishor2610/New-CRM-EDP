<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Your Query</title>
</head>
<body>
    <h2>Reply to Your Query</h2>
    <p>
        Hello {{ $customerQuery->user_name }},
    </p>
    <p>
        We have received your query with the subject "{{ $customerQuery->query_subject }}". Here is our response:
    </p>
    <p>
        {{ $solution }}
    </p>
    <p>
        If you have any further questions or concerns, feel free to reach out to us.
    </p>
    <p>
        Regards,<br>
        Your Company Name
    </p>
</body>
</html>
