   $("#btnSubmit").click(function(){
        console.log("test01");
        var username = document.getElementById('inputUsername').value;
        var password = document.getElementById('inputPassword').value;
        

        if (document.getElementById('radioStudent').checked) {
          category = document.getElementById('radioStudent').value;
        }else if (document.getElementById('radiolecturer').checked) {
          category = document.getElementById('radiolecturer').value;
        }

        var details = { "key" : "checkLogin",
                        "inputUsername" : username,
                        "inputPassword" : password,
                        "inputCategory" : category
                      };

        console.log("test");
        $.post("backEndPhp.php", {detailsObject: details}, function(result){
          console.log(result);
          if(result){
            alert("Successfully Login");
            if(result['KEY'] == 'student'){
               
              var studentId = result['User']['ID'];
              console.log(' User ID  ' + result['User']['ID']);
              sessionStorage.setItem('studentId', studentId);
              // alert("Done");
              // Please dircte it to Student Page
              window.location.replace("StudentPage.html");
            }
           
            if(result['KEY'] == 'lecturer'){
              var lecturerId = result['User']['ID'];
              console.log('User ID' + result['User']['ID']);
              sessionStorage.setItem('lecturerId', lecturerId);
              // alert("Done");  
              // Please dircte it to Lecturer Page
              window.location.replace("LecturerPage.html");
            }
          }else{
             alert("Invalid Login"); 
          }
        });
    });


  $("#studentPage").ready(function(){
    console.log("test02");
    var studentId = sessionStorage.getItem('studentId');

    console.log("Temp Student : " + studentId);

    var details = { "key" : "studentDetails",
                    "studentId" : studentId
                  };
    $.get('backEndPhp.php',{detailsObject: details},function(result){
          console.log(result);
          console.log(result['personal']['Student_Name'])
          $("#studentName").html(result['personal']['Student_Name']);
          $("#userName").html("Welcome  " + result['personal']['Student_Name']);
          $("#studentId").html(result['personal']['ID']);
          $("#lectureName").html(result['lecturer']['Lecturer_Name']);
          $("#sessionArea").html(result['session']['Details']);
          $("#sessionDate").html("Date : "+ result['session']['Date']);
          $("#sessionNumber").html("Session Number : " + result['session']['session_No']);
          $('#previousSession').attr("value", result['session']['session_No']);
          $('#beforeSession').attr("value", result['session']['session_No']);
    });
  });


  $("#lecturerPage").ready(function(){
    console.log("test03");
    var lecturerId = sessionStorage.getItem('lecturerId');

    var details = { "key" : "lecturerDetails",
                    "lecturerId" : lecturerId
                  };
    $.get('backEndPhp.php',{detailsObject: details},function(result){
          console.log(result);
          $("#userName").html("Welcome  " + result['personal']['Lecturer_Name']);
          $("#lecturerName").html(result['personal']['Lecturer_Name']);
          $("#lecturerId").html(result['personal']['ID']);

    });
  });

$("#findStudent").click(function(){
  console.log("test04");
  var studentId = document.getElementById('inputStudentID').value;
  var lecturerId = sessionStorage.getItem('lecturerId');


  console.log(studentId + " " + lecturerId);

  var details = { "key" : "searchStudent",
                  "studentId" : studentId,
                  "lecturerId" : lecturerId
                };
 $.get('backEndPhp.php',{detailsObject: details},function(result){
          console.log(result);
          if(result['studentDetails']){
            $("#inputStudentName").attr("value", result['studentDetails']['Student_Name']);
            $("#inputSessionEndTime").attr("value", result['sessionDetails']['end_Time']);
            $("#inputSessionStartTime").attr("value", result['sessionDetails']['start_Time']);
            $("#inputSessionDate").attr("value", result['sessionDetails']['Date']);
            $("#inputSessionNumber").attr("value", result['sessionDetails']['session_No']);
            $('#updateSession').attr("value", result['sessionDetails']['ID']);
           
          }else{
            alert("Student not Found / Invalid Stundet ID");
          }
    });
});

$("#updateSession").click(function(){
    console.log("test05");

    var studentId = document.getElementById('inputStudentID').value;
    var id = document.getElementById('updateSession').value;
    var lecturerId = sessionStorage.getItem('lecturerId');
    var startTime = document.getElementById('inputSessionStartTime').value;
    var endTime = document.getElementById('inputSessionEndTime').value;
    var date = document.getElementById('inputSessionDate').value;
    var sessionNumber = document.getElementById('inputSessionNumber').value;
    var task = document.getElementById('taskArea').value;


    var details = { "key" : "UpdateSession",
                    "ID" : id,
                    "studentId" : studentId,
                    "lecturerId" : lecturerId,
                    "startTime" : startTime,
                    "endTime" : endTime,
                    "date" : date,
                    "sessionNumber" : sessionNumber,
                    "task" : task
                  };

      // console.log(details);

  $.post('backEndPhp.php',{detailsObject: details},function(result){
          console.log(result);
          if(result == "success message"){
            alert("Successfully Updated");
          }else if(result == "error message"){
            alert("Sorry, Try Again");
          }
          
    });  
});


$("#logout").click(function(){
  console.log("test06")
  alert("Thanks, Successfully Logout")
  window.location.replace("Login_Page.html");
});


$("#previousSession").click(function(){
  console.log("test07");

  var studentId = sessionStorage.getItem('studentId');
  var sessionNumber = document.getElementById('previousSession').value;

  console.log(studentId + " " + sessionNumber);

  var details = { "key" : "previousSession",
                  "studentId" : studentId,
                  "sessionNumber" : sessionNumber
                };

  console.log("test08");
  $.get('backEndPhp.php',{detailsObject: details},function(result){
    console.log(result);
    if(result != "No Session Available"){
      $("#sessionArea").html(result['session']['Details']);
      $("#sessionDate").html("Date : "+ result['session']['Date']);
      $("#sessionNumber").html("Session Number : " + result['session']['session_No']);
      $('#previousSession').attr("value", result['session']['session_No']);
      $('#beforeSession').attr("value", result['session']['session_No']);

    }else{
      alert("No Available Sessions");
    }
   

  });
});


$("#beforeSession").click(function(){
  console.log("test09");

  var studentId = sessionStorage.getItem('studentId');
  var sessionNumber = document.getElementById('beforeSession').value;


  console.log(studentId + " " + sessionNumber);

  var details = { "key" : "beforeSession",
                  "studentId" : studentId,
                  "sessionNumber" : sessionNumber
                };

  $.get('backEndPhp.php',{detailsObject: details},function(result){
      console.log(result);
  });
});