{{-- <div class="overflow-x-auto">
    <div class="min-w-screen min-h-screen bg-gray-100 flex flex-col items-start justify-start bg-gray-100 font-sans overflow-hidden">
        <div class="w-full lg:w-5/6">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Column 1</th>
                            <th class="py-3 px-6 text-left">Column 2</th>
                            <th class="py-3 px-6 text-center">Column 3</th>
                            <th class="py-3 px-6 text-center">Edit</th>
                            <th class="py-3 px-6 text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">Data 1</td>
                            <td class="py-3 px-6 text-left">Data 2</td>
                            <td class="py-3 px-6 text-center">Data 3</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> --}}


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow my-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Program Name</th>
                            <th scope="col">Faculty Member</th>
                            <th scope="col" class="text-center">Academic Year</th>
                            <th scope="col" class="text-center">No of Student</th>
                            <th scope="col" class="text-center">Status</th>
                        </tr>
                    </thead>

                    @forelse($applications as $application)
                        <tbody>
                            <tr>
                                <td>{{lookup('Application')->first()->program->name}}</td>
                                <td>{{ucwords(lookup('Application')->first()->user->name)}}</td>
                                <td class="text-center">{{$application->academic_year}}</td>
                                <td class="text-center">{{$application->no_of_students}}</td>
                                <td class="text-center">{{lookup('Status')->where('id', $application->status_id)->first()->name}}</td>
                            </tr>
                        </tbody>
                    @empty
                        <p>No applications found.</p>
                    @endforelse

                </table>
            </div>
        </div>
    </div>
</div>


