<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Push Agency</title>
  </head>
  <body style="font-family: Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <table align="center" cellpadding="0" cellspacing="0" style="max-width: 1000px; border: 1px solid #063F30">
      <tbody>
        <tr style="background-color: #063F30;">
          <td style="padding: 40px!important; font-size: 30px; text-align: center; color: white;">
            <img src="{{ asset("logo.png") }}" alt="Logo" style="max-width: 100%; height: auto;" />
            <p style="padding-left: 20px;">Welcome to E-push Agency</p>
          </td>
        </tr>
        <tr>
          <td style="font-size: 16px; padding: 40px; background-color: #fff; color: #000;">
            You can send your SMS from this credentials: <br /><br />
            <strong>URL:</strong> <a href="https://epushagency.com" style="color: #063F30; cursor: pointer; text-decoration: underline;">epushagency.com</a><br /><br />
            <strong>Username:</strong> {{ $client['username'] }}<br /><br />
            <strong>Password:</strong> sent by SMS to <strong>{{ $client['phone'] }}</strong><br /><br />
            For any issues on services please contact us at <a href="mailto:support@epushagency.com" style="color: #063F30!important; cursor: pointer; text-decoration: underline;">support@epushagency.com</a>
            <br /><br />
            For API service please contact your account manger or contact us at <a href="mailto:support@epushagency.com" style="color: #063F30!important; cursor: pointer; text-decoration: underline;">support@epushagency.com</a>
            <br /><br />
            Best Regards <br />
            E-push team
          </td>
        </tr>
        <tr>
          <td style="color: white; padding: 10px 20px; text-align: center; background-color: #063F30;">
            <p style="font-size: 14px;">&copy; 2023 All rights reserved.</p>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>