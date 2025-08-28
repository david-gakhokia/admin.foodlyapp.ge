<x-mail::message>
# რეზერვაციის სტატუსი: დადასტურებული ✅

გამარჯობა {{ $reservation->name ?? 'ძვირფასო კლიენტო' }}!

**გილოცავთ!** თქვენი რეზერვაცია (ID: #{{ $reservation->id }}) წარმატებით დადასტურდა.

## რეზერვაციის დეტალები:
- **რესტორანი:** {{ $restaurantName }}
- **თარიღი:** {{ $reservation->reservation_date ?? $reservation->date ?? 'N/A' }}
- **დრო:** {{ $reservation->time_from ?? $reservation->time ?? 'N/A' }}
- **მომხმარებელთა რაოდენობა:** {{ $reservation->guests_count ?? $reservation->seats ?? 'N/A' }}

თქვენი მაგიდა დაცულია! ელოდებით მითითებულ დროს.

@if(isset($reservation->price) && $reservation->price > 0)
**გასადახდელი თანხა:** {{ $reservation->price }} ₾
@endif

<x-mail::button :url="config('app.url')">
Foodly.ge-ზე ნახვა
</x-mail::button>

ძალიან ვუკურავებით რესტორანში!<br>
{{ config('app.name') }}
</x-mail::message>
