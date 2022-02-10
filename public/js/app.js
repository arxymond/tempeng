$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function(){
    $('#theForm').on('submit', function(e){
        e.preventDefault();
        $.post(
            $(this).attr('action'),
            {
                'templateBody': $('#templateBody').val(),
                'templateYaml': $('#templateYaml').val()
            }
        ).done(function(res) {
            $('#output').html(res);
        });
        return false;
    });
});
