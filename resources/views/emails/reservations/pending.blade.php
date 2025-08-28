<x-mail::message>
# რეზერვაციის სტატუსი: მოლოდინში

გამარჯობა {{ $reservation->name ?? 'ძვირფასო კლიენტო' }}!

თქვენი რეზერვაციის (ID: #{{ $reservation->id }}) სტატუსი შეიცვალა და ახლა **მოლოდინშია**.

## რეზერვაციის დეტალები:
- **რესტორანი:** {{ $restaurantName }}
- **თარიღი:** {{ $reservation->reservation_date ?? $reservation->date ?? 'N/A' }}
- **დრო:** {{ $reservation->time_from ?? $reservation->time ?? 'N/A' }}
- **მომხმარებელთა რაოდენობა:** {{ $reservation->guests_count ?? $reservation->seats ?? 'N/A' }}

რესტორნის მენეჯერი მალე განიხილავს თქვენს მოთხოვნას და დაგიკავშირდებათ დადასტურებისთვის.

<x-mail::button :url="config('app.url')">
Foodly.ge-ზე ნახვა
</x-mail::button>

გმადლობთ,<br>
{{ config('app.name') }}
</x-mail::message>
