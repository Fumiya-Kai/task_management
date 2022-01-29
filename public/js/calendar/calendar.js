$(function() {
    $('body').on('click', '.calendar-cell', function () {
        window.location = 'http://localhost:9000/calendar/' + $(this).data('date');
    })
})