<div>
    @if(session('status'))
    <div class="text-center bg-red-500 text-white rounded px-2 py-1 my-3">{{ session('message') }}</div>
    @endif
    <div class="text-right my-3">
        <button wire:click='endElection' class="bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">Get Election Results</button>
    </div>
    <div class="flex flex-wrap justify-evenly w-full">
        @foreach($elections as $election)
        <div class="w-2/5 my-5">
            <h1 class="text-2xl font-semibold">{{ $election->name }}</h1>
            <div>
                <div class="mb-3">
                    <p>{{ \App\Models\UserElection::all()->where('election_id', $election->id)->where('has_voted', 1)->count() }} out of   {{ \App\Models\UserElection::all()->where('election_id', $election->id)->count() }} has voted</p>
                </div>
                <table class="w-full rounded-lg shadow-lg mx-1 text-center my-3">
                    <thead>
                        <tr class="bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Position</th>
                            <th class="px-4 py-3">Candidate</th>
                            <th class="px-4 py-3">Votes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($positions as $position)
                        <tr>  
                            <td class="border">{{ $position->name }}</td>
                            <td class="border py-2">
                                @foreach($election->candidates as $candidate)
                                <ul>
                                    @if($candidate->position_id == $position->id)
                                    <li class="py-1">{{ $candidate->user->first_name . ' ' . $candidate->user->middle_name . ' ' . $candidate->user->last_name}}</li>
                                    @endif
                                </ul>
                                @endforeach
                            </td>
                            <td class="border py-2">
                                @foreach($election->candidates as $candidate)
                                <ul>
                                    @if($candidate->position_id == $position->id)
                                    <li class="py-1">{{ $candidate->votes->where('candidate_id', $candidate->id)->count() }}</li>
                                    @endif
                                </ul>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>

    {{-- CONFIRMATION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="confirmationModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8 mb-3">Do you want to end the election? Students will not be able to vote anymore once you proceed</p>
                    <h1 class="font-bold text-center mb-2">Election Lists</h1>
                    <table class="w-full border-collapse border border-black">
                        <thead>
                            <tr>
                                <th class="border-black border">Election</th>
                                <th class="border-black border">No. of Students</th>
                                <th class="border-black border">Has voted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($elections as $election)
                            <tr>
                                <td class="border-black border">
                                    {{ $election->name }}
                                </td>
                                <td class="border-black border">
                                    {{ $election->userElections->count()}}
                                </td>
                                <td class="border-black border">
                                    {{ $election->userElections->where('has_voted', 1)->count() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeConfirmationModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="getElectionResults" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    {{-- CONFIRMATION MODAL --}}
</div>