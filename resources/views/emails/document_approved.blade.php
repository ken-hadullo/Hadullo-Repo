<!DOCTYPE html>
<html>
<head>
    <title>Document Approved</title>
</head>
<body>
    <h2>Hello, {{ $document->user->name }}</h2>

    <p>Your document titled "<strong>{{ $document->proposal_title }}</strong>" has been approved on <strong>{{ \Carbon\Carbon::parse($document->approvedAt)->format('jS \of F Y') }}</strong>.</p>

    <p>We will inform you once your document is taken for review.</p>

    <p>Thank you!</p>
</body>
</html>
