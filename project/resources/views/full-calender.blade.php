
<!DOCTYPE html>
<html>
<head>
    <title>iti calendar</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
  
    /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
      background-color: #555;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      opacity: 0.8;
      position: fixed;
      bottom: 23px;
      right: 28px;
      width: 280px;
    }
    
    /* The popup form - hidden by default */
    .form-popup {
      display: none;
      position: fixed;
      bottom: 0;
      right: 15px;
      border: 3px solid #f1f1f1;
      z-index: 9;
    }
    
    /* Add styles to the form container */
    .form-container {
      max-width: 300px;
      padding: 10px;
      background-color: white;
    }
    
    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }
    
    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }
    
    /* Set a style for the submit/login button */
    .form-container .btn {
      background-color: #04AA6D;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      margin-bottom:10px;
      opacity: 0.8;
    }
    
    /* Add a red background color to the cancel button */
    .form-container .cancel {
      background-color: red;
    }
    
    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
      opacity: 1;
    }
    </style>

<script>
    //pop
function closeForm() {

  document.getElementById("myForm").style.display = "none";

} 

//pop
    var subjectObject = {

      "Q1": {

       "Software Fundmental": ["C", "OOP C++", "Network", "Operating Systems ","Cloud Computing ","Computer Networks ","Win & Linux"],

       "php": ["PHP", "Nodejs", "HTML5", "CSS3","Bootstrap", "UXUI design basics","MYSQL Database"],

       ".NET": ["C#", "ASP.Net","Angular Fundamentals","Java Script", "HTML5.0","Responsive Web Design", "Conditions"]  }

       ,

        "Q2": {

            ".NET": ["C#", "ASP.Net","Angular Fundamentals","Java Script", "HTML5.0","Responsive Web Design"]
        } ,

        "Q3": {

        ".NET": ["C#", "ASP.Net","Angular Fundamentals","Java Script", "HTML5.0","Responsive Web Design"],

        "Mearn": ["Mongo", "HTML5.0","Angular Fundamentals","Java Script", "css3","Responsive Web Design"]
    },
    "Q4": {
        "Software Fundmental": ["C", "OOP C++", "Network", "Operating Systems ","Cloud Computing ","Computer Networks ","Win & Linux"],

        ".NET": ["C#", "ASP.Net","Angular Fundamentals","Java Script", "HTML5.0","Responsive Web Design"],

        "Mearn": ["Mongo", "HTML5.0","Angular Fundamentals","Java Script", "css3","Responsive Web Design"]
}
                    }

    window.onload = function() {
      var subjectSel = document.getElementById("Branch");
      var topicSel = document.getElementById("Track");
      var chapterSel = document.getElementById("Track Courses");
      for (var x in subjectObject) {
        subjectSel.options[subjectSel.options.length] = new Option(x, x);
    }
    subjectSel.onchange = function() {

    chapterSel.length = 1;
    topicSel.length = 1;

        for (var y in subjectObject[this.value]) {
        topicSel.options[topicSel.options.length] = new Option(y, y);
        }
    }
    topicSel.onchange = function() {

    chapterSel.length = 1;

        var z = subjectObject[subjectSel.value][this.value];
        for (var i = 0; i < z.length; i++) {
        chapterSel.options[chapterSel.options.length] = new Option(z[i], z[i]);
        }
    }
    }


    </script>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
<!-- popup window -->
    <div class="form-popup" id="myForm">
        <div class="form-container">
          <h1>session</h1>
      
          <label for="instructor"><b>instructor:</b></label>
          <input type="text" id="ins" name="instructor">
      
          <label for="course"><b>course:</b></label>
          <input type="text" name="course" id ="course">
      
          <button type="button" class="btn">add</button>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </div>
      </div>
      <!-- popup window -->
<div class="container">
    <div class="row">
        <div class="col-3 bg-secondary text-white">
@yield('name')
        </div>
        <div class="col-9">
        <br />
       
        <h1 class="text-center text-white bg-secondary rounded-pill"> Calendar</h1>
        <br />
        <div id="calendar"></div>
        </div>
    </div>

</div>

<script>

$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:'/full-calender',
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
           // var title = prompt('Event Title:');
           var titl=document.getElementById("ins").value;
           var tit=document.getElementById("course").value;
           document.getElementById("myForm").style.display = "block";
           var title =titl+tit ;
          

            if(title)
            {
                var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    success:function(data)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Created Successfully");
                    }
                })
            }
        },
        editable:true,
        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },

        eventClick:function(event)
        {
            if(confirm("Are you sure you want to remove it?"))
            {
                var id = event.id;
                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        id:id,
                        type:"delete"
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Deleted Successfully");
                    }
                })
            }
        }
    });

});

</script>

</body>
</html>
