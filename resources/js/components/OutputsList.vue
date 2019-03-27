<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">

                    <div class="card-header"><h4>Outputs</h4></div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sector</th>
                                    <th>Outputs</th>
                                    <th width="130">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(output, index) in outputs" :key="output.id">
                                    <td>{{ output.sector_name }}</td>
                                    <td>{{ output.output_name }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" :href="'/outputs/' + output.id" title="Select">
                                            <font-awesome-icon icon="forward" />
                                        </a>
                                        <button class="btn btn-sm btn-warning" @click="editEntry(output)" title="Edit">
                                            <font-awesome-icon icon="edit" />
                                        </button>
                                        <button class="btn btn-sm btn-danger" v-on:click="deleteEntry(output.id, index)" title="Delete">
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
                            <h3 slot="header">Add/Edit Output</h3>
                            <outputs-form ref="form" slot="body"></outputs-form>
                        </modal>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-xs btn-success" @click="showModal = true">
                            Add new output
                        </button>
                    </div>

                 </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['outputsList'],

        data: function () {
            return {
                showModal: false,
                output: null,
                outputs: null
            }
        },

        mounted() {
            var app = this;
            app.outputs = JSON.parse(app.outputsList);
        },

        methods: {

            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/output/' + id)
                        .then(function (resp) {
                            app.outputs.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete output");
                        });
                }
            },

            editEntry(item) {
                var app = this;
                this.showModal = true;
                app.output = item;
            },
        }
    }
</script>