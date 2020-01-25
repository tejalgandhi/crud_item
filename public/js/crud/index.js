$('#search').on('keyup',function() {
    $value = $(this).val();
    debugger
    $.ajax({
        type: 'get',
        url: '/laravel-crud/search',
        data: $value,
        success: function (data) {
            $('tbody').html(data);
        }
    });
});
