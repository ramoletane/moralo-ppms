<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">

                    <div class="card-header"><h4>Industries</h4></div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Industry Name</th>
                                    <th width="100">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(industry, index) in industries" :key="industry.id">
                                    <td>{{ industry.industry_name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" @click="editEntry(industry)">
                                            <font-awesome-icon icon="edit" />
                                        </button>
                                        <button class="btn btn-sm btn-danger" v-on:click="deleteEntry(industry.id, index)">
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
                            <h3 slot="header">Add/Edit Industry</h3>
                            <industries-form ref="form" slot="body"></industries-form>
                        </modal>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-xs btn-success" @click="showModal = true">
                            Add new industry
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
                industry: null,
                industries: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/industry')
                .then(function (resp) {
                    app.industries = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load industries");
                });
        },

        methods: {

            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/industry/' + id)
                        .then(function (resp) {
                            app.industries.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete industry");
                        });
                }
            },

            editEntry(item) {
                var app = this;
                this.showModal = true;
                app.industry = item;
            },
        }
    }
</script>