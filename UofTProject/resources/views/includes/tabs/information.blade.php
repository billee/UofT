    @php $n = -1; @endphp
    @if('view' == $pageMode)
        @foreach($application->applicationInfos as $info)
            @include('includes.tabs.information-table', ['n' => ++$n])
        @endforeach
    @else
        @include('includes.tabs.information-table', ['n' => ++$n])
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            var fieldsetCount = 1;

            $('#add-button').click(function() {
                var newFieldset = $('.fieldset-template').first().clone();
                newFieldset.find('input').val('');
                newFieldset.find('input').each(function() {
                    var id = $(this).attr('id').split('-')[0];
                    $(this).attr('id', id + '-' + fieldsetCount);
                    if ($(this).attr('type') === 'text') {
                        $(this).attr('name', id + '-' + fieldsetCount);
                    } else if ($(this).attr('type') === 'radio') {
                        $(this).attr('name', 'status-' + fieldsetCount);
                    }
                });
                $('#dynamic-fieldset').append(newFieldset);
                fieldsetCount++;
            });
        });
    </script>



