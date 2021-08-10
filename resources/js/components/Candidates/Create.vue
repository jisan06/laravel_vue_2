<template>
    <div class='container py-6'>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-header'>Create Candidate</div>
                    <div class='card-body'>
                        <div class="alert alert-danger" v-if="errors.length">
                            <ul>
                                <li v-for="error in errors" :key="error">{{ error }}</li>
                            </ul>
                        </div>

                        <form @submit.prevent="createCandidate" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <label htmlFor='name'>Name</label>
                                        <input type="text" class="form-control" id="name" v-model="candidate.name" required="1">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <label htmlFor='email'>Email</label>
                                        <input type="email" class="form-control" id="email" v-model="candidate.email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <label htmlFor='temp_image'>Image</label>
                                        <input type="file" class="form-control" id="temp_image" v-on:change= "Image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label htmlFor='name'>Gender : </label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="radio" id="male" value="Male" v-model="candidate.gender" required="1"> Male
                                            </div>
                                            <div class="col-md-3">
                                                <input type="radio" id="male" value="Female" v-model="candidate.gender"> Female
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link :to="{ name: 'home' }" class="btn btn-secondary">Back</router-link>
                                </div>

                                <div class="col-md-6 text-right">
                                    <button class='btn btn-primary'>Submit</button>
                                </div>
                            </div>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                candidate:{},
                errors: [],
                file: '',
            }
        },
        methods: {
            deleteData(index, candidate_data) {
                var idx = this.candidate_data_list.indexOf(candidate_data);
                if (idx > -1) {
                    this.candidate_data_list.splice(idx, 1);
                }
            },

            Image(e) {
                this.file = e.target.files[0];
            },

            createCandidate(){
                    let uri = '/api/candidates';
                    let data = new FormData();
                    data.append('image', this.file);
                    let payload = {candidate:this.candidate}

                    data.append('data', JSON.stringify(payload));

                    axios({
                         method: "post",
                         url: uri,
                         data: data,
                         headers: {
                            'Content-Type' : 'multipart/form-data',
                            'Content-type' : 'application/json'
                        },
                     })
                     .then( res => {
                         this.$swal.fire({
                            title: 'Success',
                            text: "candidate created successfully",
                            icon: 'success',
                            timer: 1000
                        })
                     })

                    /*this.axios.post(uri, payload,config).then((response) => {

                        this.$swal.fire({
                            title: 'Success',
                            text: "candidate created successfully",
                            icon: 'success',
                            timer: 1000
                        })
                        //this.$router.push({name: 'home'});
                    });*/

                this.errors = [];
            }
        }
    }
</script>