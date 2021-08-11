<template>
    <div class='container py-4'>
        <div class='row justify-content-center'>
            <div class='col-md-8'>
            <div class='card'>
                <div class='card-header'>All Candidates</div>
                <div class='card-body'>
                    <router-link :to="{ name: 'create-candidate' }" class="btn btn-primary">Add Candidate</router-link>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="50" class="text-center">SN</th>
                                    <th>Name</th>
                                    <th width="50" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(candidate, index) in candidates" :key="candidate.id">
                                    <td width="50" class="text-center">{{ index + 1 }}</td>
                                    <td>{{ candidate.name }}</td>
                                    <td width="200" class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-danger" @click = "deletePost(candidate.id)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
</template>

<script>
export default {
    data() {
        return {
          candidates: {}
        }
    },
    created() {
            this.getResults();
    },
    methods: {
        getResults(){

            let uri = 'api/candidates';
            axios({
                 method: "get",
                 url: uri,
             })
             .then( response => {
                 this.candidates = response.data;
             })
        },
        deletePost(id)
        {
            this.$swal.fire({
                title: 'are you sure want to delete?',
                text: "You will not be able to recover this imaginary file.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete it!",   
                cancelButtonText: "No, cancel plx!",
                }).then((result) => {
                if (result.value) {
                    let uri = `api/candidates/delete/${id}`;
                    axios({
                         method: "get",
                         url: uri,
                     })
                     .then( response => {
                       this.getResults();
                        this.$swal.fire({
                            title: 'Success!',
                            text: 'Candidate deleted successfully',
                            icon: 'success',
                            timer: 1000
                        });
                     })
                }
            })
        }
    }
  }
</script>