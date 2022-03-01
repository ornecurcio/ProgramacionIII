<?php  
//======================================================================
// Obtenga la fecha actual del servidor (función date) 
// y luego imprímala dentro de la página con distintos formatos 
// (seleccione los formatos que más le guste). 
// Además indicar que estación del año es. 
// Utilizar una estructura selectiva múltiple.
//======================================================================
// date_default_timezone_set("America/Argentina/Buenos_Aires");
// echo "The time is " . date("h:i:sa");
/*Using arrays
$months= array("January" => 1,
"February" => 2,
"March" => 3,
"April" => 4,
"May" => 5,
"January" => 6,
"July" => 7,
"August" => 8,
"September" => 9,
"Octuber" => 10,
"November" => 11,
"December" => 12,);
*/
// $dateAux =new DateTime(date("Y-m-d"));
$y = date("Y");
$m = date("m");
$d = date("d");
$date = date("Y-m-d");
// date_date_set($date,$y,$m,$d);
echo( "The date is: " . $date);
echo(idate($m));
$season = GetSeason(2);
echo("The season is: " . $season);
// if(isDateBetweenDates(date_create("2011-03-19"),date_create("2013-03-17"),date_create("2013-03-20"))){
// echo("si");
// }
// else{
// echo("no");
// }

/**
 * @param DateTime $date Date that is to be checked if it falls between $startDate and $endDate
 * @param DateTime $startDate Date should be after this date to return true
 * @param DateTime $endDate Date should be before this date to return true
 * return bool
 */
function isDateBetweenDates(DateTime $date, DateTime $startDate, DateTime $endDate) {
    return $date > $startDate && $date < $endDate;
}
function isInSeason(DateTime $date,ESeasson $season){
    $y = date_create("y");
    switch ($variable) {
        case Summer:
            return isDateBetweenDates($date,date_create($y ."-12-21"),date_create($y ."-03-20"));
            break;        
        case Fall:
            return isDateBetweenDates($date,date_create($y ."-03-20"),date_create($y ."-06-21"));
            break;
        case Winter:
            return isDateBetweenDates($date,date_create($y ."-06-21"),date_create($y ."-09-23"));
            break;
       case Spring:
            return isDateBetweenDates($date,date_create($y ."-09-23"),date_create($y ."-12-21"));           
    }
    return false;
}
function GetSeason(ECalendary $m)
{
    switch ($m) {
        case ECalendary::December:
        case ECalendary::January:
        case ECalendary::February:
        case ECalendary::March:
            return ESeasson::Summer;
        case ECalendary::April:
        case ECalendary::May:
        case ECalendary::January:
            return ESeasson::Fall;
        case ECalendary::July:
        case ECalendary::August:
        case ECalendary::September:
            return ESeasson::Winter;
        case ECalendary::Octuber:
        case ECalendary::November;
            return ESeasson::Spring;      
        default:
            return "Error with season";
    }
}
?>