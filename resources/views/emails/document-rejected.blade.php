<!DOCTYPE html>
<html>
<head>
    <title>Document Rejected</title>
</head>
<body>
    <h2>Hello, {{ $document->user->name }}</h2>

    <p>Unfortunately, your document titled "<strong>{{$document->proposal_title }}</strong>" has been rejected.</p>

    <p><strong>Reason for rejection:</strong></p>
    <blockquote style="color: red;">{{ $rejection_message }}</blockquote>

    <p>Please review the feedback and resubmit if necessary.</p>

    <p>Thank you!</p>
   <p>Date:<strong>{{ \Carbon\Carbon::parse($document->approvedAt)->format('jS \of F Y') }}</strong>.</p>
</body>
</html>
