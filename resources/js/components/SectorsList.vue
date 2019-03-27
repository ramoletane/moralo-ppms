<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">

                    <div class="card-header"><h4>Sectors</h4></div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Industry Name</th>
                                    <th>Sector Name</th>
                                    <th width="100">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(sector, index) in sectors" :key="sector.id">
                                    <td>{{ sector.industry_name }}</td>
                                    <td>{{ sector.sector_name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" @click="editEntry(sector)">
                                            <font-awesome-icon icon="edit" />
                                        </button>
                                        <button class="btn btn-sm btn-danger" v-on:click="deleteEntry(sector.id, index)">
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
                            <h3 slot="header">Add/Edit Sector</h3>
                            <sectors-form ref="form" slot="body"></sectors-form>
                        </modal>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-xs btn-success" @click="showModal = true">
                            Add new sector
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
                sector: null,
                sectors: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/sector')
                .then(function (resp) {
                    app.sectors = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load sectors");
                });
        },

        methods: {

            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/sector/' + id)
                        .then(function (resp) {
                            app.sectors.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete sector");
                        });
                }
            },

            editEntry(item) {
                var app = this;
                this.showModal = true;
                app.sector = item;
            },
        }
    }
</script>