<x-mail::message>

<h1 class="fw-bold">Request Proceed</h1>

<p>Hi {{ $project->requester }}, We have received your request, we will proceed later, Thank you!</p>

<x-mail::table style="text-align: start">
| Here are the request details                        |
| ----------------------------------------------------|
| Title     : {{ $project->title }}                   |
| Category  : {{ $project->category->category_name }} |
| Requester : {{ $project->requester }}               |
| Notes     : {{ $project->notes }}                   |
</x-mail::table>

<a href="https://www.paypal.com/paypalme/kpopsoulmate" class="button button-main fw-semibold text-center">
    Support Us
</a>

</x-mail::message>
