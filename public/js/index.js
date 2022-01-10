$(function() {
    $('body').on('click', '.target-data', function () {
        window.location = 'http://localhost:9000/target/' + $(this).data('targetId');
    });
});