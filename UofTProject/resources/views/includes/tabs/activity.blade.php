@php
    $activity = $application->applicationActivity ?? '';
@endphp

<div class="container py-5">
    <fieldset class="mb-3 fieldset-template">
        <div class="row mb-4">
            <div class="col-12">
                <div class="form-group">
                    <label for="description"><span class="fw-bold">Description of proposed IEP module:</span></label>
                        <p><i>Please provide a brief description that is student-facing and can be used in A&S promotional materials.</i></p>
                    <textarea class="form-control" name="description" rows="10">
                        @if('view' == $pageMode) {{$activity->description ?? ''}} @endif
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <div class="form-group">
                    <label for="outcome"><span class="fw-bold">Planned academic outcomes:</span></label>
                        <p><i>What are the learning objectives of this module and how does the IEP enhance students' (both IEP participants and non-participants) learning for thecourse in which it is embedded?</i></p>
                    <textarea class="form-control" name="outcome" rows="10">
                        @if('view' == $pageMode) {{$activity->outcome ?? ''}} @endif
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <div class="form-group">
                    <p>
                        <i>All undergraduate students, graduate students, and faculty taking part in international opportunities must meet the the UofT Safety Aboard guidelines as noted on the Safety Abroad website:</br>
                        <a href="http://www.studentlife.utoronto.ca/cie/safety-abroad">http://www.studentlife.utoronto.ca/cie/safety-abroad</a>
                            in order to participate.</br>
                            Support will be provided by the Professional and International Programs (PIP) office at Woodsworth College to endure safety abroad requirements are met.
                        </i>
                    </p>
                </div>
            </div>
        </div>
    </fieldset>
</div>
