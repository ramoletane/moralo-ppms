<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">

                    <div class="card-header"><h4>Organisational Units</h4></div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Unit Name</th>
                                    <th>Belongs to</th>
                                    <th width="100">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(organisational_unit, index) in organisational_units" :key="organisational_unit.id">
                                    <td>{{ organisational_unit.company_name }}</td>
                                    <td>{{ organisational_unit.unit_name }}</td>
                                    <td>{{ organisational_unit.parent_unit_id }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" @click="editEntry(organisational_unit)">
                                            <font-awesome-icon icon="edit" />
                                        </button>
                                        <button class="btn btn-sm btn-danger" v-on:click="deleteEntry(organisational_unit.id, index)">
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
                            <h3 slot="header">Add/Edit Organisational Unit</h3>
                            <organisational-units-form ref="form" slot="body"></organisational-units-form>
                        </modal>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-xs btn-success" @click="showModal = true">
                            Create new unit
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
                organisational_unit: null,
                organisational_units: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/organisational-unit')
                .then(function (resp) {
                    app.organisational_units = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load organisational units");
                });
        },

        methods: {

            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/organisational-unit/' + id)
                        .then(function (resp) {
                            app.organisational_units.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete unit");
                        });
                }
            },

            editEntry(item) {
                var app = this;
                this.showModal = true;
                app.organisational_unit = item;
            },
        }
    }
</script>