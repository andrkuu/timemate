<?php

$year = $_POST["year"];
$month = $_POST["month"];

$events = [
    "2020-04-05" => [
        "Matemaatika" => [
            "type" => "Kodutöö",
            "duration" => 5
        ]
    ],

    "2020-04-07" => [
        "Interaktsioonidisain" => [
            "type" => "Kodutöö",
            "duration" => 3
        ],

        "Java" => [
            "type" => "Kodutöö",
            "duration" => 5
        ]

    ],
];



// CSS classes
$css_cal = 'calendar';
$css_cal_row = 'calendar-row';
$css_cal_day_head = 'calendar-day-head';
$css_cal_day = 'calendar-day';
$css_cal_day_active = 'calendar-day-event-container';
$css_cal_day_number = 'day-number';
$css_cal_day_blank = 'calendar-day-np';
$css_cal_day_event = 'calendar-day-event';
$css_cal_event = 'calendar-event';
$css_cal_alert = "display-alert";


$headings = ['E', 'T', 'K', 'N', 'R', 'L', 'P'];


$calendar =
    "<table cellpadding='0' cellspacing='0' class='{$css_cal}'>" .
    "<tr class='{$css_cal_row}'>" .
    "<td class='{$css_cal_day_head}'>" .
    implode("</td><td class='{$css_cal_day_head}'>", $headings) .
    "</td>" .
    "</tr>";


$running_day = date('N', mktime(0, 0, 0, $month, 1, $year));
$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));


$calendar .= "<tr class='{$css_cal_row}'>";

$StartDate= date("Y-F-d",strtotime($year."-".$month."-1"));

for ($i=$running_day-1; $i>=1; $i--) {

    $prev = date('d', strtotime(-$i . ' day', strtotime($StartDate))) . "<br />";
    $calendar .= "<td class='{$css_cal_day_blank}'> <div class=\"day-number\">".$prev."</div> </td>";
}



for ($day = 1; $day <= $days_in_month; $day++) {

    $cur_date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
    $draw_event = false;
    if (isset($events) && isset($events[$cur_date])) {
        $draw_event = true;
    }

    $calendar .= $draw_event ?
        "<td onclick='tdclick(event)' class='{$css_cal_day_active}'>" :
        "<td onclick='tdclick(event)' class='{$css_cal_day}'>";


    $todayMarker = "";

    if($day == date("d") && intval($month) == date("m") && intval($year) == date("Y")){
        $todayMarker = "style=\"color:#b71234\"";
    }
    else{
        $todayMarker = "";
    }

    $calendar .= "<div onclick='event.stopPropagation();' ".$todayMarker."class='{$css_cal_day_number}'>" . $day . "</div>";
    $calendar .= $draw_event ?
        "<div class='{$css_cal_alert}'></div>" :
        "";

    if ($draw_event) {

        if (array_key_exists($cur_date,$events)){

            $temp = "";

            foreach (array_keys($events[$cur_date]) as $key => $value) {
                $temp.= "<tr><td>".$value."</td>";
                $temp.= "<td>".$events[$cur_date][$value]["type"]."</td>";
                $temp.= "<td>".$events[$cur_date][$value]["duration"]."h</td></tr>";
            }

            $calendar .=

                "<div hidden id='hidden_text'><table class='popupasi'><tr id='kõik'><th id='aine' class='popuptext'>Aine</th><th id='õppetegevus' class='popuptext'>Õppetegevus</th><th id='kestvus' class='popuptext'>kestvus</th></tr>".$temp.


                "</table></div>";

        }
        else{
            $calendar .=
                "<div class='{$css_cal_event}'>" .
                "<p>" .

                $events[$cur_date][array_values($events)[0]] .
                "</p>" .
                "</div>";
        }


    }


    $calendar .= "</td>";

    if ($running_day == 7) {
        $calendar .= "</tr>";
        if (($day + 1) <= $days_in_month) {
            $calendar .= "<tr class='{$css_cal_row}'>";
        }
        $running_day = 1;
    }
    else {
        $running_day++;
    }

}


$next_day = 1;
if ($running_day != 1) {
    for ($x = $running_day; $x <= 7; $x++) {

        $calendar .= "<td class='{$css_cal_day_blank}'> <div class=\"day-number\">".$next_day."</div> </td>";
        $next_day++;
    }
}

$calendar .= "</tr>";

$calendar .= '</table>';

echo $calendar;
