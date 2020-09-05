jQuery(document).ready(function($) {
    const _g_calendar = 'https://calendar.google.com/calendar/event?action=TEMPLATE';
    $('.g_calendar').datepicker({ dateFormat: 'yy-mm-dd' });

    $('.gCalendarLink').on('click', function(ev) {
        ev.preventDefault();
        let url = setGoogleUrlCalendar($(ev.target).closest('.g_calendar_container'));
        console.log(url);
        window.open(url, "_blank");
    });

    function setGoogleUrlCalendar($container) {
        let _url = _g_calendar;
        let $gCalendarContainer = $container;
        let ev_date = $gCalendarContainer.find('.g_calendar').first().datepicker('getDate');
        let location = $gCalendarContainer.find('.g_location').val();
        if (ev_date !== '') {
            let gFormatDate = (ev_date.toISOString()).replace(/\-/g, "").replace(/\:/g, "").split('.')[0] + 'Z';
            _url = _url + "&date=" + encodeURI(gFormatDate + "/" + gFormatDate);
            _url = _url + "&dates=" + encodeURI(gFormatDate + "/" + gFormatDate);
        }
        if (location !== '') {
            _url = _url + "&location=" + encodeURI(location);
        }
        $(this).closest('.g_calendar_container').find('.gCalendarLink').attr("href", _url)
        return _url;
    }

    $('#post-body').find('#title').attr('required', 'required');
});