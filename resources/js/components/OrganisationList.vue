<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">

                    <div class="card-header"><h4>Organisation</h4></div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th width="100">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(organisation, index) in organisations" :key="organisation.id">
                                    <td>{{ organisation.company_name }}</td>
                                    <td>{{ organisation.email_address }}</td>
                                    <td>{{ organisation.phone_number }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" @click="editEntry(organisation)">
                                            <font-awesome-icon icon="edit" />
                                        </button>
                                        <button class="btn btn-sm btn-danger" v-on:click="deleteEntry(organisation.id, index)">
                                            <font-awesome-icon icon="trash" />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <input-dialogue ref="dialog"></input-dialogue>
                        <!-- use the modal component, pass in the prop -->
                        <modal v-if="showModal" @close="showModal = false">
                            <!--
                            you can use custom content here to overwrite
                            default content
                            -->
                            <h3 slot="header">Add/Edit Organisation</h3>
                            <organisation-form ref="form" slot="body"></organisation-form>
                        </modal>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-xs btn-success" @click="showModal = true">
                            Create new company
                        </button>
                    </div>

                 </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data: function () {
            return {
                showModal: false,
                organisation: null,
                organisations: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/organisation')
                .then(function (resp) {
                    app.organisations = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load organisations");
                });
        },

        methods: {

            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/organisation/' + id)
                        .then(function (resp) {
                            app.organisations.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete company");
                        });
                }
            },

            editEntry(item) {
                var app = this;
                this.showModal = true;
                app.organisation = item;
            },
        }
    }
</script>