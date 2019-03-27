<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">

                    <div class="card-header"><h4>Impacts</h4></div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Impacts</th>
                                    <th width="130">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(impact, index) in impacts" :key="impact.id">
                                    <td>{{ impact.impact_name }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" :href="'/outcomes/' + impact.id" title="Select">
                                            <font-awesome-icon icon="forward" />
                                        </a>
                                        <button class="btn btn-sm btn-warning" @click="editEntry(impact)" title="Edit">
                                            <font-awesome-icon icon="edit" />
                                        </button>
                                        <button class="btn btn-sm btn-danger" v-on:click="deleteEntry(impact.id, index)" title="Delete">
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
                            <h3 slot="header">Add/Edit Impact</h3>
                            <impacts-form ref="form" slot="body"></impacts-form>
                        </modal>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-xs btn-success" @click="showModal = true">
                            Add new impact
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
                impact: null,
                impacts: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/impact')
                .then(function (resp) {
                    app.impacts = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load impacts");
                });
        },

        methods: {

            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/impact/' + id)
                        .then(function (resp) {
                            app.impacts.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete impact");
                        });
                }
            },

            editEntry(item) {
                var app = this;
                this.showModal = true;
                app.impact = item;
            },
        }
    }
</script>