<div class="container py-5">
    <div id="dynamic-itinerary-fieldset">
        <fieldset class="mb-3 fieldset-itinerary-template">
            <div class="row mb-4">
                <div class="col-6">
                    <div class="form-group">
                        <label for="itinerary_date-{{$n}}" class="fw-bold">Date:</label>
                        <input type="text" class="form-control" id="itinerary_date-{{$n}}" name="itinerary_date-{{$n}}"  value="@if('view' == $pageMode) {{$itinerary->dates}} @endif">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="itinerary_location-{{$n}}" class="fw-bold">Location:</label>
                        <input type="text" class="form-control" id="itinerary_location-{{$n}}" name="itinerary_location-{{$n}}"  value="@if('view' == $pageMode) {{$itinerary->location}} @endif">
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="form-group">
                        <label for="itinerary_activity-{{$n}}" class="fw-bold">Activity:</label>
                        <textarea class="form-control" id="itinerary_activity-{{$n}}" rows="5" name="itinerary_activity-{{$n}}" placeholder="Please enter here...">
                            @if('view' == $pageMode) {{$itinerary->activity}} @endif
                        </textarea>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    @if('create' == $pageMode)
        <button type="button" id="add-itinerary-button" style="background-color:cadetblue" class="btn btn-primary">+ Add another row</button>
    @endif
</div>
