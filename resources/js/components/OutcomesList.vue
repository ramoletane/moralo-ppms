<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">

                    <div class="card-header"><h4>Outcomes</h4></div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Organisation</th>
                                    <th>Outcomes</th>
                                    <th width="130">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(outcome, index) in outcomes" :key="outcome.id">
                                    <td>{{ outcome.company_name }}</td>
                                    <td>{{ outcome.outcome_name }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" :href="'/outputs/' + outcome.id" title="Select">
                                            <font-awesome-icon icon="forward" />
                                        </a>
                                        <button class="btn btn-sm btn-warning" @click="editEntry(outcome)" title="Edit">
                                            <font-awesome-icon icon="edit" />
                                        </button>
                                        <button class="btn btn-sm btn-danger" v-on:click="deleteEntry(outcome.id, index)" title="Delete">
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
                            <h3 slot="header">Add/Edit Outcome</h3>
                            <outcomes-form ref="form" slot="body"></outcomes-form>
                        </modal>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-xs btn-success" @click="showModal = true">
                            Add new outcome
                        </button>
                    </div>

                 </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['outcomesList'],

        data: function () {
            return {
                showModal: false,
                outcome: null,
                outcomes: null
            }
        },

        mounted() {
            var app = this;
            app.outcomes = JSON.parse(app.outcomesList);
        },

        oldmounted() {
            var app = this;
            alert(app.impactId);
            axios.get('/api/outcome')
                .then(function (resp) {
                    app.outcomes = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load outcomes");
                });
        },

        methods: {

            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/outcome/' + id)
                        .then(function (resp) {
                            app.outcomes.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete outcome");
                        });
                }
            },

            editEntry(item) {
                var app = this;
                this.showModal = true;
                app.outcome = item;
            },
        }
    }
</script>