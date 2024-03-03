@extends('scm::emails.mail_layout')


@section('mail_title')
    Welcome {{ $school->name }}
@endsection

@section('content')
    <table class="s-4 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"
        width="100%">
        <tbody>
            <tr>
                <td style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left"
                    width="100%" height="16">
                    &#160;
                </td>
            </tr>
        </tbody>
    </table>
    <p class="" style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left">
        Dear {{ $school->name }} your account has been registered successfully. You can login to create staff members and
        other school details.
    </p>
    <table class="s-4 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"
        width="100%">
        <tbody>
            <tr>
                <td style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left"
                    width="100%" height="16">
                    &#160;
                </td>
            </tr>
        </tbody>
    </table>
    <table class="btn btn-primary p-3 fw-700" role="presentation" border="0" cellpadding="0" cellspacing="0"
        style="border-radius: 6px; border-collapse: separate !important; font-weight: 700 !important;">
        <tbody>
            <tr>
                <td style="line-height: 24px; font-size: 16px; border-radius: 6px; font-weight: 700 !important; margin: 0;"
                    align="center" bgcolor="#0d6efd">
                    <a href="https://app.bootstrapemail.com/templates"
                        style="color: #ffffff; font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 6px; line-height: 20px; display: block; font-weight: 700 !important; white-space: nowrap; background-color: #0d6efd; padding: 12px; border: 1px solid #0d6efd;">
                        Login here
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
