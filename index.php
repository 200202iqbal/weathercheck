<?php
if (isset($_GET["city"]))
{
    $city = $_GET["city"];
    //APIのURL
    $url = "https://goweather.herokuapp.com/weather/{$city}";
    //echo $url;

    $json = file_get_contents($url);
    //var_dump($json); 
    //type data : string
    

    //UTF8に変換
    $json = mb_convert_encoding($json,"UTF8", "ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN,SJIS");
    //var_dump($json);
    //JSONをPHPのデータに変換
    $data = json_decode($json,true);
    //var_dump($data);
    //type data : array

    if (is_array($data))
    {
        $temperature = $data["temperature"];
        $wind = $data["wind"];
        $desc = $data["description"];
        //var_dump($temperature);
        //var_dump($wind);
        //var_dump($desc);
    }
}
if(!isset($_GET["city"]) || !is_array($data))
{
    $city = "None";
    $temperature = "None";
    $wind = "None";
    $desc = "None";
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once "head.php"?>
<link rel="stylesheet" href="style.css">
<body>
    <div class="container">
    
        <h1>Weather Check</h1>
        <div class="container-sm">
            <label for="inputLocation" class="form-label">Input location :</label>
            <form action="" method="get">
                <div class="input-group">
                <input type="text" name="city" class="form-control" id="inputLocation" required>
                <button class="btn btn-outline-secondary btn-primary" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
        
        <div class="container" id="resultTemp">
            <div class="row align-items-center">
                <div class="col">
                    <h2>Location</h2>
                    <i class="bi bi-geo-alt-fill"></i>
                    <p><?=$city?></p>
                </div>
                <div class="col">
                    <h2>Temperature </h2>
                    <i class="bi bi-thermometer"></i>
                    <p><?=$temperature?></p>
                </div>
                <div class="col">
                    <h2>Wind</h2>
                    <i class="bi bi-wind"></i>
                    <p><?=$wind?></p>
                </div>

                <div class="col">
                    <h2>Description</h2>
                    <i class="bi bi-cloud-sun-fill"></i>
                    <p><?=$desc?></p>
                </div>
            </div>
        </div>

    </div>
</body>
</html>