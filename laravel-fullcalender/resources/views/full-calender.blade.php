<!DOCTYPE html>
<html>
<head>
    <title>How to Use Fullcalendar in Laravel 8</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-3">
            <nav>
                <h1 class="text-center text-primary" style="margin: 20px">Course</h1> <hr>
                <section class="budget">Budget Section</section> <hr>
                <form>

                    <label>Program: </label> <br>
                    <select value="program">
                        <option value="ITP">
                            Intensive Training Program
                            <!-- ITP -->
                        </option>
                        <option value="STP">
                            Summer Training Program
                            <!-- STP -->
                        </option>
                    </select>

                    <br> <br>
                    <label>Intake: </label> <br>
                    <select value="intake">
                        <option value="ITP 2021/2022">
                            ITP 2021/2022
                        </option>
                        <option value="STP 2021/2022">
                            STP 2021/2022
                        </option>
                    </select>

                    <br> <br>
                    <label>Branch: </label> <br>
                    <select value="Branch">
                        <option value="Menia">
                            Menia
                        </option>
                    </select>

                    <br> <br>
                    <label>Track: </label> <br>
                    <select value="Track">
                        <option value="SWF">
                            Software Dev fundamentals
                        </option>
                    </select>


                    <p class="c1">Track Courses</p>
                    <section>
                        <div id="a" class="content" draggable="true" ondragstart="drag(event)">
                            <p>SS/ITP/100</p>
                            <p>
                                Interviewing Skills & C.V writing
                            </p>
                        </div>

                        <div id="b" class="content" draggable="true" ondragstart="drag(event)">
                            <p>FL/ITP/100</p>
                            <p>Freelancing</p>
                        </div>

                        <div id="c" class="content" draggable="true" ondragstart="drag(event)">
                            <p>GP/ITP/100</p>
                            <p>Graduation Project</p>
                        </div>


                    </section>
                </form>
            </nav>
        </div>
        <div class="col-9">
        <br />
        <h1 class="text-center text-primary"><u>Mohamed Saber's Calendar</u></h1>
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
