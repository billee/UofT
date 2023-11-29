    @php $n = -1; @endphp
    @if('view' == $pageMode)
        @foreach($application->applicationItineraries as $itinerary)
            @include('includes.tabs.itinerary-table', ['n' => ++$n])
        @endforeach
    @else
        @include('includes.tabs.itinerary-table', ['n' => ++$n])
    @endif



    <script type="text/javascript">
        $(document).ready(function() {
            var fieldsetCount = 1;

            $('#add-itinerary-button').click(function() {
                var newFieldset = $('.fieldset-itinerary-template').first().clone();
                newFieldset.find('input, textarea').each(function() {
                    var id = $(this).attr('id').split('-')[0];
                    $(this).attr('id', id + '-' + fieldsetCount);
                    $(this).attr('name', id + '-' + fieldsetCount);
                });
                $('#dynamic-itinerary-fieldset').append(newFieldset);
                fieldsetCount++;
            });
        });
    </script>



