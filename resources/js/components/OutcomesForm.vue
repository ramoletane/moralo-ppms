<template>
    <form ref="form" v-on:submit="saveForm()">
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Outcome name</label>
                <textarea v-model="outcome.outcome_name" class="form-control"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Impact</label>
                <select v-model="outcome.impact_name" v-on:change="setImpact($event)" class="form-control">
                    <option value='0' >Select Impact</option>
                    <option v-for='data in impacts' :id='data.id' :value='data.impact_name' :key='data.id'>{{ data.impact_name }}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Company</label>
                <select v-model="outcome.company_name" v-on:change="setCompany($event)" class="form-control">
                    <option value='0' >Select Company</option>
                    <option v-for='data in organisations' :id='data.id' :value='data.company_name' :key='data.id'>{{ data.company_name }}</option>
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
                outcomeId: null,
                outcome: {
                    id : null,
                    outcome_name: '',
                    impact_id: '',
                    company_id: '',
                    impact_name: '',
                    company_name: '',
                },
                impacts: [],
                organisations: []
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
            axios.get('/api/organisation')
                .then(function (resp) {
                    app.organisations = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load organisations");
                });
            if (this.$root.$refs.list.outcome) {
                this.editing = true;
                this.outcome = this.$root.$refs.list.outcome;
                this.outcomeId = this.outcome.id;
            }
        },

        methods: {

            setImpact(event) {
                this.outcome.impact_id = event.target.options[event.target.selectedIndex].attributes[0].value;
                this.outcome.impact_name = event.target.value;
            },

            setCompany(event) {
                this.outcome.company_id = event.target.options[event.target.selectedIndex].attributes[0].value;
                this.outcome.company_name = event.target.value;
            },

            cancelForm() {
                event.preventDefault();
                this.$root.$refs.list.outcome = null;
                this.$parent.$emit('close');
            },

            saveForm() {
                event.preventDefault();
                this.editing ? this.saveEditedEntry() : this.saveNewEntry();
                this.$root.$refs.list.outcome = null;
                this.$parent.$emit('close');
            },

            saveEditedEntry() {
                var app = this;
                axios.patch('/api/outcome/' + app.outcomeId, app.outcome)
                    .catch(function (resp) {
                        if (resp.status == 200) {
                            alert("Outcome successfully updated");
                        } else {
                            console.log(resp);
                            alert("Could not update outcome");
                        }
                    });
            },

            saveNewEntry() {
                var app = this;
                axios.post('/api/outcome', app.outcome) 
                    .then((response) => {
                        app.outcome.id = response.data.id;
                        this.$root.$refs.list.outcomes.push(app.outcome);
                    })
                    .catch(function (resp) {
                        if (resp != 200) {
                            console.log(resp);
                            alert("Could not create outcome");
                        }
                    });
            },
             
        }
    }
</script>