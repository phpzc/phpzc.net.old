@extends('admin.layouts.main')

@section('before_tail')
    <!--
    <link rel="stylesheet" href="{{ CUBE('css/libs/fullcalendar.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ CUBE('css/libs/fullcalendar.print.css') }}" type="text/css" media="print" />
    <link rel="stylesheet" href="{{ CUBE('css/compiled/calendar.css') }}" type="text/css" media="screen" />
    -->
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

    <!--
    <script src="{{ CUBE('js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ CUBE('js/fullcalendar.min.js') }}"></script>
    -->
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
                prev: '<i class="fa fa-chevron-left"></i>',
                next: '<i class="fa fa-chevron-right"></i>'
            },

            //ajax 设置数据来源
            events:function(start,end,callback){

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