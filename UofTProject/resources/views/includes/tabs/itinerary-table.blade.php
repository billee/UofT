<div class="container py-5">
    <div id="dynamic-itinerary-fieldset">
        <fieldset class="mb-3 fieldset-itinerary-template">
            <div class="row mb-4">
                <div class="col-6">
                    <div class="form-group">
                        <label for="itinerary_date-0" class="fw-bold">Date:</label>
                        <input type="text" class="form-control" id="itinerary_date-0" name="itinerary_date-0"  value="@if('view' == $pageMode) {{$itinerary->dates}} @endif">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="itinerary_location-0" class="fw-bold">Location:</label>
                        <input type="text" class="form-control" id="itinerary_location-0" name="itinerary_location-0"  value="@if('view' == $pageMode) {{$itinerary->location}} @endif">
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="form-group">
                        <label for="itinerary_activity-0" class="fw-bold">Activity:</label>
                        <textarea class="form-control" id="itinerary_activity-0" rows="5" name="itinerary_activity-0" placeholder="Please enter here...">
                            @if('view' == $pageMode) {{$itinerary->activity}} @endif
                        </textarea>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    @if('create' == $pageMode)
        <button type="button" id="add-itinerary-button" style="background-color:blue" class="btn btn-primary">+ Add another row</button>
    @endif
</div>
