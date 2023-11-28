@php
    $summary = $application->applicationSummary ?? '';
@endphp

<div class="container py-5">
    <fieldset class="mb-3 fieldset-template">
        <div class="row mb-4">
            <div class="col-12">
                <div class="form-group">
                    <label for="course-title"><span class="fw-bold">Course code and title for IEP:</span><i>Only students enrolled in the course may participate</i></label>
                    <input type="text" class="form-control" id="course-title" name="course-title" value="@if('view' == $pageMode) {{$summary->course_code ?? ''}} @endif">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <div class="form-group">
                    <label for="estimate-undergrate-enrolled" class="fw-bold">Estimated total number of undergraduate students enrolled:</label>
                    <input type="text" class="form-control" id="students-enrolled" name="students-enrolled"  value="@if('view' == $pageMode) {{$summary->students_enrolled ?? ''}} @endif">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="max-partipate" class="fw-bold">Maximum number of students proposed to participate in IEP:</label>
                    <input type="text" class="form-control" id="students-participate" name="students-participate" value="@if('view' == $pageMode) {{$summary->students_participate ?? ''}} @endif">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <div class="form-group">
                    <label for="location" class="fw-bold">Location of IEP(city and county):</label>
                    <input type="text" class="form-control" id="location" name="location" value="@if('view' == $pageMode) {{$summary->location ?? ''}} @endif">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="travel-date" class="fw-bold">Proposed travel dates:</label>
                    <input type="text" class="form-control" id="travel-date" name="travel-date" value="@if('view' == $pageMode) {{$summary->travel_date ?? ''}} @endif">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="form-group">
                    <label for="amount-requested" class="fw-bold">Amount requested from Arts & Science:</label>
                    <input type="text" class="form-control" id="amount-requested" name="amount-requested" value="@if('view' == $pageMode) {{$summary->amount_requested ?? ''}} @endif">
                </div>
            </div>
        </div>
    </fieldset>
</div>
