@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
                <img src="https://kpopsoulmate.site/logo/logo-notification.png" alt="Kpop Soulmate Logo">
                <br>{{ $slot }}
            @endif
        </a>
        <i class="las la-paypal"></i>
    </td>
</tr>
