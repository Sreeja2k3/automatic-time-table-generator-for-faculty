<?php

function generate_time_table($con, $courseid, $s){

    $query = "SELECT * FROM subject WHERE department_id = $courseid AND sem_id = $s";
    $que = mysqli_query($con, $query);
    $rows = mysqli_num_rows($que);

    if($rows != 0){

        $subjects = array();
        
        // Fetch all subjects
        while($row = mysqli_fetch_assoc($que)){
            array_push($subjects, $row);
        }

        $weekTimeTable = array();
        $days = 6;  // Total days (Monday to Saturday)
        $periods = 7;  // Total periods per day
        
        for($i = 0; $i < $days; $i++){

            $dayTimeTable = array();
            shuffle($subjects);  // Shuffle the subjects at the start of each day
            $pointer = 0;  // Pointer to track current subject

            for($j = 0; $j < $periods; $j++){

                if ($pointer >= count($subjects)) {
                    $pointer = 0;  // Reset pointer if all subjects are used
                }

                $subject = $subjects[$pointer];

                if ($subject['lecture_per_week'] > 0) {
                    // Assign labs (they take 2 consecutive periods)
                    if($subject['type'] === "Lab" && ($j < $periods - 1)) {
                        array_push($dayTimeTable, $subject);  // Assign lab in this period
                        array_push($dayTimeTable, $subject);  // Assign lab in the next period
                        $subject['lecture_per_week'] -= 2;  // Decrease 2 periods for labs
                        $j++;  // Skip the next period as it's already taken by lab
                    }
                    // Assign theory
                    else if($subject['type'] === "Theory") {
                        array_push($dayTimeTable, $subject);
                        $subject['lecture_per_week']--;  // Decrease 1 period for theory
                    }
                } else {
                    // If the subject has no more lectures left, place an empty slot
                    array_push($dayTimeTable, "Empty");
                }

                $pointer++;  // Move to the next subject
            }

            array_push($weekTimeTable, $dayTimeTable);
        }

        return $weekTimeTable;
    
    } else {
        return false;  // No subjects found for the given course and semester
    }
}

$csv_string = "Day,Period,Subject\n";
foreach ($weekTimeTable as $day => $dayTimeTable) {
    foreach ($dayTimeTable as $period => $subject) {
        if ($subject === "Empty") {
            $subject_name = "Empty";
        } else {
            $subject_name = $subject['name'];
        }
        $csv_string .= "$day,$period,$subject_name\n";
    }
}


?>

