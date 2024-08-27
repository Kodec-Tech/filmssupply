<?php
// Names
//Gmail app password; lawhkqiqjwxapbos
define("BANKNAME", "Filmsupply");
define("SENDER", "Filmsupply");
define("EMAIL", "filmsupply@gmail.com"); 

define("PASSWORD", "vnydfqusdvmvjaxj");
define("ADDRESS", "5240 Wead Park Rd, Phoenix");
define("MOBILENO", "+16952312678");
define("LOCATION_CORDINATE", "https://www.google.com/maps/place/United+Bank+For+Africa+-+ATM/@9.0512931,7.4589204,14z/data=!3m1!5s0x104e0ba51d5787b7:0xc76bee273c6ce205!4m10!1m3!2m2!1sATMs!6e2!3m5!1s0x104e0ba4fe6aaaab:0xdaa12809e87c98f1!8m2!3d9.0550646!4d7.4895426!15sCgRBVE1zkgEDYXRt4AEA");

define('WebsitePath',    __DIR__);


//custom mail 
define("CUSTOM_EMAIL", "contact@filmssupply.com");



/**
 * Get the number of days ago from a given date.
 *
 * @param string $dateString The date in 'YYYY-MM-DD' format.
 *
 * @return string A string indicating the number of days ago.
 */
function DaysAgo($dateString) {
    // Create a DateTime object for the input date
    $inputDate = new DateTime($dateString);

    // Get the current date as a DateTime object
    $currentDate = new DateTime();

    // Calculate the difference in days
    $interval = $currentDate->diff($inputDate);
    $daysAgo = $interval->days;

    if($daysAgo < 1) {
        return "Today ";
    }
    return $daysAgo." Days Ago";
}


/**
 * Get the number of days between two dates.
 *
 * @param string $startDate The start date in 'YYYY-MM-DD' format.
 * @param string $endDate The end date in 'YYYY-MM-DD' format.
 *
 * @return int The number of days between the two dates.
 */
function getDaysBetweenDates($startDate, $endDate) {
    $startDateTime = new DateTime($startDate);
    $endDateTime = new DateTime($endDate);

    $interval = $startDateTime->diff($endDateTime);

    return $interval->days;
}


