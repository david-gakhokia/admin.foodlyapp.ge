<x-mail::message>
# რეზერვაციის სტატუსი: დასრულებული 🎉

გამარჯობა {{ $reservation->name ?? 'ძვირფასო კლიენტო' }}!

გმადლობთ რომ ირჩევთ ჩვენს სერვისს! თქვენი რეზერვაცია (ID: #{{ $reservation->id }}) წარმატებით დასრულდა.

## რეზერვაციის დეტალები:
- **რესტორანი:** {{ $restaurantName }}
- **თარიღი:** {{ $reservation->reservation_date ?? $reservation->date ?? 'N/A' }}
- **დრო:** {{ $reservation->time_from ?? $reservation->time ?? 'N/A' }}
- **მომხმარებელთა რაოდენობა:** {{ $reservation->guests_count ?? $reservation->seats ?? 'N/A' }}

ვიმედოვნებთ, რომ მოგეწონათ ჩვენი სერვისი! 

**შეაფასეთ თქვენი გამოცდილება და დატოვეთ უკუკავშირი.**

<x-mail::button :url="config('app.url')">
შეფასება დატოვება
</x-mail::button>

გმადლობთ და მალე გნახავთ!<br>
{{ config('app.name') }}
</x-mail::message>
