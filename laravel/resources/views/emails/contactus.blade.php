<!-- resources/views/emails/contact_me.blade.php -->
<!DOCTYPE>
<html>
<head>
    <title>Message From User</title>
</head>
<body>
<p>{!! $name.', ('. $email .'), says' !!}</p>
<p>{!! $content !!}</p>
<div>
    <img src="<?php echo $message->embed($image_path); ?> ">
</div>
</body>
</html>

