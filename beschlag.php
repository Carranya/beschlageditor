<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Neu</title>
    <style>table,td {border:1px solid black;}</style>
</head>
<body>
    <?php

// Allgemeine Informationen

$ausfuehrung = htmlentities($_POST["ausfuehrung"]);
$system = $_POST["system"];
$beistoss = $_POST["beistoss"];
$fluegel = $_POST["fluegel"];
$din = $_POST["din"];

$BreiteG = 0;
$BreiteS = 0;
$Hoehe = 0;

$BreiteG = htmlentities($_POST["BreiteG"]);
$BreiteS = htmlentities($_POST["BreiteS"]);
$Hoehe = htmlentities($_POST["Hoehe"]);

$RC = $_POST["RC"];

// Beschläge

$schloss = $_POST["schloss"];
$panik = $_POST["panik"];
$svp = $_POST["svp"];
$dornmass = $_POST["dornmass"];

$schlossstand = $_POST["schlossstand"];

$eloeffner = $_POST["eloeffner"];

$band = $_POST["band"];
$anzband = $_POST["anzband"];

$sicherungsbolzen = 0;

$drueckerband = $_POST["drueckerband"];
$drueckergegenband = $_POST["drueckergegenband"];

$tuerschliesser = $_POST["tuerschliesser"];

$oberflaeche = htmlentities($_POST["oberflaeche"]);

// Weitere Beschläge
/*
echo "$fluegel<br>";
echo "$din<br>";
echo "<br>";
echo "$BreiteG<br>";
echo "$BreiteS<br>";
echo "$Hoehe<br>";
echo "<br>";
echo "$EI<br>";
echo "$RC<br>";
echo "<br>";
echo "$schloss<br>";
echo "$panik<br>";
echo "$svp<br>";
echo "$dornmass<br>";
echo "<br>";
echo "$band<br>";
echo "$anzband<br>";
echo "<br>";
echo "$tuerschliesser<br>";
echo "$schliessstaerke<br>";
echo "$gleitschiene<br>";

Offene Komponente
Kontrolle Brandschutz - OK
VKF - OK
Kontrolle Grösse - OK
Kontrolle 2-flügige Türe ohne Standflügelbeschlag ausgewählt - OK
Standart Gläser - OK
Weitere Besschläge wie Haftmagnet, Magnetkontakt, Planetdichtung
Standflügel Schloss - OK
Sicherungsbolzen - OK

*/
// Kontrolle und Warnungen


// Ausgabe Kopfdaten

echo "<table>";
echo "<tr><td>";

if ($fluegel == "2 fluegig")
{
    $fluegel = 2;
}
else
{
    $fluegel = 1;
}


echo "<p><u>Ausführung $ausfuehrung Stück</u></p>";
echo "<u>System:</u><br>";
echo "$system<br>";
echo "Bautiefe " . match ($system)
{
    "Forster presto 50" => "50mm",
    "Forster presto 50 E30" => "50mm",
    "Forster presto 60" => "60mm",
    "Forster presto 60 E30" => "60mm",
    "Forster fuego light EI30" => "65mm",
    "Forster fuego light EI60" => "65mm",
    "Forster unico" => "70mm",
    "Forster unico EI30" => "70mm",
    default => "0mm"
};
echo "<br>";

// VKF Berechnung


match ($system)
{
    "Forster presto 50 E30" => $EI = "E30",
    "Forster presto 60 E30" => $EI = "E30",
    "Forster fuego light EI30" => $EI = "EI30",
    "Forster fuego light EI60" => $EI = "EI60",
    "Forster unico EI30" => $EI = "EI30",
    default => $EI = "Kein" 
};

if($EI !== "Kein")
{
    switch($system)
    {
        case "Forster presto 50 E30":

        if($beistoss == "Nein")
        {
            if($fluegel == 1)
            {
                $vkf = "16617";
                break;
            }
            else
            {
                $vkf = "20431";
                break;
            }
        }
        else
        {
            if($fluegel == 1)
            {
                $vkf = "20430";
                break;
            }
            else
            {
                $vkf = "20432";
                break;
            }
        }

        case "Forster presto 60 E30":

            if($beistoss == "Nein")
            {
                if($fluegel == 1)
                {
                    $vkf = "16617";
                    break;
                }
                else
                {
                    $vkf = "20431";
                    break;
                }
            }
            else
            {
                if($fluegel == 1)
                {
                    $vkf = "20430";
                    break;
                }
                else
                {
                    $vkf = "20432";
                    break;
                }
            }

        case "Forster fuego light EI30":

            if($beistoss == "Nein")
            {
                if($fluegel == 1)
                {
                    $vkf = "22372";
                    break;
                }
                else
                {
                    $vkf = "22376";
                    break;
                }
            }
            else
            {
                if($fluegel == 1)
                {
                    $vkf = "22377";
                    break;
                }
                else
                {
                    $vkf = "22380";
                    break;
                }
            }

            case "Forster fuego light EI60":

                if($beistoss == "Nein")
                {
                    if($fluegel == 1)
                    {
                        $vkf = "23664";
                        break;
                    }
                    else
                    {
                        $vkf = "23687";
                        break;
                    }
                }
                else
                {
                    if($fluegel == 1)
                    {
                        $vkf = "23671";
                        break;
                    }
                    else
                    {
                        $vkf = "23689";
                        break;
                    }
                }

                case "Forster unico EI30":

                    if($beistoss == "Nein")
                    {
                        if($fluegel == 1)
                        {
                            $vkf = "26777";
                            break;
                        }
                        else
                        {
                            $vkf = "26779";
                            break;
                        }
                    }
                    else
                    {
                        if($fluegel == 1)
                        {
                            $vkf = "27105";
                            break;
                        }
                        else
                        {
                            $vkf = "26780";
                            break;
                        }
                    }

        default:
            $vkf = "00000";
            break;
    }
    
    echo "VKF Nr.: $vkf";
    echo "<br>";
}

if($RC !=="Keine")
{
    echo "Widerstandsklasse: $RC<br>";
}

echo "<br>";

// Glas

echo "<u>Glas</u><br>";

if($EI == "Kein")
{
    echo "ESG 8mm<br>";
}

if($EI == "E30")
{
    echo "Pyroclear 30-002 - 8mm <br>";
}

if($EI == "EI30")
{
    echo "Pyrostop 30-10 - 15mm <br>";
}

if($EI == "EI60")
{
    echo "Pyrostop 60-101 - 23mm <br>";
}

if($EI == "EI30")
    if($system == "Forster unico EI30")
    {
        echo "Aussen: VSG 8-2<br>";
        echo "LZR: 15mm<br>";
        echo "Innen: Pyrostop 60-101 - 23mm <br>";
        echo "<u>Total = 47mm</u><br>";
        echo "U-Wert = 1.1 W/m2K<br>";
    }

if($system == "Forster unico")
{
    echo "Aussen: VSG 8-2<br>";
    echo "LZR: 15mm<br>";
    echo "Innen: Float 4mm <br>";
    echo "<u>Total = 28mm</u><br>";
    echo "U-Wert = 1.1 W/m2K<br>";    
}

// Ausgabe Schloss Gehflügel

echo "<br>";
echo "<u>Beschläge</u><br>";

switch($schloss)
{
    case "Einsteckschloss mit oberer Verriegelung":
        echo "1 Stk. - $schloss, $panik$svp, $dornmass, $din<br>";
        if($eloeffner !== "Kein")
        {
            echo "1 Stk. - Schliessblech für El. Türöffner<br>"; 
        }
        else
        {
            echo "1 Stk. - Schliessblech<br>";
        }
        echo "1 Stk. - Treibriegelstange oben mit obere Falle und Stangenführung<br>";
    break;

    case "Elektroschloss EFF-EFF 809NE":
        $panik = "Panikfunktion B";
        $svp = ", selbstverriegelt";

        echo "1 Stk. - $schloss, $panik$svp, $dornmass, $din<br>";
            if($eloeffner !== "Kein")
            {
                echo "1 Stk. - Fallenschloss EFF-EFF 807<br>";
            }
            else
            {
                echo "1 Stk. - Schliessblech<br>";
            }
        break;

    case "Motorschloss EFF-EFF 509NE":
        $panik = "Panikfunktion E";
        $svp = ", selbstverriegelt";

        echo "1 Stk. - $schloss, $panik$svp, $dornmass, $din<br>";
            if($eloeffner !== "Kein")
            {
                 echo "1 Stk. - Fallenschloss EFF-EFF 807<br>";
            }
            else
            {
                echo "1 Stk. - Schliessblech<br>";
            }
        break;

    case "Mehrpunkt Elektroschloss EFF-EFF 819NE":
        $panik = "Panikfunktion B";
        $svp = ", selbstverriegelt";

        echo "1 Stk. - $schloss, $panik$svp, $dornmass, $din";
        if($eloeffner !== "Kein")
            {
                echo ", mit Zusatzfalle";
            }
        echo "<br>";
        echo "1 Stk. - Schliessblech Set 3-teilig<br>";
        if($eloeffner !== "Kein")
            {
                echo "1 Stk. - Schliessblech für El. Türöffner<br>";
            }
        if($Hoehe >= 2600 && $EI !== "Kein")
        {
            echo "1 Stk. - Stulpverlängerung für EFF-EFF 819NE<br>";
            echo "1 Stk. - Schliessblech für Stulpverlängerung<br>";
        }
        echo "1 Stk. - Anschlusskabel 10m<br>";
        echo "1 Stk. - IO Modul<br>";
        echo "1 Stk. - Steuerkasten<br>";
        break;

        case "Mehrpunkt Motorschloss EFF-EFF 519NE":
            $panik = "Panikfunktion E";
            $svp = ", selbstverriegelt";

            echo "1 Stk. - $schloss, $panik$svp, $dornmass, $din";
            if($eloeffner !== "Kein")
            {
                echo ", mit Zusatzfalle";
            }
            echo "<br>";
            echo "1 Stk. - Schliessblech Set 3-teilig<br>";
            if($eloeffner !== "Kein")
            {
                echo "1 Stk. - Schliessblech für El. Türöffner<br>";
            }
            if($Hoehe >= 2600 && $EI !== "Kein")
            {
                echo "1 Stk. - Stulpverlängerung für EFF-EFF 519NE<br>";
                echo "1 Stk. - Schliessblech für Stulpverlängerung<br>";
            }
            echo "1 Stk. - Anschlusskabel 10m<br>";
            echo "1 Stk. - IO Modul<br>";
            echo "1 Stk. - Steuerkasten<br>";
        break;    

        default:
        echo "1 Stk. - $schloss, $panik$svp, $dornmass, $din<br>";
            if($eloeffner !== "Kein")
            {
                echo "1 Stk. - Schliessblech für El. Türöffner<br>";
            }
            else
            {
                echo "1 Stk. - Schliessblech<br>";
            }
        break;
}

// Ausgabe Schloss Standflügel

switch($schlossstand)
{
    case "Falztreibriegelschloss":
        echo "1 Stk. - $schlossstand<br>";
        echo "1 Stk. - Treibriegelstange oben<br>";
        echo "1 Stk. - Treibriegelstange unten<br>";
        echo "1 Stk. - Obere Falle<br>";
        echo "1 Stk. - Schliessblech für obere Falle<br>";
        echo "1 Stk. - Bodenbuchse<br>";
        break;

    case "Kantenbascule":
        echo "1 Stk. - $schlossstand<br>";
        echo "1 Stk. - Treibriegelstange oben<br>";
        echo "1 Stk. - Treibriegelstange unten<br>";
        echo "1 Stk. - Obere Falle<br>";
        echo "1 Stk. - Schliessblech für obere Falle<br>";
        echo "1 Stk. - Bodenbuchse<br>";
        break;

    case "Panik Gegenkasten":
        echo "1 Stk. - $schlossstand<br>";
        echo "1 Stk. - Treibriegelstange oben<br>";
        echo "1 Stk. - Obere Falle<br>";
        echo "1 Stk. - Schliessblech für obere Falle<br>";
        break;
    
    default:
        break;
}

// Ausgabe Elektrotüröffner

if($eloeffner !== "Kein")
    if($schloss == "Einsteckschloss mit oberer Verriegelung")
        {
            echo "2 Stk. - $eloeffner<br>";
            echo "1 Stk. - Schliessblech für El. Türöffner oben<br>";
        }
        else
        {
            echo "1 Stk. - $eloeffner<br>";
        }

// Ausgabe Band

switch ($band)
{
    case "Anschweissband":
        echo $anzband * $fluegel . " Stk. - $band<br>";
    break;

    case "Anschraubband":
        if($fluegel == 2)
        {
            echo "$anzband Stk. - $band DIN Links<br>";
            echo "$anzband Stk. - $band DIN Rechts<br>";
        }
        else
        {
            echo "$anzband Stk. - $band $din<br>";
        }
        break;
}

// Sicherungsbolzen

if($EI !== "Kein")
{
    if($RC == "RC3")
        {
            $sicherungsbolzen = 3 * $fluegel;
        }
        else
        {
            $sicherungsbolzen = 1 * $fluegel;
        }
}    

if($RC == "RC2")
    {
        if($EI == "Kein")
        {
            $sicherungsbolzen = 1 * $fluegel;
        }
    }

if($RC == "RC3")
    {
        if($EI == "Kein")
        {
            $sicherungsbolzen = 3 * $fluegel;
        }
    }
if($sicherungsbolzen !== 0)
{
    echo "$sicherungsbolzen Stk. - Sicherungsbolzen<br>";
}



// Ausgabe Drücker

if($drueckerband !== "kein")
    {
        if($drueckerband == $drueckergegenband)
        {
           echo "2 Stk. - $drueckerband<br>";
        }
        else
        {
            echo "1 Stk. - $drueckerband<br>";              
        }
    }

    if($drueckergegenband !== "kein")
    {
        if($drueckerband !== $drueckergegenband)
        {
            echo "1 Stk. - $drueckergegenband<br>";              
        }
    }

// Ausgabe Türschliesser

if($tuerschliesser !== "kein")
{
    echo "$fluegel Stk. - $tuerschliesser<br>";
    if ($fluegel == 1)
    {
        if (isset($_POST['emf']))
        {
            echo "1 Stk. - Gleitschiene mit EMF<br>";
        }
        else
        {
            echo "1 Stk. - Gleitschiene G-N<br>";
        }
    }
    if ($fluegel == 2)
    {
        if (isset($_POST['emf']))
        {
            echo "1 Stk. - Gleitschiene GSR mit Schliessfolgeregler und EMF<br>";
        }
        else
        {
            echo "1 Stk. - Gleitschiene GSR mit Schliessfolgeregler<br>";
        }
    }
}


// Weitere Beschläge

if(isset($_POST['magnetkontakt']))
{
    echo "$fluegel Stk. - Magnetkontakt DMC 20<br>";
}

if(isset($_POST['planet']))
{
    echo "$fluegel Stk. - Absenkdichtung<br>";
}

if(isset($_POST['haftmagnet']))
{
    echo "$fluegel Stk. - Haftmagnet Dorma EM 500G<br>";
    echo "$fluegel Stk. - Haftmagnetgegenplatte MAW<br>";
    echo "$fluegel Stk. - Ausgleichsrahmen<br>";
}

echo nl2br(htmlentities($_POST['eigenertext'])) . "<br><br>";

echo "<u>Oberflächenbehandlung:</u><br>";
echo "$oberflaeche<br>";

echo "</td></tr>";
echo "</table>";

// Kontrolle und Warnungen

echo "<br>";

if($BreiteG > 1400 && $EI !== "Kein")
{
    echo "<p style='color: red'><b>Warnung!</b> Türflügel Breite max. 1400mm zulässig!</p>";
}

if($Hoehe > 3000 && $EI !== "Kein")
{
    echo "<p style='color: red'><b>Warnung!</b> Türflügel Höhe max. 3000mm zulässig!</p>";
}

if($BreiteS < 670 && $tuerschliesser == "Ingetrieter Türschliesser Dorma ITS98, Stärke 3-6")
{
    echo "<p style='color: red'><b>Warnung!</b> Standflügel evtl. zu schmal ür ITS96!</p>";
}

if($fluegel == 2 && $schlossstand == "Kein")
{
    echo "<p style='color: red'><b>Warnung!</b> Schloss für Standflügel nicht ausgewählt</p>";
}

if($RC == "RC3")
echo match ($schloss)
{
    "Einsteckschloss", "Einsteckschloss mit oberer Verriegelung", "Elektroschloss EFF-EFF 809NE", "Motorschloss EFF-EFF 509NE"
    => "<p style='color: red'><b>Warnung!</b> Mehrpunktschloss für RC3 Türen benötigt!",
    default => "",
}

    ?>
</body>
</html>
