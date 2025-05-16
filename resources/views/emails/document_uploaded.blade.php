<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Dynamic Greeting Section -->
        <h3>Hello {{ $recipientRole }},</h3>

        <p class="content">
            A new document titled <strong>"{{ $document->proposal_title }}"</strong> has been uploaded.
        </p>
        <p class="content">
            <strong>Uploaded by:</strong> {{ $document->user->name }} <br>
            <strong>Department:</strong> {{ $document->user->department->name ?? 'Unknown Department' }} <br>
            <strong>Proposal Level:</strong> {{ $document->proposalLevel->name }}
        </p>

        <!-- View Document Button -->
        <a href="{{ asset('uploads/documents/' . basename($document->proposal_doc_path)) }}" class="button">View Document</a>

        <p class="footer">
            Best regards, <br>
            Your Application Team
        </p>
    </div>
</body>
</html>