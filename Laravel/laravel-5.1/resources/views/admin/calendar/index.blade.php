@extends('admin.layouts.main')

@section('head')

    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="{{ ADMIN('plugins/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ ADMIN('plugins/fullcalendar/fullcalendar.print.css') }}" media="print">

@endsection



@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Calendar
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Calendar</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            </div>

        </section>

    </div>

@endsection

@section('after')

    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ ADMIN('plugins/fullcalendar/fullcalendar.min.js') }}"></script>


<script>
    $(document).ready(function() {

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },

            selectable: false,
            selectHelper: false,
            select: function(start, end, allDay) {
                /*
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
                */
                calendar.fullCalendar('unselect');

            },
            editable: false,
            droppable:false,
            buttonText: {
                prev: 'prev',
                next: 'next'
            },

            //ajax 设置数据来源
            events:function(start,end,timezone, callback){

                start = new Date(start);
                end = new Date(end);

                $.get('/admin/articles/month',{start:start.getTime(),end:end.getTime()},function(data){

                    if(data.data.length > 0)
                    {

                        var _events=[];

                        for(var i=0;i<data.data.length;i++)
                        {
                            var d = data.data[i];
                            _events[i] = {
                                title:d.title,
                                start:new Date(d.year,d.month-1,d.day),
                                url:d.url,
                            }
                        }

                        callback(_events)
                    }
                },'json');
            }
        {{-- 死的数据来源
            [
                @foreach ($data as $article)
                {
                    title: '{{ $article['title'] }}',
                    start: new Date({{ $article['year'] }},{{ $article['month']-1 }}, {{ $article['day'] }}),
                    url:'{{ $article['url'] }}',
                },
                @endforeach

            ],
        --}}

        });

    })

</script>

@endsection