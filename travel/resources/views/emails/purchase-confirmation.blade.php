<!DOCTYPE>
<html>
<head>
    <title>Order Summary</title>
</head>
<body>
<div class="">
    <h1>Thanks for Your Purchase</h1>
</div>
<p>Order Confirmation: {{$itinerary->title }}</p>
<p>Order Number: {{ $transaction_id }}</p>

<p>Hi {{$user->name}}, Thank you for purchasing at TripPlanShop.</p>

<p><i><b>{{$itinerary->title }} </b></i> has been added to your purchase list and you
    can view the full itinerary in your <a href="{{ route('user.purchasedList', $user) }}">Purchased Plans</a>
</p>

<p>We hope you have a wonderful trip from start to the end. Please leave a review on the itinerary when you come back.</p>

</body>
</html>

