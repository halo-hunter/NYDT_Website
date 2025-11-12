<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
@php
    $resetLink = route('portal->set-password->show', ['token' => $mail_data['token']]);
    $expiresAt = isset($mail_data['expires_at']) ? \Carbon\Carbon::parse($mail_data['expires_at'])->timezone(config('app.timezone')) : null;
@endphp
<div style="width: 95%; display: table; margin: 0 auto">

    <div style="width: 100%; height: 60px; margin-top: 15px; margin-left: 15px; margin-right:15px; background-color: #5e72e4; border-top-left-radius: 5px; border-top-right-radius: 5px;">
        <p style="color: #FFFFFF; text-align: center; padding-top: 20px; font-size: 18px; text-transform: uppercase;">
            <b>Set account password at NYDT.Law</b>
        </p>
    </div>

    <div style="width: 100%; height: auto; margin-top: -16px; margin-left:15px; margin-right: 15px; background-color: #f8f9fa; color: #000000; ">
        <div style="text-align: left; padding-bottom: 15px; padding-left: 15px;">
            <div style="margin-bottom: 15px!important; padding-top: 35px!important;">
                Set your account password here: <a href="{{ $resetLink }}" target="_blank">{{ $resetLink }}</a>
            </div>
            <div style="margin-bottom: 15px;">
                @if($expiresAt)
                    This link will expire on {{ $expiresAt->format('M d, Y h:i A') }}.
                @else
                    This link will expire soon. If it stops working, request a new invitation from your case manager.
                @endif
            </div>
        </div>
    </div>

    <div style="width: 100%; height: 40px; margin-top: -16px; margin-left: 15px; margin-right: 15px; background-color: #000; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
        <p style="color: #FFFFFF; text-align: center; padding-top: 10px">
            <a href="" style="text-decoration: none; color: #fff">{{ config('app.name') }}</a> {{ date('Y') }} &copy;
        </p>
    </div>

</div>
</body>
</html>
