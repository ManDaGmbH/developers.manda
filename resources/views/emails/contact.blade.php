<html>
    <head>
        <title>Mail from ' . $name . '</title>
    </head>
    <body>
        <table style="width: 500px; font-family: arial; font-size: 14px;" border="1">
            <tr style="height: 32px;">
                <th align="right" style="width:150px; padding-right:5px;">Name:</th>
                <td align="left" style="padding-left:5px; line-height: 20px;">{{ $details['name'] }}</td>
            </tr>
            <tr style="height: 32px;">
                <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
                <td align="left" style="padding-left:5px; line-height: 20px;">{{ $details['mail'] }}</td>
            </tr>
            <tr style="height: 32px;">
                <th align="right" style="width:150px; padding-right:5px;">Subject:</th>
                <td align="left" style="padding-left:5px; line-height: 20px;">{{ $details['subjectForm'] }}</td>
            </tr>
            <tr style="height: 32px;">
                <th align="right" style="width:150px; padding-right:5px;">Message:</th>
                <td align="left" style="padding-left:5px; line-height: 20px;">{{ $details['messageForm'] }}</td>
            </tr>
        </table>
    </body>
</html>