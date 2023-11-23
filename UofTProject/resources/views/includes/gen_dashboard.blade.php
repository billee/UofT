
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow my-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Program Id</th>
                            <th scope="col">Program Name</th>
                            <th scope="col">Faculty Member</th>
                            <th scope="col" class="text-center">Academic Year</th>
                            <th scope="col" class="text-center">No of Student</th>
                            <th scope="col" class="text-center">Budget</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Date Created</th>
                            <th scope="col" class="text-center"></th>
                            <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                                <tr>
                                    <td class="text-center">{{$application->id}}</td>
                                    <td>{{lookup('Application')->where('program_id',$application->program_id)->first()->program->name}}</td>
                                    <td>{{lookup('User')->where('id', $application->user_id)->first()->name}}</td>
                                    <td class="text-center">{{$application->academic_year}}</td>
                                    <td class="text-center">{{$application->no_of_students}}</td>
                                    <td class="text-center">XXXX</td>
                                    <td class="text-center">{{lookup('Status')->where('id', $application->status_id)->first()->name}}</td>
                                    <td class="text-center">{{$application->created_at}}</td>
                                    <td class="text-center">
                                        <a href="/view" class="btn btn-primary">
                                            <i class="fas fa-eye"></i>View
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="/approve" class="btn {{ $application->isApproved ? 'btn-success' : 'btn-secondary' }}">
                                            <i class="fas fa-check"></i>
                                            {{ $application->isApproved ? 'Approved' : 'Approve' }}
                                        </a>
                                    </td>
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
            <a href="{{route('application.create')}}" class="btn btn-primary">Create New Application</a>
        @endif
        <a href="/download" class="btn btn-secondary ml-auto">Download</a>
    </div>
</div>


