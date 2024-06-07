<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left;"><strong>Alls Students</strong></h5>
                        <button class="btn btn-sm btn-primary"style="float: right;" data-bs-toggle="modal"
                            data-bs-target="#addStudentModal">Add New Student</button>
                    </div>

                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th style="text-align: center">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($etudients->count() > 0)
                                    @foreach ($etudients as $etudient)
                                        <tr>
                                            <td>{{ $etudient->etudient_id }}</td>
                                            <td>{{ $etudient->name }}</td>
                                            <td>{{ $etudient->email }}</td>
                                            <td>{{ $etudient->phone }}</td>
                                            <td style="text-align: center">
                                                <button class="btn btn-sm btn-secondary" wire:click="viewStudentsDetails({{$etudient->id}})">View</button>
                                                <button class="btn btn-sm btn-primary"
                                                    wire:click="editStudents({{ $etudient->id }})">Edit</button>
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="deleteConfirmation({{ $etudient->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" style="text-align:center;"><small>No student found</small>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
                                        {{-- Modal --}}

    {{-- Add --}}
    <div wire:ignore.self class="modal fade" id="addStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Student</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeStudentData">
                        <div class="form-group row">
                            <label for="etudient_id" class="col-3">Student ID</label>
                            <div class="col-9">
                                <input type="number" id="etudient_id" class="form-control" wire:model="etudient_id">
                                @error('etudient_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="name" class="col-3">Student name</label>
                            <div class="col-9">
                                <input type="text" id="name" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="email" class="col-3">Student email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="phone" class="col-3">Student Phone</label>
                            <div class="col-9">
                                <input type="number" id="phone" class="form-control" wire:model="phone">
                                @error('phone')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary"> Add Student </button>

                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>
    {{-- Update Student --}}

    <div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editStudentData">
                        <div class="form-group row">
                            <label for="etudient_id" class="col-3">Student ID</label>
                            <div class="col-9">
                                <input type="number" id="etudient_id" class="form-control"
                                    wire:model="etudient_id">
                                @error('etudient_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="name" class="col-3">Student name</label>
                            <div class="col-9">
                                <input type="text" id="name" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="email" class="col-3">Student email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="phone" class="col-3">Student Phone</label>
                            <div class="col-9">
                                <input type="number" id="phone" class="form-control" wire:model="phone">
                                @error('phone')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary"> Edit Student </button>

                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>
    {{-- Delete Student --}}

    <div wire:ignore.self class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body pt-4 bp-4">
                    <h6>Are you sure ? you want to delete student data</h6>
                </div>
                <div class="modal-footer">
                    <button class="bnt bnt-primary" wire:click="cancel()" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <button class="bnt bnt-danger" wire:click="deleteStudentData()">Yes! Delete</button>

                </div>
            </div>

        </div>

    </div>
    {{-- View Student --}}

    <div wire:ignore.self class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student Information</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeViewStudentsModal()">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID:</th>
                                <td>{{ $view_etudient_id }}</td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>{{ $view_etudient_name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $view_etudient_email }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $view_etudient_phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

</div>
@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addStudentModal').modal('hide');
            $('#editStudentModal').modal('hide');
            $('#deleteStudentModal').modal('hide');
        });

        window.addEventListener('show-edit-etudient-modal', event => {
            $('#editStudentModal').modal('show');
        });

        window.addEventListener('show-delete-confirmation-modal', event => {
            $('#deleteStudentModal').modal('show');
        });

        window.addEventListener('show-view-etudient-modal', event => {
            $('#viewStudentModal').modal('show');
        });

    </script>
@endpush
