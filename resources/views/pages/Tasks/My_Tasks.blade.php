@extends('layouts.master')


@section('title')
    {{ trans('main-trans.My_Tasks') }}

@endsection
@section('PageTitle')
    {{ trans('main-trans.My_Tasks') }}
@endsection
@section('content')

       <div>

        {{ trans('main-trans.Select_Language') }} :
        <select id='locale-selector'></select>

      </div>
      <br>
      <br>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div id="calendar"></div>
        </div>
    </div>
<br>
<br>
<br>
<br>

@endsection

@section('js')

<script src="{{URL::asset('assets/js/main.min.js')}}"></script>
<script src="{{URL::asset('assets/js/locales-all.min.js')}}"></script>

<script>


    document.addEventListener('DOMContentLoaded', function() {
      var initialLocaleCode = 'en';
      var localeSelectorEl = document.getElementById('locale-selector');
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
        initialDate: new Date(),
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
        selectable: true,
        locale: initialLocaleCode,
        eventSources:
                // your event source
                {
                url: 'getTasks', // use the `url` property
                textColor: 'white'  // an option!
                },
                eventRender: function (event, element, view) {
                element.find('.fc-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 10px">' + event.description + '</span></div>');
},

// any other sources...

      });

      calendar.render();

      calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
      var optionEl = document.createElement('option');
      optionEl.value = localeCode;
      optionEl.selected = localeCode == initialLocaleCode;
      optionEl.innerText = localeCode;
      localeSelectorEl.appendChild(optionEl);
    });

    // when the selected option changes, dynamically change the calendar option
    localeSelectorEl.addEventListener('change', function() {
      if (this.value) {
        calendar.setOption('locale', this.value);
      }
    });
    });



</script>
@endsection
<!--======
