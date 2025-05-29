@extends('admin.master')
@section('content')
    <!-- Modal -->
    <div
        class="modal fade"
        id="staticBackdrop"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Branch</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                         <center>
                             <img
                                 style="width: 200px; height: 200px; border-radius: 10px"
                                 id="image_preview"
                                 alt="your image"
                             />
                         </center>
                        <label for="file">Logo</label>
                        <input
                            @change="handleFileUpload"
                            type="file"
                            id="file"
                            class="form-control"
                            onchange="document.getElementById('image_preview').src = window.URL.createObjectURL(this.files[0])"
                        >
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input v-model="form.name" type="text" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Phone</label>
                        <input v-model="form.phone" type="text" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <textarea v-model="form.location" rows="2" id="location" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea v-model="form.description" rows="3" id="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="closeModal()"
                    >Close
                    </button>

                    <button
                        v-if="form.id == null"
                        type="button"
                        class="btn btn-primary"
                        @click="save()"
                    >Save
                    </button>

                    <button
                        v-if="form.id !== null"
                        type="button"
                        class="btn btn-warning"
                        @click="update()"
                    >Update
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Branch</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Branch Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button
                                class="btn btn-outline-primary"
                                @click="openModal()"
                            >
                                <i class="fas fa-plus-circle"></i>
                                Add
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped">
                                    <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tr
                                        v-for="(item, index) in branch_list"
                                        :key="'branch_list_'+index"
                                    >
                                        <td>[[ index+1 ]]</td>
                                        <td>
                                            <img
                                                v-if="item.logo !== null"
                                                style="width: 80px; border-radius: 10px"
                                                :src="'{{ asset('/images/') }}'+'/'+item.logo"
                                                onerror="this.src='/image_error.png';"
                                            >

                                            <img
                                                v-else
                                                style="width: 80px; border-radius: 10px"
                                                src="/no-image.png"
                                            >
                                        </td>
                                        <td>[[ item.name ]]</td>
                                        <td>[[ item.phone ]]</td>
                                        <td>[[ item.location ]]</td>
                                        <td>[[ item.description ]]</td>
                                        <td>
                                            <button
                                                @click="getEdit(item)"
                                                class="btn btn-sm btn-warning"
                                            >
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </button>
                                            <button
                                                class="btn btn-sm btn-danger ml-4"
                                                @click="deleteItem(item)"
                                            >
                                                <i class="fas fa-trash-alt"></i>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const {createApp} = Vue
        createApp({
            delimiters: ['[[', ']]'],
            data() {
                return {
                    branch_list: [],
                    form: {
                        id: null,
                        name: null,
                        phone: null,
                        location: null,
                        description: null,
                        image: null
                    }
                }
            },
            created() {
                this.fetchApi()
            },
            methods: {
                handleFileUpload(event) {
                    this.form.image = event.target.files[0];
                },
                fetchApi() {
                    $.LoadingOverlay("show");
                    let vm = this
                    axios.get('{{ route('get_branch') }}')
                        .then(function (response) {
                            // handle success
                            vm.branch_list = response.data
                            $.LoadingOverlay("hide");
                        })
                        .catch(function (error) {
                            // handle error
                            $.LoadingOverlay("hide");
                            alert(error.message)
                            //console.log(error.message);
                        })
                },
                save() {
                    $.LoadingOverlay("show");
                    let vm = this
                    let input = vm.form
                    const formData = new FormData();
                    formData.append('id', input.id);
                    formData.append('name', input.name);
                    formData.append('phone', input.phone);
                    formData.append('location', input.location);
                    formData.append('description', input.description);
                    formData.append('image', input.image);

                    axios.post('{{ route('create_branch') }}', formData)
                        .then(function (response) {
                            // handle success
                            vm.clearForm()
                            vm.fetchApi()
                            $.LoadingOverlay("hide");
                        })
                        .catch(function (error) {
                            // handle error
                            $.LoadingOverlay("hide");
                            alert(error.message)
                            //console.log(error.message);
                        })
                },
                deleteItem(item) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.LoadingOverlay("show");
                            let vm = this
                            let input = {
                                item
                            }
                            axios.post('{{ route('delete_branch') }}', input)
                                .then(function (response) {
                                    // handle success
                                    vm.fetchApi()
                                    $.LoadingOverlay("hide");
                                })
                                .catch(function (error) {
                                    // handle error
                                    $.LoadingOverlay("hide");
                                    alert(error.message)
                                    //console.log(error.message);
                                })
                        }
                    });

                },
                getEdit(item) {
                    this.form.id = item.id
                    this.form.name = item.name
                    this.form.phone = item.phone
                    this.form.location = item.location
                    this.form.description = item.description
                    this.form.image = item.logo
                    this.form.old_image = item.logo
                    this.form.description = item.description
                    if (item.logo == null){
                        document.getElementById('image_preview').src = `{{ asset('/no-image.png') }}`
                    }else {
                        document.getElementById('image_preview').src = `{{ asset('images') }}/${item.logo}`
                    }
                    $('#staticBackdrop').modal('show')
                },
                update() {
                    $.LoadingOverlay("show");
                    let vm = this
                    let input = this.form
                    const formData = new FormData();
                    formData.append('id', input.id);
                    formData.append('name', input.name);
                    formData.append('phone', input.phone);
                    formData.append('location', input.location);
                    formData.append('description', input.description);
                    formData.append('image', input.image);
                    formData.append('old_image', input.old_image);
                    axios.post('{{ route('update_branch') }}', formData)
                        .then(function (response) {
                            // handle success
                            vm.clearForm()
                            vm.fetchApi()
                            $.LoadingOverlay("hide");
                        })
                        .catch(function (error) {
                            // handle error
                            $.LoadingOverlay("hide");
                            alert(error.message)
                            //console.log(error.message);
                        })
                },
                clearForm() {
                    this.form.id = null
                    this.form.name = null
                    this.form.description = null

                    $('#staticBackdrop').modal('hide')
                },
                openModal() {
                    $('#staticBackdrop').modal('show')
                },
                closeModal() {
                    $('#staticBackdrop').modal('hide')
                }
            }
        }).mount('#app')
    </script>
@endsection
