<?php
/**
 * Returns the calendar's html for the given year and month.
 *
 * @param $year (Integer) The year, e.g. 2015.
 * @param $month (Integer) The month, e.g. 7.
 * @param $events (Array) An array of events where the key is the day's date
 * in the format "Y-m-d", the value is an array with 'text' and 'link'.
 * @return (String) The calendar's html.
 */
function build_html_calendar($year, $month, $events = null) {

    // CSS classes
    $css_cal = 'calendar';
    $css_cal_row = 'calendar-row';
    $css_cal_day_head = 'calendar-day-head';
    $css_cal_day = 'calendar-day';
    $css_cal_day_number = 'day-number';
    $css_cal_day_blank = 'calendar-day-np';
    $css_cal_day_event = 'calendar-day-event';
    $css_cal_event = 'calendar-event';


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

    for ($x = 1; $x < $running_day; $x++) {
        $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
    }

    for ($day = 1; $day <= $days_in_month; $day++) {

        $cur_date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
        $draw_event = false;
        if (isset($events) && isset($events[$cur_date])) {
            $draw_event = true;
        }

        $calendar .= $draw_event ?
            "<td class='{$css_cal_day} {$css_cal_day_event}'>" :
            "<td class='{$css_cal_day}'>";

        $calendar .= "<div class='{$css_cal_day_number}'>" . $day . "</div>";

        if ($draw_event) {
            $calendar .=
                "<div class='{$css_cal_event}'>" .
                "<a href='{$events[$cur_date]['href']}'>" .
                $events[$cur_date]['text'] .
                "</a>" .
                "</div>";
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

    if ($running_day != 1) {
        for ($x = $running_day; $x <= 7; $x++) {
            $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
        }
    }

    $calendar .= "</tr>";

    $calendar .= '</table>';

    return $calendar;
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="kalender.css">
    <title>Kalender</title>

  </head>
  <body>
    <?php include('nav-bar.php'); ?>
    <div class="links">
        <a href="statistika.php" class="lingid"> Statistika</a>
        <a href="aine.php" class="lingid" >Aine</a>
        <a href="kalender.php" class="selectedLink">Kalender</a>
        <a href="seaded.php" class="lingid"> Seaded</a>
    </div>

    <?php
    $events = [
        '2020-04-05' => [
            'text' => "An event for the 5 july 2015",
            'href' => "http://example.com/link/to/event"
        ],
        '2020-04-23' => [
            'text' => "An event for the 23 july 2015",
            'href' => "/path/to/event"
        ],
    ];

    echo build_html_calendar(2020, 4,$events);



    ?>
    <div class="kalender">
        <div class="month">
            <ul>
                <li class="prev">&#10094;</li>
                <li class="next">&#10095;</li>
                <li>
                    Aprill<br>
                    <span style="font-size:18px">2020</span>
                </li>
            </ul>
        </div>

        <ul class="weekdays">
            <li>Mo</li>
            <li>Tu</li>
            <li>We</li>
            <li>Th</li>
            <li>Fr</li>
            <li>Sa</li>
            <li>Su</li>
        </ul>

        <ul class="days">
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
            <li>6</li>
            <li>7</li>
            <li>8</li>
            <li><span class="active">9</span></li>
            <li>10</li>
            <li>11</li>
            <li>12</li>
            <li>13</li>
            <li>14</li>
            <li>15</li>
            <li>16</li>
            <li>17</li>
            <li>18</li>
            <li>19</li>
            <li>20</li>
            <li>21</li>
            <li>22</li>
            <li>23</li>
            <li>24</li>
            <li>25</li>
            <li>26</li>
            <li>27</li>
            <li>28</li>
            <li>29</li>
            <li>30</li>
            <li>31</li>
        </ul></div>
  </body>
</html>