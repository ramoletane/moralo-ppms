<template>
    <form ref="form" v-on:submit="saveForm()">
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Firstname</label>
                <input type="text" v-model="employee.firstname" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Surname</label>
                <input type="text" v-model="employee.surname" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Job Title</label>
                <input type="text" v-model="employee.job_title" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Email Address</label>
                <input type="text" v-model="employee.email_address" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Phone Number</label>
                <input type="text" v-model="employee.phone_number" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Unit</label>
                <select v-model="employee.unit_name" v-on:change="changeUnit($event)" class="form-control">
                    <option value='0' >Select Unit</option>
                    <option v-for='data in units' :id='data.id' :value='data.unit_name' :key='data.id'>{{ data.unit_name }}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <button class="btn btn-success">Submit</button>
                <button class="btn btn-default" @click="cancelForm()">Cancel</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {

        data: function () {
            return {
                employeeId: null,
                employee: {
                    firstname: '',
                    surname: '',
                    job_title: '',
                    email_address: '',
                    phone_number: '',
                    unit_id: '',
                    unit_name: '',
                },
                units: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/organisational-unit')
                .then(function (resp) {
                    app.units = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load units");
                });
            if (this.$root.$refs.list.employee) {
                this.editing = true;
                this.employee = this.$root.$refs.list.employee;
                this.employeeId = this.employee.id;
            }
        },

        methods: {

            changeUnit(event) {
                this.employee.unit_id = event.target.options[event.target.selectedIndex].attributes[0].value;
                this.employee.unit_name = event.target.value;
            },

            cancelForm() {
                event.preventDefault();
                this.$root.$refs.list.employee = null;
                this.$parent.$emit('close');
            },

            saveForm() {
                event.preventDefault();
                this.editing ? this.saveEditedEntry() : this.saveNewEntry();
                this.$root.$refs.list.employee = null;
                this.$parent.$emit('close');
            },

            saveEditedEntry() {
                var app = this;
                axios.patch('/api/employee/' + app.employeeId, app.employee)
                    .catch(function (resp) {
                        if (resp == 200) {
                            alert("Employee successfully updated");
                        } else {
                            console.log(resp);
                            alert("Could not update employee record " + app.employeeId);
                        }
                    });
            },

            saveNewEntry() {
                var app = this;
                var newEntry = app.employee;
                axios.post('/api/employee', newEntry)
                    .then((response) => {
                        this.$root.$refs.list.employees.push(response.data);
                    })
                    .catch(function (resp) {
                        if (resp != 200) {
                            console.log(resp);
                            alert("Could not create employee record");
                        }
                    });
            },
             
        }
    }
</script>