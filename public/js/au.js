// Clears projection and cumulative fields when box is hidden
var checkbox = document.getElementById("reveal-cumulative");
var checkbox = document.getElementById("reveal-projection");

function cumulativeClear() {
  if (checkbox.checked == true) {
    pastgpa.value = '';
    credtaken.value = '';
    calcAll();
  } else {
    pastgpa.value = '';
    credtaken.value = '';
    calcAll();
  }
};

function projectionClear() {
  if (checkbox.checked == true) {
    credleft.value = '';
    targetgpa.value = '';
    calcAll();
  } else {
    targetgpa.value = '';
    credleft.value = '';
    $("#proj_box").hide();
    calcAll();
  }
};

// Resets term form
function resetform() {
  document.getElementById("myform").reset();
  $("#show_box").text("0.00");
  $("#cred_box").text("0.00");
  $("#proj_box").hide();
  $(".grds").toggleClass("show", false);
  var gpa = 0;
  var pastgpa = 0;
  var credtaken = 0;
  var credithours = 5;
  var grade = 5;
}


// Main function when page is opened
$(document).ready(function() {

  // Adding a new row for the term calculator
  var rowid = 1;
  var rowlimit = 1;

  // Automatically appends 5 courses
  for (rowid = 1; rowid < 5; rowid++) {
    $('#t1').append('<tr id="row' + rowid + '" class="item"><td class="text-center"><div class = "wrapper"><button type="button" name="remove" id="' + rowid + '" class="btn_remove btn">X</button></div></td><td><input name="course" class="form-control" value="" placeholder="Class Name"/></td><td><select id="currentgrade" class="currentgrade amount form-control" ><option id="def1" value="default">Grade</option><option value="4">A</option><option value="3">B</option><option value="2">C</option><option value="1">D</option><option value="0">F</option><option value="0">NCR</option><option value="10">I</option><option value="10">W</option><option value="10">X</option><option value="10">CR</option></select></td><td><select id="credithours" name="credithours" class="amount form-control" type="dropdown"><option id="def" value="default" selected>Hours</option><option value = ".5">.5</option><option value = "1">1</option><option value = "3">3</option><option value = "4">4</option></select></td><td style="text-align:center;"><input type="checkbox" class="btn_repeat" id="' + rowid + '"><select id="g' + rowid + '" class="grds"></select></td><td><input name="total" class="total form-control" id="total1" value="" readonly="readonly" /></td>');
  }

  // Function for adding a row
  $('.addRow').click(function() {
    // Limits the amount of rows that can be added to 8
    if (rowlimit < 4) {
      rowid++;
      rowlimit++;
      var credithours = 0;
      $('#t1').append('<tr id="row' + rowid + '" class="item"><td class="text-center"><div class = "wrapper"><button type="button" name="remove" id="' + rowid + '" class="btn_remove btn">X</button></div></td><td><input name="course" class="form-control" value="" placeholder="Class Name"/></td><td><select id="currentgrade" class="currentgrade amount form-control" ><option id="def1" value="default">Grade</option><option value="4">A</option><option value="3">B</option><option value="2">C</option><option value="1">D</option><option value="0">F</option><option value="0">NCR</option><option value="10">I</option><option value="10">W</option><option value="10">X</option><option value="10">CR</option></select></td><td><select id="credithours" name="credithours" class="amount form-control" type="dropdown"><option id="def" value="default" selected>Hours</option><option value = ".5">.5</option><option value = "1">1</option><option value = "3">3</option><option value = "4">4</option></select></td><td style="text-align:center;"><input type="checkbox" class="btn_repeat" id="' + rowid + '"><select id="g' + rowid + '" class="grds"></select></td><td><input name="total" class="total form-control" id="total1" value="" readonly="readonly" /></td>');
    } else {
      alert("Maximum course load is limited to 8.");
    }
  });

  // Button to display or hide repeat course dropdown
  $(document).on('click', '.btn_repeat', function() {
    var btnid = $(this).attr("id");
    $("#g" + btnid + '').toggleClass('show');
    $(this).toggleClass("btn_pressed");
    var $select = $("#g" + btnid);
    for (i = 1; i <= 1; i++) {
      $select.empty();
      $select.append($('<option></option>').val("").html("Previous Grade"))
      $select.append($('<option></option>').val("C").html("C"));
      $select.append($('<option></option>').val("D").html("D"))
      $select.append($('<option></option>').val("F").html("F"))
      $select.append($('<option></option>').val("NCR").html("NCR"))
      $select.append($('<option></option>').val("CR").html("CR"))
      $select.append($('<option></option>').val("W").html("W"))
      $select.append($('<option></option>').val("X").html("X"))
      $select.append($('<option></option>').val("I").html("I"))
    }
  });

  // Removing a specific row for term calculator
  $(document).on('click', '.btn_remove', function() {
    var button_id = $(this).attr("id");
    $('#row' + button_id + '').remove();
    rowlimit--;
    calcAll();
  });

  // Event triggers for the main functions
  $(document).on("change", ".amount", calcAll);
  $(document).on("keyup", ".amt", calcCourse);
});

// Function for the term calculator
function calcAll() {
  // Variables for term calculation
  var gpa = 0;
  var grade = 5;
  var credithours = 5;

  // Variables for the cumulative calculation
  var pastgradeval = 0;
  var pastgpa = 0;
  var credtaken = 0;

  // Variables for the projection calculation
  var credleft = 0;
  var targetgpa = 0;
  var totcreds = 0;

  // Variables for output
  var rowTotal = 1;
  var totalcredits = 0;

  if (!isNaN(parseFloat($('#pastgpa').val()))) {
    pastgpa = parseFloat($('#pastgpa').val());
  }

  if (!isNaN(parseFloat($('#credtaken').val()))) {
    credtaken = parseFloat($('#credtaken').val());
  }

  if (!isNaN(parseFloat($('#targetgpa').val()))) {
    targetgpa = parseFloat($('#targetgpa').val());
  }
  if (!isNaN(parseFloat($('#credleft').val()))) {
    credleft = parseFloat($('#credleft').val());
  }

  $(".item").each(function() {
    if (!isNaN(parseFloat($(this).find("#currentgrade").val()))) {
      grade = parseFloat($(this).find("#currentgrade").val());
    }
    if (!isNaN(parseFloat($(this).find("#credithours").val()))) {
      credithours = parseFloat($(this).find("#credithours").val());
    }

    if (grade == 5 || credithours == 5) {
      $(this).find(".total").val("");
    }

    if (grade == 10) {
      $(this).find(".total").val("Not used in calculation.");
      credithours = 5;
      grade = 5;
    }

    if (grade !== 5 && credithours !== 5) {
      if (credtaken == 0 && pastgpa == 0 || credtaken == "boo") {
        totalcredits += credithours;
      } else {
        totalcredits += (credithours + credtaken);
        pastgradeval = pastgpa * credtaken;
        credtaken = "boo";
      }
      rowTotal = grade * credithours;
      $(this).find(".total").val(rowTotal.toFixed(2));
      credithours = 5;
      grade = 5;
    }
  });

  // Calculates the totals and GPA
  var sum = 0;
  $(".total").each(function() {
    if (!isNaN(this.value) && this.value.length != 0) {

      //  Prevents cumulative credits being added for each new row
      if (pastgpa != "stop") {
        sum += parseFloat(this.value) + pastgradeval;
        gpa = sum / totalcredits;
        pastgpa = "stop";
      } else {
        sum += parseFloat(this.value);
        gpa = sum / totalcredits;
      }
    }
  });

  // Display the calculated GPA
  if (grade == "x" || credithours == "x") {
    $("#show_box").text(" 0.00");
  } else {
    $("#show_box").text(gpa.toFixed(2));
    $("#cred_box").text(totalcredits.toFixed(2));
  }

  // Projection calculation
  if (targetgpa > 0) {
    totcreds += totalcredits + credleft;
    projectedgradeval = totcreds * targetgpa;
    currentgradeval = gpa * totalcredits;
    target = targetgpa * credleft;
    achievedgoal = (projectedgradeval - currentgradeval) / credleft;

    // Changes output depending on necessary GPA
    if (credleft !== 0 && targetgpa !== null && totalcredits !== 0) {
      $("#proj_box").show();
      if (achievedgoal.toFixed(2) <= 4.0 && achievedgoal.toFixed(2) > 0) {
        if (achievedgoal.toFixed(2) == gpa.toFixed(2)) {
          $("#proj_box").text("To achieve a GPA of " + achievedgoal.toFixed(2) + " you need to maintain your current GPA.  Keep it up!");
          proj_box.style.background = '#93C572';
          proj_box.style.borderColor = '#00467f';
        } else {
          $("#proj_box").text("To achieve a GPA of " + targetgpa.toFixed(2) + " you need to maintain a GPA of " + achievedgoal.toFixed(2));
          proj_box.style.background = '#93C572';
          proj_box.style.borderColor = '#00467f';
        }
      } else if (achievedgoal.toFixed(2) > 4) {
        $("#proj_box").text("It is not possible to reach a GPA of " + targetgpa.toFixed(2) + ". You would need a GPA of " + achievedgoal.toFixed(2) + ".");
        proj_box.style.background = '#e6adad';
        proj_box.style.borderColor = '#00467f';
      } else if (achievedgoal.toFixed(2) < 0) {
        $("#proj_box").text("It is not possible to lower your GPA that much.");
      } else {
        $("#proj_box").text("Something went wrong.");
      }
    }
  }
}

// Course Calculator Functions

$("#err_box").hide(); // Hides the weight warning by default

// Resets course form
function resetCourseForm() {
  document.getElementById("courseForm").reset();
  $("#course_box").text("0.00");
  $("#points_box").text("0.00");
  $("#err_box").hide();
  tot, points, weight, totalpoints, courseTotal, totweight, final = 0;
  ctrl = 6;
}

// Adding a new row
var courseRow = 5;
$('.addRowCourse').click(function() {

  // Limits the amount of rows that can be added to 10
  if (courseRow < 14) {
    courseRow++;
    $('#tcourse').append('<tr id="row' + courseRow + '" class="assignments"><td class="text-center"><div class="wrapper"><button type="button" name="remove" id="' + courseRow + '" class="crs_remove btn">X</button></div></td><td><input class="form-control" name="assignment" id="assignment" placeholder="Assignment Type"></td><td><input name="points" class="points amt form-control" value="" /></td><td><input name="totalpoints" class="totalpoints amt form-control" value="" /></td><td><input name="weight" class="weight amt form-control" value="" /></td><td><input name="courseTotal" class="courseTotal form-control" id="courseTotal1" value="" readonly="readonly" /></td>');
  } else {
    alert("Maximum amount is limited to 10.");
  }
});

// Removing a specific row
$(document).on('click', '.crs_remove', function() {
  var rmv_id = $(this).attr("id");
  $('#row' + rmv_id + '').remove();
  courseRow--;
  calcCourse();
});

function calcCourse() {
  var tot = 0;
  var ctrl = 6;
  var points = 0;
  var weight = 0;
  var totweight = 0;
  var totalpoints = 0;
  var courseTotal = 0;

  $(".assignments").each(function() {
    if (!isNaN(parseFloat($(this).find(".points").val()))) {
      points += parseFloat($(this).find(".points").val());
    }
    if (!isNaN(parseFloat($(this).find(".totalpoints").val()))) {
      totalpoints += parseFloat($(this).find(".totalpoints").val());
    }
    if (!isNaN(parseFloat($(this).find(".weight").val()))) {
      weight = parseFloat($(this).find(".weight").val());
      totweight += weight;
      ctrl = 5;
    }
    if (ctrl == 6) {
      $(this).find(".courseTotal").val("");
    } else {
      ctrl = 6;
      tot = (points / totalpoints) * weight / 100;
      $(this).find(".courseTotal").val(tot.toFixed(2));
    }

  });

  // Sums the weighted grade then sets it to a percentage
  var summ = 0;
  $(".courseTotal").each(function() {
    if (!isNaN(this.value) && this.value.length != 0 && weight != false) {
      summ += parseFloat(this.value);
      final = summ * 100;
    }
  });

  // Display the calculated course grade
  if (ctrl == 5) {
    $("#course_box").text("");
  } else if (totweight > 100) {
    $("#err_box").show();
    $("#course_box").text("0.0");
  } else {
    $("#course_box").text(final.toFixed(2) + "%");
    $("#err_box").hide();
    $("#points_box").text(points.toFixed(2) + "/" + totalpoints.toFixed(2));
  }
}
