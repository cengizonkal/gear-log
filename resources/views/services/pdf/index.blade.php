<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Servis Kartı</title>
</head>
<body style="font-family: DejaVu Sans, sans-serif; font-size: 12px;">

{{-- company name - title --}}
<table width="100%"cellspacing="0" cellpadding="5">
    <tr>
        <td width="70%">
            <p style="font-size: 16px; font-weight: bold;">{{ $service->user->company->name }}</p>
            <p style="font-size: 12px;">{{ $service->user->company->phone }}</p>
        </td>
        <td align="center"><strong>SERVİS KARTI</strong></td>
    </tr>
</table>
<br>


{{-- vehicle information --}}
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <tr><th colspan="3">Araç Bilgileri</th></tr>
    <tr>
        <td><strong>Plaka</strong> </td>
        <td><strong>Müşteri</strong></td>
        <td><strong>Telefon</strong></td>
    </tr>
    <tr>
        <td><span style="text-transform:uppercase"> {{ $service->vehicle->license_plate }} </span></td>
        <td>{{ $service->vehicle->owner->name }}</td>
        <td>{{ $service->vehicle->owner->phone }}</td>
    </tr>
</table>
<br>

{{-- service information --}}
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <tr><th colspan="4">Servis Bilgileri</th></tr>
    <tr>
        <td><strong>Açıklama</strong></td>
        <td><strong>Başlangıç</strong></td>
        <td><strong>Bitiş</strong></td>
        <td><strong>Durum</strong></td>
    </tr>
    <tr>
        <td>{{ $service->description ?? '-'}}</td>
        <td>{{ $service->started_at->format('d.m.Y') }}</td>
        <td>{{ $service->finished_at ? $service->finished_at->format('d.m.Y') : 'Devam Ediyor' }}</td>
        <td>{{ $service->status->name }}</td>
    </tr>
</table>
<br>


{{-- to-do list --}}

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <tr><th colspan="5">Yapılan İşlemler</th></tr>
    <tr>
        <th>Ürün</th>
        <th>Açıklama</th>
        <th>Miktar</th>
        <th>Birim Fiyat</th>
        <th>Toplam</th>
    </tr>

    @php $total = 0; @endphp

    @foreach($service->items as $item)
        @php
            $quantity = $item->pivot->quantity;
            $price = $item->pivot->price;
            $lineTotal = $quantity * $price;
            $total += $lineTotal;
        @endphp
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $quantity }}</td>
            <td>{{ number_format($price, 2, ',', '.') }} ₺</td>
            <td>{{ number_format($lineTotal, 2, ',', '.') }} ₺</td>
        </tr>
    @endforeach

    <tr>
        <td colspan="4" align="right"><strong>Toplam:</strong></td>
        <td><strong>{{ number_format($total, 2, ',', '.') }} ₺</strong></td>
    </tr>
</table>


</body>
</html>
