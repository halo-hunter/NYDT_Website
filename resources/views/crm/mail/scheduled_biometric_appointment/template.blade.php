<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<div style="width: 95%; display: table; margin: 0 auto">

    <div style="width: 100%; height: 60px; margin-top: 15px; margin-left: 15px; margin-right:15px; background-color: #5e72e4; border-top-left-radius: 5px; border-top-right-radius: 5px;">
        <p style="color: #FFFFFF; text-align: center; padding-top: 20px; font-size: 18px; text-transform: uppercase;">
            <b>Scheduled Biometric Appointment Notification From NYDT.Law</b>
        </p>
    </div>

    <div style="width: 100%; height: auto; margin-top: -16px; margin-left:15px; margin-right: 15px; background-color: #f8f9fa; color: #000000; ">
        <p style="text-align: left; padding-top: 30px; padding-left: 15px;">Case ID: {{ $mail_data['case_id'] }}</p>
        <p style="text-align: left; padding-left: 15px;">Scheduled biometric appointment datetime: {{ $mail_data['scheduled_biometric_appointment_datetime'] }}</p>
        <p style="text-align: left; padding-left: 15px; padding-bottom: 30px">Scheduled biometric appointment address: {{ $mail_data['scheduled_biometric_appointment_address'] }}</p>
    </div>

    <div style="width: 100%; height: 40px; margin-top: -16px; margin-left: 15px; margin-right: 15px; background-color: #000; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
        <p style="color: #FFFFFF; text-align: center; padding-top: 10px">
            <a href="" style="text-decoration: none; color: #fff">{{ config('app.name') }}</a> {{ date('Y') }} &copy;
        </p>
    </div>

</div>
</body>
</html>
