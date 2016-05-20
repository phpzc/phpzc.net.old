@extends('admin.layouts.main')

@section('before_head')

@endsection

@section('content')
    <div class="row-fluid">
        <div class="span8">
            <div class="box color_13 paint_hover">
                <div class="title">
                    <h4> <span>Calendar</span> </h4>
                </div>
                <div class="content top ">
                    <div id='calendar'> </div>
                </div>
            </div>
            <!-- End .box -->

        </div>
    </div>

@endsection

@section('after')
        <!-- Full Calendar -->
<script language="javascript" type="text/javascript" src="{{ WIN8('js/plugins/full-calendar/fullcalendar.min.js') }}"></script>

<script>
    $(document).ready(function() {

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                            true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            editable: false,
            droppable:false,
            /*
             events: [
             {
             title: 'All Day Event',
             start: new Date(y, m, 1)
             },
             {
             title: 'Click for PixelGrade',
             start: new Date(y, m, 28),
             end: new Date(y, m, 29),
             url: 'http://pixelgrade.com/'
             }
             ]
             */
            events:function(start, end, callback)
            {
                console.log(start.getTime()) //每次全部渲染 会触发
                console.log(end.getTime())

                $.get('/admin/articles/month',{start:start.getTime(),end:end.getTime()},function(data){

                    var _events=[];
                    for(var i=0;i<data.data.length;i++){
                        _events[i] = {
                          title:data.data[i].title,
                            start: new Date(data.data[i].year,data.data[i].month,data.data[i].day),
                        };
                    }
                    callback(_events)
                },'json');

            }
        });

    })

</script>

@endsection