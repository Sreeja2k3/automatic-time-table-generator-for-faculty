<?php 
include('../config.php');
include("timetablegen.php");
extract($_POST);

if (isset($generate) || isset($regenerate)) {
    $_GET['generated'] = "true"; 
} else {
    $_GET['generated'] = "";
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script>
function showSubject(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("subject").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "subject_ajax.php?id=" + str, true);
    xmlhttp.send();
}

function showSemester(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("semester").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "semester_ajax.php?id=" + str, true);
    xmlhttp.send();
}

function downloadTimetable() {
    setTimeout(function() {
        var timetable = document.getElementById('timetable');
        html2canvas(timetable, {
            useCORS: true,
            onrendered: function(canvas) {
                var link = document.createElement('a');
                link.download = 'timetable.png';
                link.href = canvas.toDataURL();
                link.click();
            }
        });
    }, 500); // 500ms delay
}
</script>

<div class="row">
<div class="col-sm-12">
<h2>Generate Time Table</h2>
<form method="POST" enctype="multipart/form-data">
  <table border="0" class="table">
    <tr>
      <td colspan="2"><?php echo @$err; ?></td>
    </tr>
    <tr>
      <th width="237" scope="row">Select Department</th>
      <td width="213">
        <select name="courseid" class="form-control" onchange="showSemester(this.value)" id="courseid">
          <option disabled selected>Select Department</option>
          <?php 
          $dep = mysqli_query($con,"select * from department");
          while ($dp = mysqli_fetch_array($dep)) {
              $dp_id = $dp[0];
              echo "<option value='$dp_id'>".$dp[1]."</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <th width="237" scope="row">Select Semester</th>
      <td width="213">
        <select name="s" id="semester" onchange="showSubject(this.value)" class="form-control">
          <option disabled selected>Select Semester</option>
        </select>
      </td>
    </tr>
    <tr>
      <th colspan="1" scope="row"></th>
      <td>
        <input type="submit" value="Generate Time Table" name="generate" class="btn btn-success" />
      </td>
    </tr>
    <?php
    if ($_GET['generated']) {
    ?>
    <tr>
      <td>
        <button type="button" class="btn btn-info" onclick="downloadTimetable()">Download Timetable</button>
      </td>
      <td class="text-right">
        <!-- Optional: Save or Regenerate buttons can go here -->
      </td>
    </tr>
    <?php
    }
    ?>
  </table>
</form>
</div>
</div>

<div id="timetable">
<?php 
if ($_GET['generated']) {
    // Define the weekdays and placeholders for lunch and break
    $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $lunchBreak = "LUNCH";  
    $breakTime = "BREAK";   

    // Fetch department details
    $query = "SELECT * FROM department WHERE department_id = $courseid";
    $que = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($que);
    $branch = $row['department_name'];

    // Fetch semester details
    $query = "SELECT * FROM semester WHERE sem_id = $s";
    $que = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($que);
    $semester = $row['semester_name'];

    // Displaying branch and semester info
    if ($branch && $semester) {
        echo "<div style='font-size: 32px'><b>".$branch." ".$semester." Semester</b></div><br>";
    }

    // Fetch the timetable from the database
    $weekTimeTable = generate_time_table($con, $courseid, $s);

    if ($weekTimeTable) {
        echo "<table border='1' class='table table-bordered'>";
        echo "<tr class='danger text-center'>
                <th class='text-center'>Days/Lecture</th>
                <th class='text-center'>Lecture 1<br>09:20-10:20</th>
                <th class='text-center'>Lecture 2<br>10:20-11:20</th>
                <th class='text-center'>Break<br>11:20-11:30</th>
                <th class='text-center'>Lecture 3<br>11:30-12:30</th>
                <th class='text-center'>Lunch<br>12:30-01:30</th>
                <th class='text-center'>Lecture 4<br>01:30-02:30</th>
                <th class='text-center'>Lecture 5<br>02:30-03:30</th>
              </tr>";

        for ($i = 0; $i < 6; $i++) {
            echo "<tr>";
            echo "<th class='danger text-center'>".$weekDays[$i]."</th>";

            $hasLab = false;

            echo "<td class='text-center'>".$weekTimeTable[$i][0]['subject_name']."</td>";

            if (isset($weekTimeTable[$i][1]['type']) && $weekTimeTable[$i][2]['type'] === 'Lab' && !$hasLab) {
                echo "<td colspan='3' class='text-center'>".$weekTimeTable[$i][1]['subject_name']." (Lab)</td>";
                $hasLab = true;
            } else {
                echo "<td class='text-center'>".$weekTimeTable[$i][1]['subject_name']."</td>";
                echo "<td class='text-center'><b>".$breakTime."</b></td>";
                echo "<td class='text-center'>".$weekTimeTable[$i][2]['subject_name']."</td>";
            }

            echo "<td class='text-center'><b>".$lunchBreak."</b></td>";

            if (isset($weekTimeTable[$i][4]['type']) && $weekTimeTable[$i][4]['type'] === 'Lab' && !$hasLab) {
                echo "<td colspan='2' class='text-center'>".$weekTimeTable[$i][3]['subject_name']." (Lab)</td>";
                $hasLab = true;
            } else {
                echo "<td class='text-center'>".$weekTimeTable[$i][4]['subject_name']."</td>";
                echo "<td class='text-center'>".$weekTimeTable[$i][5]['subject_name']."</td>";
            }

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div style='font-size: 28px'><b>Not enough data for selected course and semester.</b></div>";
    }
    
}

?>
</div>