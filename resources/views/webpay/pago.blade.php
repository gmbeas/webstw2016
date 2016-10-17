<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body>


<form method="post" id="formulariotbk" action="{{$url}}">
    <input name="token_ws" value="{{$token_ws}}" type="HIDDEN">
</form>
</body>
</html>

<script>
    $(document).ready(function () {
        $("#formulariotbk").submit();
    });
</script>