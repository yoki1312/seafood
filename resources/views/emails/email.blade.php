<!DOCTYPE html>
<html>
<head>
    <title>Serba Serbi Ujungpangkah</title>
</head>
<body>
    <img src="{{ $message->embed('assetFront/img/logo.png') }}" alt=""  style="display:block" width="300" height="87">
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>

    @if( isset($details['bukti_pembayaran']) )
        <img src="{{ $message->embed('file-pembayaran/'.$details['bukti_pembayaran'] ) }}" alt=""  style="display:block">
    @endif
    @if( isset($details['button']) )
    <br>
    <br>
    <br>
    <a href="{{ $details['button'] }}" target="_blank" style="background: cadetblue;padding: 8px 12px; border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;"> {{ $details['text_button'] }}  </a>
    @endif
    <p>Terima kasih !!</p>
</body>
</html>