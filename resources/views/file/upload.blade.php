@extends('layouts.app')

@section('contents')

<input id="fileupload" type="file" name="files[]" data-url="/server/php/" multiple>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'html',
        add: function (e, data) {
            data.context = $('<p/>').text('Uploading...').appendTo(document.body);
            data.submit();
        },
        done: function (e, data) {
            data.context.text('Upload finished.');
        }
    });
});
</script>
@stop
