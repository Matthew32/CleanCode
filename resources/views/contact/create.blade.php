<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div id="error" class="alert alert-danger col-12">

            </div>
        </div>
        <div class="row">
            <div class="col-12 full-height">
                <form method="post" action="/api/contact" id="contact-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" type="text" placeholder="Put you're name"/>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input class="form-control" name="email" type="email" placeholder="Put you're email"/>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone number</label>
                        <input class="form-control" name="phoneNumber" type="text"
                               placeholder="Put you're phone number"/>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control rounded-0" name="message" rows="20" cols="20"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    var _serializeForm = function (id) {
        var result = {};
        $.each($(id).serializeArray(), function (i, field) {
            result[field.name] = field.value.trim() || null;
        });
        return result;
    }
    $(document).ready(function () {
        $('#error').hide();
        $("#contact-form").submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: JSON.stringify(_serializeForm('#contact-form')),
                contentType: 'application/json',
                dataType: 'json',
                success: function (response) {
                    $('#error').text(response.message);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#error').show();
                    if (jqXHR.status == 500) {
                        var response = JSON.parse(jqXHR.responseText)
                        $('#error').html(response.message);
                    }
                    if (jqXHR.status == 422) {
                        var response = jqXHR.responseJSON
                        var message = '';
                        $.each(response, function (i, field) {
                            message += i + ':' + field[0] + '<br />';
                        });
                        $('#error').html(message);
                    }
                }
            });
        });
    });
</script>
</body>
</html>
