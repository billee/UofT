
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-15">
            <div class="card shadow my-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Application Id</th>
                            <th scope="col">Program Name</th>
                            <th scope="col">Faculty Member</th>
                            <th scope="col" class="text-center">Academic Year</th>
                            <th scope="col" class="text-center">No of Student</th>
                            <th scope="col" class="text-center">Budget</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Date Created</th>
                            <th scope="col" class="text-center"></th>
                            <th scope="col" class="text-center"></th>
                            <th scope="col" class="text-center"></th>
                            <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                                <tr>
                                    <td class="text-center">{{$application->id}}</td>
                                    <td>{{lookup('Application')->where('program_id',$application->program_id)->first()->program->name}}</td>
                                    <td>{{ucwords(lookup('User')->where('id', $application->user_id)->first()->name)}}</td>
                                    <td class="text-center">{{$application->academic_year}}</td>
                                    <td class="text-center">{{$application->no_of_students}}</td>
                                    <td class="text-center">XXXX</td>
                                    <td class="text-center">{{lookup('Status')->where('id', $application->status_id)->first()->name}}</td>
                                    <td class="text-center">{{$application->created_at}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" href="{{route('application.view', ['id' => $application->id])}}" class="btn btn-primary">
                                            View
                                        </a>
                                    </td>
                                    @if($application->isFacultyMemberRole && ($application->isPendingRevisionsStatus || $application->isPendingDORevisionsStatus || $application->isDOConditionallyApprovedStatus))
                                        <td class="text-center">
                                            <button type="button" style="background-color: yellow;" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#commentModal" data-url="{{route('comment.get')}}" data-id="{{ $application->id }}">
                                                Revision
                                            </button>
                                        </td>
                                    @endif

                                    @if($application->isChairDeptRole && $application->isPendingDeptApprovalStatus)
                                        <td class="text-center">
                                            <a href="{{route('application.deptApprove', ['id' => $application->id])}}" class="btn btn-sm btn-success">
                                                {{-- <i class="fas fa-check"></i> --}}
                                                Approve
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" style="background-color: yellow;" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#commentModal" data-url="{{route('comment.get')}}" data-id="{{ $application->id }}">
                                                Revision
                                            </button>
                                        </td>
                                    @endif

                                    @if($application->isDOAdministratorRole && $application->isDeptApprovedStatus)
                                        <td class="text-center">
                                            <a href="{{route('application.pendingDOApprove', ['id' => $application->id])}}" class="btn btn-sm btn-success">
                                                {{-- <i class="fas fa-check"></i> --}}
                                                Pending DO Approve
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" style="background-color: yellow;" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#commentModal" data-url="{{route('comment.get')}}" data-id="{{ $application->id }}">
                                                Revision
                                            </button>
                                        </td>
                                    @endif

                                    @if($application->isDecanalCommitteeMemberRole && $application->isPendingDOApprovalStatus)
                                        <td class="text-center">
                                            <a href="{{route('application.committeeApprove', ['id' => $application->id])}}" class="btn btn-sm btn-success">
                                                {{-- <i class="fas fa-check"></i> --}}
                                                Approve
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('application.committeeDenied', ['id' => $application->id])}}" class="btn btn-sm btn-danger">
                                                {{-- <i class="fas fa-check"></i> --}}
                                                Deny
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" style="background-color: yellow;" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#commentModal" data-url="{{route('comment.get')}}" data-id="{{ $application->id }}">
                                                Revision
                                            </button>
                                        </td>
                                    @endif

                                </tr>
                        @empty
                                <tr>
                                    <td colspan='6'>No item found.</td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex">
        @if(1 == $roleId)
            <a href="{{route('application.create')}}" class="btn btn-primary">Create New Application......</a>
        @endif
        <a href="{{ url('dashboard/download') }}" class="btn btn-secondary ml-auto">Download</a>
    </div>
</div>


@include('modals.comment')

<script>
$("#commentModal").on("show.bs.modal", function (e) {
    var button = $(e.relatedTarget);
    var postId = button.data("id");
    var postUrl = button.data("url");

    $.get(postUrl+ "?postId=" + postId, function(data) {

        $('.modal-body .previous-comment').text('');
        $.each(data, function(key, value) {
            var comment = convertDate(value['created_at']) + "<br>" + value['comment']+ "<br><br>" ;
            var para = $('<p>').html(comment);
            $('.modal-body .previous-comment').append(para);
        });

        $('#app-id').val(postId);
    });
});


$('.save-comment-changes-modal').click(function(e) {

    var postUrl = $(this).data("url");

    var comment = $('.modal-body textarea').val();
    var postId  = $('#app-id').val();
    console.log(postId, postUrl, comment);

    $.ajax({
        url: postUrl,
        type: 'POST',
        data: {
            comment: comment,
            id: postId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log(response);
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
    });

    $("#commentModal").modal('hide');
});



function convertDate(vdate){
    var date = new Date(vdate);

    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();

    return year + '-' + month + '-' + day;
}
</script>
