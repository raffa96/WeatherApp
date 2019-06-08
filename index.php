<?php
$weather = "";
$error = "";

if ($_GET['city']) {
    $urlContents = @file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=908a999b0a360f2beae0d7197887f91c");

    $weatherArray = json_decode($urlContents, true);

    if ($weatherArray['cod'] == 200) {
        $weather = "The weather in ".$_GET['city']." is currently <i>".$weatherArray['weather'][0]['description']."</i>. ";

        $tempCelsius = $weatherArray['main']['temp'] - 273;

        $speedKH = $weatherArray['wind']['speed'] * 3.6;

        $weather .= "The temperature is ".intval($tempCelsius)." &deg;C and the wind speed is ".$speedKH." Km/h.";
    } else {
        $error = "Could not find city - Please try again...";
    }
} else {
    $error = "Please enter the name of the city and try again to view the weather...";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Weather App</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <main id="app">
        <div class="container">
            <h1 class="display-3">What's The Weather?</h1>
            <form class="my-5">
                <div class="col-sm-12 col-md-6 col-lg-6 m-auto">
                    <div class="row form-group">
                        <label for="city">Enter the name of a City:</label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = "<?php if (array_key_exists('city', $_GET)) { echo $_GET['city']; } ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

            <div id="weather">
                <?php
                if ($weather) {
                    echo '<div class="alert alert-success" role="alert">
                    '.$weather.'
                    </div>';
                } else if ($error) {
                    echo '<div class="alert alert-danger" role="alert">
                    '.$error.'
                    </div>';
                }
                ?>
            </div>
        </div>
    </main>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
