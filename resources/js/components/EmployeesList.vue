<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">

                    <div class="card-header"><h4>Employees</h4></div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Unit Name</th>
                                    <th>Employee Name</th>
                                    <th>Job Title</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th width="100">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(employee, index) in employees" :key="employee.id">
                                    <td>{{ employee.unit_name }}</td>
                                    <td>{{ employee.firstname }} {{ employee.surname }}</td>
                                    <td>{{ employee.job_title }}</td>
                                    <td>{{ employee.email_address }}</td>
                                    <td>{{ employee.phone_number }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" @click="editEntry(employee)">
                                            <font-awesome-icon icon="edit" />
                                        </button>
                                        <button class="btn btn-sm btn-danger" v-on:click="deleteEntry(employee.id, index)">
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
                            <h3 slot="header">Add/Edit Employee Record</h3>
                            <employees-form ref="form" slot="body"></employees-form>
                        </modal>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-xs btn-success" @click="showModal = true">
                            Add new employee
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
                employee: null,
                employees: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/employee')
                .then(function (resp) {
                    app.employees = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load employee records");
                });
        },

        methods: {

            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/employee/' + id)
                        .then(function (resp) {
                            app.employees.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete employee record");
                        });
                }
            },

            editEntry(item) {
                var app = this;
                this.showModal = true;
                app.employee = item;
            },
        }
    }
</script>