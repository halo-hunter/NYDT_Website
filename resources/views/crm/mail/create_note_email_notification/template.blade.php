<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<div style="width: 95%; display: table; margin: 0 auto">

    <div style="width: 100%; height: 60px; margin-top: 15px; margin-left: 15px; margin-right:15px; background-color: #5e72e4; border-top-left-radius: 5px; border-top-right-radius: 5px;">
        <p style="color: #FFFFFF; text-align: center; padding-top: 20px; font-size: 18px; text-transform: uppercase;">
            <b>Case Update Notification From NYDT.Law</b>
        </p>
    </div>

    <div style="width: 100%; height: auto; margin-top: -16px; margin-left:15px; margin-right: 15px; background-color: #f8f9fa; color: #000000; ">
        <p style="text-align: left; padding-bottom: 30px; padding-left: 15px;">
            <p style="padding-bottom: 15px; padding-left: 30px;">Hello <span style="text-transform: capitalize">{{ $mail_data['client_first_name'] }}</span>, There is an update on your case, please login to our portal, to view the update details. Click <a href="{{ route('portal->login->show') }}" target="_blank">here</a> to visit our portal.</p>
            <p style="padding-left: 30px;">Best Regards,</p>
            <p style="padding-bottom: 40px; padding-left: 30px;">NYDT.Law</p>
        </p>
    </div>

    <div style="width: 100%; height: 40px; margin-top: -16px; margin-left: 15px; margin-right: 15px; background-color: #000; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
        <p style="color: #FFFFFF; text-align: center; padding-top: 10px">
            <a href="" style="text-decoration: none; color: #fff">{{ config('app.name') }}</a> {{ date('Y') }} &copy;
        </p>
    </div>

</div>
</body>
</html>
