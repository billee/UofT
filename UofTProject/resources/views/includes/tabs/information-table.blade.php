@php
    //dump();
@endphp
<div class="container py-5">
    <div id="dynamic-fieldset">
        <fieldset class="mb-3 fieldset-template">
            <div class="row mb-4">
                <div class="col-6">
                    <div class="form-group">
                        <label for="last_name-0" class="fw-bold">Last Name:</label>
                        <input type="text" class="form-control" id="last_name-0" name="last_name-0" value="@if('view' == $pageMode) {{$info->last_name}} @else {{ucwords(Lookup('User')->where('id', auth()->user()->id)->first()->lastName)}} @endif">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="first_name-0" class="fw-bold">First Name:</label>
                        <input type="text" class="form-control" id="first_name-0" name="first_name-0"  value="@if('view' == $pageMode) {{$info->first_name}} @else {{ucwords(Lookup('User')->where('id', auth()->user()->id)->first()->firstName)}} @endif">
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="form-group">
                        @if('view' == $pageMode)
                            <label><span class="fw-bold">Status:</span></label>
                            <p class="mr-10">{{LookupApplicantStatus($info->status) ?? ''}}</p>
                        @else
                            <label><span class="fw-bold">Status:</span> <i>Please indicate whether you are a faculty member, graduate or undergraduate student</i></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" id="faculty_member-0" name="status-0">
                                <label class="form-check-label fw-bold" for="faculty_member-0" >A&S faculty member with continuous appointment</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="2" id="undergraduate-0" name="status-0">
                                <label class="form-check-label fw-bold" for="undergraduate-0">A&S undergraduate student</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="3" id="graduate-0" name="status-0">
                                <label class="form-check-label fw-bold" for="graduate-0">graduate student</label>
                            </div>
                        @endif

                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <div class="form-group">
                        <label for="sponsor-0" class="fw-bold">Sponsoring department or program:</label>
                        <input type="text" class="form-control" id="sponsor-0" name="sponsor-0"   value="@if('view' == $pageMode) {{$info->sponsor}} @endif">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="email-0" class="fw-bold">Email Address:</label>
                        <input type="text" class="form-control" id="email-0" name="email-0"   value="@if('view' == $pageMode) {{$info->email}} @endif">
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    @if('create' == $pageMode)
        <button type="button" id="add-button" style="background-color:blue" class="btn btn-primary">+ Co-Applicant Information (if applicable)</button>
    @endif
</div>
