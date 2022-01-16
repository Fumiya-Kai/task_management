$(function() {
    $('body').on('click', '.report-data', function () {
        window.location = 'http://localhost:9000/report/' + $(this).data('reportId');
    });
});