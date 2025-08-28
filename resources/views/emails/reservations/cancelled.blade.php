<x-mail::message>
# რეზერვაციის სტატუსი: გაუქმებული ❌

გამარჯობა {{ $reservation->name ?? 'ძვირფასო კლიენტო' }}!

სამწუხაროდ, თქვენი რეზერვაცია (ID: #{{ $reservation->id }}) გაუქმდა.

## რეზერვაციის დეტალები:
- **რესტორანი:** {{ $restaurantName }}
- **თარიღი:** {{ $reservation->reservation_date ?? $reservation->date ?? 'N/A' }}
- **დრო:** {{ $reservation->time_from ?? $reservation->time ?? 'N/A' }}
- **მომხმარებელთა რაოდენობა:** {{ $reservation->guests_count ?? $reservation->seats ?? 'N/A' }}

@if(isset($reservation->notes) && $reservation->notes)
**მიზეზი:** {{ $reservation->notes }}
@endif

ჩვენ ძალიან გვწყინს ეს გარემოება. თუ თქვენთვის სხვა თარიღი ან დრო მოგწონთ, გთხოვთ, სცადოთ ახალი რეზერვაცია.

<x-mail::button :url="config('app.url')">
ახალი რეზერვაცია
</x-mail::button>

ბოდიშს გიხდით,<br>
{{ config('app.name') }}
</x-mail::message>
