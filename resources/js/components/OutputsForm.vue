<template>
    <form ref="form" v-on:submit="saveForm()">
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Output name</label>
                <textarea v-model="output.output_name" class="form-control"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Outcome</label>
                <select v-model="output.outcome_name" v-on:change="setOutcome($event)" class="form-control">
                    <option value='0' >Select Outcome</option>
                    <option v-for='data in outcomes' :id='data.id' :value='data.outcome_name' :key='data.id'>{{ data.outcome_name }}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Sector</label>
                <select v-model="output.sector_name" v-on:change="setSector($event)" class="form-control">
                    <option value='0' >Select Sector</option>
                    <option v-for='data in organisations' :id='data.id' :value='data.sector_name' :key='data.id'>{{ data.sector_name }}</option>
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
                outputId: null,
                output: {
                    id : null,
                    output_name: '',
                    outcome_id: '',
                    sector_id: '',
                    outcome_name: '',
                    sector_name: '',
                },
                outcomes: [],
                sectors: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/outcome')
                .then(function (resp) {
                    app.outcomes = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load outcomes");
                });
            axios.get('/api/sector')
                .then(function (resp) {
                    app.sectors = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load sectors");
                });
            if (this.$root.$refs.list.output) {
                this.editing = true;
                this.output = this.$root.$refs.list.output;
                this.outputId = this.output.id;
            }
        },

        methods: {

            setOutcome(event) {
                this.output.outcome_id = event.target.options[event.target.selectedIndex].attributes[0].value;
                this.output.outcome_name = event.target.value;
            },

            setSector(event) {
                this.output.sector_id = event.target.options[event.target.selectedIndex].attributes[0].value;
                this.output.sector_name = event.target.value;
            },

            cancelForm() {
                event.preventDefault();
                this.$root.$refs.list.output = null;
                this.$parent.$emit('close');
            },

            saveForm() {
                event.preventDefault();
                this.editing ? this.saveEditedEntry() : this.saveNewEntry();
                this.$root.$refs.list.output = null;
                this.$parent.$emit('close');
            },

            saveEditedEntry() {
                var app = this;
                axios.patch('/api/output/' + app.outputId, app.output)
                    .catch(function (resp) {
                        if (resp.status == 200) {
                            alert("Output successfully updated");
                        } else {
                            console.log(resp);
                            alert("Could not update output");
                        }
                    });
            },

            saveNewEntry() {
                var app = this;
                axios.post('/api/output', app.output) 
                    .then((response) => {
                        app.output.id = response.data.id;
                        this.$root.$refs.list.outputs.push(app.output);
                    })
                    .catch(function (resp) {
                        if (resp != 200) {
                            console.log(resp);
                            alert("Could not create your unit");
                        }
                    });
            },
             
        }
    }
</script>