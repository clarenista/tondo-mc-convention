<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<body>
    <a href="https://convention.psp.com.ph/login?name=${joinUrl}">
        <div style="background-image: url('https://psp70.s3.ap-southeast-1.amazonaws.com/psp70bg.PNG');width: 880px;height: 800px;text-align:center;">
        </div>
    </a>
    ${(customTextHeader!"")?html?replace("\n","<br>")}
    ${(customTextFooter!"")?html?replace("\n","<br>")}
</body>
</html>
