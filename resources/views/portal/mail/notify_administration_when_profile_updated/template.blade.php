<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<div style="width: 95%; display: table; margin: 0 auto">

    <div style="width: 100%; height: 60px; margin-top: 15px; margin-left: 15px; margin-right:15px; background-color: #5e72e4; border-top-left-radius: 5px; border-top-right-radius: 5px;">
        <p style="color: #FFFFFF; text-align: center; padding-top: 20px; font-size: 18px; text-transform: uppercase;">
            <b>Client profile updated at NYDT.Law</b>
        </p>
    </div>

    <div style="width: 100%; height: auto; margin-top: -16px; margin-left:15px; margin-right: 15px; background-color: #f8f9fa; color: #000000; ">

        <p style="text-align: left; padding-top: 30px; padding-left: 15px;">
            Client <span style="text-transform: capitalize">{{ $mail_data['customer_firstname_lastname'] }}</span> with following ID:
            {{ $mail_data['client_id'] }} has updated their profile:
        </p>

        <div style="padding-bottom: 20px">
            @if($mail_data['phone'] != 0)
                <p style="text-align: left; padding-top: 10px; padding-left: 15px;">
                    Phone (Primary): {{ $mail_data['phone'] }}
                </p>
            @endif

            @if($mail_data['phone_secondary'] != 0)
                <p style="text-align: left; padding-top: 10px; padding-left: 15px;">
                    Phone (Secondary): {{ $mail_data['phone_secondary'] }}
                </p>
            @endif

            @if($mail_data['email'] != 0)
                <p style="text-align: left; padding-top: 10px; padding-left: 15px;">
                    Email: {{ $mail_data['email'] }}
                </p>
            @endif
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
