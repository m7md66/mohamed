
<!DOCTYPE html>
<html>
<head>
    <title>iti calendar</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<script>

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




<div class="container">
    <div class="row">
        <div class="col-3 bg-secondary text-white">
            <nav>
                <img src="/images/iti-logo.png" alt="itilogo" height="80px" width="100px">
                <h1 class="text-center bg-danger text-white rounded-pill" style="margin: 20px">Course</h1> <hr>
                <section class="text-center"><b>Budget Section</b></section> <hr>
                <div class="btn-group">
                <form>

                    <label><b>Program: </b></label> <br>
                    <select class="form-control-plaintext text-white" value="program">
                        <option class="bg-secondary" value="ITP">
                            Intensive Training Program
                            <!-- ITP -->
                        </option>
                        <option class="bg-secondary" value="STP">
                            Summer Training Program
                            <!-- STP -->
                        </option>
                    </select>

                    <br>
                    <label><b>Branch: </b></label> <br>
                    <select value="intake" class="form-control-plaintext text-white">
                        <option selected class="bg-secondary" value="ITP 2021/2022">
                            Minia
                        </option>
                    </select>

                    <br>

<form name="form1" id="form1" action="/action_page.php">
    <label><b>Intake: </b></label> <br>
    <select name="Branch" id="Branch" class="bg-secondary form-control-plaintext text-white">
        <option value="" selected="selected">Select Quarter</option>
    </select>
     <br>
    <label><b>Track: </b></label> <br>
    <select name="Track" id="Track" class="bg-secondary form-control-plaintext text-white">
        <option value="" selected="selected">Select Track </option>
     </select>
     <br>
    <label><b>Track Courses: </b></label> <br>
    <select name="Track Courses" id="Track Courses" size="5" aria-label="size 3 select example" class=" bg-secondary form-control-plaintext text-white">
         <option value="" selected="selected"> Select Course</option>
     </select>
     <br>
     {{-- <input type="submit" value="Submit" >   --}}
     </form>



                </form>
            </nav>
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
            var title = prompt('Event Title:');

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
