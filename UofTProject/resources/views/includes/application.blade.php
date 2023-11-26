
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="information-tab" data-bs-toggle="tab" data-bs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="true">Applicant Information</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="false">Project Summary</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="false">Proposed Activity</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="itinerary-tab" data-bs-toggle="tab" data-bs-target="#itinerary" type="button" role="tab" aria-controls="itinerary" aria-selected="false">Itinerary</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="budget-tab" data-bs-toggle="tab" data-bs-target="#budget" type="button" role="tab" aria-controls="budget" aria-selected="false">Budget</button>
        </li>
    </ul>
    <form method="POST" action="{{ route('application.store') }}">
        @csrf
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                @include('includes.tabs.information')
            </div>
            <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                @include('includes.tabs.summary')
            </div>
            <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                @include('includes.tabs.activity')
            </div>
            <div class="tab-pane fade" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
                @include('includes.tabs.itinerary')
            </div>
            <div class="tab-pane fade" id="budget" role="tabpanel" aria-labelledby="budget-tab">
                @include('includes.tabs.budget')
            </div>
        </div>

        <hr/>

        {{-- <div class="d-flex mt-10">
            @if(1 == $roleId)
                <button type="submit" style="background-color:darkred" class="btn btn-primary">Create New Application</button>
            @endif
        </div> --}}

        @if('create' == $pageMode)
            <div class="d-flex mt-10">
                @if(1 == $roleId)
                    <a href="{{route('application.create')}}" class="btn btn-primary">Create New Application</a>
                @endif
                <a href="/download" class="btn btn-secondary ml-auto">Download</a>
            </div>
        @endif
    </form>
</div>





