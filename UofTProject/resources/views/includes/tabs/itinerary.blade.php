
    <div class="container py-5">
            <div id="dynamic-itinerary-fieldset">
                <fieldset class="mb-3 fieldset-itinerary-template">
                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="itinerary_date-0" class="fw-bold">Date:</label>
                                <input type="text" class="form-control" id="itinerary_date-0" name="itinerary_date-0">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="itinerary_location-0" class="fw-bold">Location:</label>
                                <input type="text" class="form-control" id="itinerary_location-0" name="itinerary_location-0">
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="form-group">
                                <label for="itinerary_activity-0" class="fw-bold">Activity:</label>
                                <textarea class="form-control" id="itinerary_activity-0" rows="5" name="itinerary_activity-0" placeholder="Please enter here..."></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <button type="button" id="add-itinerary-button" style="background-color:blue" class="btn btn-primary">+ Add another row</button>
    </div>

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



