<!DOCTYPE html>
<html>
<head>
    <title>Document Assigned Reviewer</title>
</head>
<body>
    <h2>Hello, {{ $document->user->name }}</h2>

    <p>Your document titled "<strong>{{ $document->proposal_title }}</strong>" has been assigned a Reviewer on <strong>{{ \Carbon\Carbon::parse($document->asssignedAt)->format('jS \of F Y') }}</strong>.</p>

    <p>We will inform you once your document has ben completed with the review.</p>

    <p>Thank you!</p>
</body>
</html>
