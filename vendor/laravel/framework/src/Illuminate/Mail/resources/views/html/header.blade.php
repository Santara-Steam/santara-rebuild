<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
            <img src="https://dev.santara.co.id/public/admin/img/santara-tidur-dark.png" height="100px"
                alt="">
            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>