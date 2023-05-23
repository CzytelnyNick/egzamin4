<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl3.css">
    <title>Twoje BMI</title>
</head>

<body>
    <header class="logo"><img src="../wzor.png" alt="wzór BMI"></header>
    <header class="baner">
        <h1>Oblicz swoje BMI</h1>
    </header>
    <main class="glowny">
        <table>
            <thead>
                <th>Interpretacja BMI</th>
                <th>Wartość minimalna</th>
                <th>Wartość maksymalna</th>
            </thead>
            <?php
            $hostname = "localhost";
            $user = "root";
            $pass = "root";
            $dbname = "egzamin";
            $conn = mysqli_connect($hostname, $user, $pass, $dbname);
            $sql = "SELECT `informacja`, `wart_min`, `wart_max` FROM `bmi`;";
            $results = mysqli_query($conn, $sql);
            if (mysqli_num_rows($results) > 0) {
                while ($row = mysqli_fetch_array($results)) {
                    echo "<tr><td>" . $row["informacja"] . "</td><td>" . $row["wart_min"] . "</td><td>" . $row["wart_max"] . "</td>";
                }
            }
            ?>
        </table>
    </main>
    <aside class="prawy"><img src="../rys1.png" alt="ćwiczenia"></aside>
    <aside class="lewy">
        <h2>Podaj wagę i wzrost</h2>
        <form action="" method="POST">
            Waga:<input type="text" name="waga"><br>
            Wzrost w cm: <input type="number" name="wzrost" id="" min="1"><br>
            <input type="submit" value="Oblicz i zapamiętaj wynik">

        </form>
        <?php
        $data = date("Y-m-d");
        // echo (isset($_POST["wzrost"]));
        if (isset($_POST["waga"]) and isset($_POST["wzrost"])) {

            $waga = $_POST["waga"];
            $wzrost = $_POST["wzrost"];
            $bmi = ($waga / ($wzrost * $wzrost)) * 10000;
            echo "Twoja waga: " . $waga . "; Twój wzrost: " . $wzrost . "<br>";
            echo "BMI wynosi: " . $bmi;
        }
        if($bmi >= 0 and $bmi <=18){
            $case = "niedowaga";
        }
        if($bmi >= 19 and $bmi <=25){
            $case = "waga prawidłowa";
        }
        if($bmi >= 26 and $bmi <= 30){
            $case = "nadwaga";
        }
        if($bmi >=31 and $bmi <= 100){
            $case = "otylosc";

        }
        switch($case){
            case "niedowaga":
                $sql="INSERT INTO `wynik`(`id`, `bmi_id`, `data_pomiaru`, `wynik`) VALUES (null, 1, '$data', $bmi);";
                mysqli_query($conn, $sql);
                break;
            case "waga prawidłowa": 
                $sql="INSERT INTO `wynik`(`id`, `bmi_id`, `data_pomiaru`, `wynik`) VALUES (null, 2, '$data', $bmi);";
                mysqli_query($conn, $sql);
                break;
            case "nadwaga": 
                $sql="INSERT INTO `wynik`(`id`, `bmi_id`, `data_pomiaru`, `wynik`) VALUES (null, 3, '$data', $bmi);";
                mysqli_query($conn, $sql);
                break;
            case "otylosc": 
                $sql="INSERT INTO `wynik`(`id`, `bmi_id`, `data_pomiaru`, `wynik`) VALUES (null, 4, '$data', $bmi);";
                mysqli_query($conn, $sql);
                break;
        }
        ?>
    </aside>

    <footer class="stopka">Autor: DamianOdrowążPESEL <a href="./kwerendy.txt">Zobacz kwerendy</a>


    </footer>
</body>

</html>