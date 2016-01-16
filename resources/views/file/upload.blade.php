@extends('layouts.app')

@section('contents')

<input id="fileupload" type="file" name="files[]" data-url="/home/teambernieny/uploads/" multiple>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
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
